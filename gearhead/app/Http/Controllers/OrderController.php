<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve authenticated user
        $user = auth()->user();

        // Retrieve orders associated with the user
        $orders = Order::where('user_id', $user->id)->orderBy('created_at','desc')->get();

        // Pass orders to view
        return view('order.index', ['orders' => $orders]);
    }


    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'cancelled') {
            return redirect()->back()->with('error', 'Order is already cancelled');
        }

        // Update order status to 'cancelled'
        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order removed successfully');
    }
}
