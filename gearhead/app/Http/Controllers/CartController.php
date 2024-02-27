<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\Accessories;
use App\Models\Cart;
use App\Models\Order;
use Stripe\Checkout\Session;
use Illuminate\Http\JsonResponse;
use Stripe\Exception\ApiErrorException;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        // If cart is not found in the database, create a new empty cart
        if (!$cart) {
            $cart = new Cart(['user_id' => $user->id, 'items' => []]);
            $cart->save();
        }

        return view('cart', ['cart' => $cart]);
    }

    public function addToCart(Request $request)
    {
        $itemType = $request->input('item_type');
        $itemId = $request->input('id');

        // Check if the item type is motor
        if ($itemType === 'motor') {
            $item = Motor::findOrFail($itemId);

            $itemData = [
                'id' => $item->id,
                'type' => 'motor', // Add the type key for motor items
                'name' => $item->brand . ' ' . $item->model,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'image_path' => $item->image_path,
                'brand' => $item->brand,
                'model' => $item->model,
            ];
        }
        // Check if the item type is accessory
        elseif ($itemType === 'accessory') {
            $item = Accessories::findOrFail($itemId);

            $itemData = [
                'id' => $item->id,
                'type' => 'accessory', // Add the type key for accessory items
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'image_path' => $item->image_path,
                // Add specific details for accessories if needed
            ];
        }
        // Invalid item type
        else {
            return response()->json(['success' => false, 'message' => 'Invalid item type']);
        }

        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();

        // If cart is not found in the database, create a new empty cart
        if (!$cart) {
            $cart = new Cart(['user_id' => $user->id, 'items' => []]);
            $cart->save();
        }

        $cartData = $cart->items;
        $cartData[] = $itemData;

        $cart->update(['items' => $cartData]);

        return redirect()->route('cart')->with('successMessage', 'Item added to cart successfully');
    }

    public function removeFromCart(Request $request)
    {
        $itemId = $request->input('id');
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();

        if ($cart) {
            $cartData = $cart->items;

            // Find the index of the item in the cart array
            $itemIndex = array_search($itemId, array_column($cartData, 'id'));

            if ($itemIndex !== false) {
                // Remove the item from the cart
                array_splice($cartData, $itemIndex, 1);
                $cart->update(['items' => $cartData]);

                return response()->json(['success' => true, 'message' => 'Item removed from cart']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart']);
    }

    public function checkout(Request $request)
    {
        // Retrieve the cart items and calculate the total amount
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart || empty($cart->items)) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        // Check if all items in the cart have available quantity
        foreach ($cart->items as $item) {
            if ($item['quantity'] <= 0) {
                return redirect()->back()->with('error', 'Cannot proceed to checkout. Some items are out of stock.');
            }
        }

        $productName = [];
        $productImage = [];
        $totalAmount = 0;

        // Deduct the quantity of each item in the cart from the database
        foreach ($cart->items as $item) {
            if (isset($item['type']) && $item['type'] === 'motor') {
                $product = Motor::find($item['id']);
                $productName[] = $item['brand'] . ' ' . $item['model'];
            } elseif (isset($item['type']) && $item['type'] === 'accessory') {
                $product = Accessories::find($item['id']);
                $productName[] = $item['name'];
            } else {
                // Handle unknown item type
                continue;
            }

            if ($product && $product->quantity > 0) { // Ensure quantity is greater than 0 before deduction
                $quantityToDeduct = 1; // Always deduct by 1 for each item
                $product->quantity -= $quantityToDeduct; // Subtract the deducted quantity from available quantity
                $product->save(); // Save the updated product
                $productImage[] = $product->image_path; // Add product image path to the array
                $totalAmount += $product->price; // Add product price to the total amount
            }
        }

        // Store the order details in your database
        $order = new Order();
        $order->user_id = $user->id;
        $order->quantity = count($cart->items);
        $order->total_amount = $totalAmount;
        $order->payment_method = 'stripe'; // Assuming payment method is Stripe
        $order->status = 'pending';
        $order->product_names = implode(', ', $productName); // Store product names in the order
        $order->product_images = implode(',', $productImage); // Store product images in the order
        // Other order details...
        $order->save();

        // Clear the cart after checkout
        $cart->items = [];
        $cart->save();

        // Redirect the user to the Stripe Checkout page
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $session = $stripe->checkout->sessions->create([
            'success_url' => route('cart.success'),
            'cancel_url' => route('cart.cancel'),
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'php',
                        'unit_amount' => $totalAmount * 100, // Amount in cents
                        'product_data' => [
                            'name' => implode(', ', $productName), // Change this according to your requirement
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
        ]);

        return redirect()->to($session->url);
    }
}

