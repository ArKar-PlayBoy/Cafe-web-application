<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menuItem')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        
        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        
        $order->load('items.menuItem', 'user');
        
        return view('customer.orders.show', compact('order'));
    }
}
