<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetail')->where('user_id', Auth::user()->id)->latest()->get();
        // return $orders;
        return view('user.order.index', [
            'title' => 'Order',
            'orders' => $orders
        ]);
    }
}
