<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class ApiCartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        return response()->json($carts);
    }

    public function destroy($id)
{
    $cart = Cart::findOrFail($id);
    $cart->delete();
    Cart::truncate();
    return response()->json(['message' => 'Deleted']);
}
}
