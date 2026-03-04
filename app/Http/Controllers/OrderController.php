<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $orders = Order::with('items.menuItem')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
        
        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
=======
        $orders = Order::with('items.menuItem', 'rejection')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
>>>>>>> 5b466fb (more reliable and front-end changes)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
<<<<<<< HEAD
        
        $order->load('items.menuItem', 'user');
        
        return view('customer.orders.show', compact('order'));
    }
=======

        $order->load('items.menuItem', 'user', 'rejection', 'canceller');

        return view('customer.orders.show', compact('order'));
    }

    public function uploadPayment(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->payment_status === 'verified') {
            return back()->with('error', 'Payment already verified.');
        }

        if ($order->payment_method === 'cod') {
            return back()->with('error', 'COD orders do not require payment upload.');
        }

        $request->validate([
            'screenshot' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'reference' => 'nullable|string|max:255',
        ]);

        $screenshotPath = null;
        if ($request->hasFile('screenshot')) {
            $screenshot = $request->file('screenshot');
            // Use UUID-based filename to prevent enumeration and path guessing
            $extension = $screenshot->getClientOriginalExtension() ?: 'jpg';
            $filename = \Illuminate\Support\Str::uuid().'.'.strtolower($extension);
            $path = 'payments/'.$order->id;
            $screenshotPath = $screenshot->storeAs($path, $filename, 'public');
        }

        $order->update([
            'payment_screenshot' => $screenshotPath,
            'payment_reference' => $request->reference,
            'payment_status' => 'awaiting_verification',
        ]);

        return back()->with('success', 'Payment screenshot uploaded successfully. Please wait for verification.');
    }

    public function cancel(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }

        $order->update([
            'status' => 'cancelled',
            'cancelled_by' => auth()->id(),
        ]);

        return redirect()->route('orders')->with('success', 'Order cancelled successfully.');
    }
>>>>>>> 5b466fb (more reliable and front-end changes)
}
