<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('menuItem')
            ->where('user_id', auth()->id())
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('menu')->with('error', 'Your cart is empty.');
        }
        
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->menuItem->price;
        });
        
        return view('customer.checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cod,mpu,visa,kbz_pay',
        ]);

        $cartItems = Cart::with('menuItem')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('menu')->with('error', 'Your cart is empty.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->menuItem->price;
        });

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total' => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid',
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $cartItem->menu_item_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->menuItem->price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }
}
