<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.menuItem')->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function verifyPayment(Order $order)
    {
        // Fix: Check for 'pending' or 'awaiting_verification' status - checkout sets 'pending', customer upload sets 'awaiting_verification'
        if (! $order->payment_screenshot || in_array($order->payment_status, ['verified', 'paid'])) {
            return back()->with('error', 'No payment screenshot to verify or already verified.');
        }

        $order->update([
            'payment_status' => 'verified',
            'payment_verified_at' => now(),
            'payment_verified_by' => auth('admin')->id(),
        ]);

        return back()->with('success', 'Payment verified successfully.');
    }

    public function rejectPayment(Request $request, Order $order)
    {
        $request->validate([
            'note' => 'required|string|max:1000',
        ]);

        // Fix: Check for statuses that can be rejected
        if (! $order->payment_screenshot || in_array($order->payment_status, ['verified', 'paid', 'failed'])) {
            return back()->with('error', 'No payment screenshot to reject or already processed.');
        }

        $order->update([
            'payment_status' => 'failed',
            'payment_note' => $request->note,
            'payment_verified_at' => now(),
            'payment_verified_by' => auth('admin')->id(),
        ]);

        return back()->with('error', 'Payment rejected.');
    }
}
