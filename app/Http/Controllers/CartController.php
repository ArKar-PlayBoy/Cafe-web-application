<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('menuItem')
            ->where('user_id', auth()->id())
            ->get();
        
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->menuItem->price;
        });
        
        return view('customer.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, MenuItem $menuItem)
    {
        if (!$menuItem->is_available) {
            return back()->with('error', 'This item is not available.');
        }

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('menu_item_id', $menuItem->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'menu_item_id' => $menuItem->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request, Cart $cartItem)
    {
        if ($cartItem->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart updated.');
    }

    public function remove(Cart $cartItem)
    {
        if ($cartItem->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized.');
        }

        $cartItem->delete();
        return back()->with('success', 'Item removed from cart.');
    }
}
