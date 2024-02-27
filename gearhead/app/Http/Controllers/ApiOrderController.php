<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ApiOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function destroy($id){
    $order = Order::findOrFail($id);
    $order->delete();
    Order::truncate();
    return response()->json(['message' => 'Deleted']);
}

}
