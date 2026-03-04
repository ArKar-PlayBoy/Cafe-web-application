<?php

namespace App\Http\Controllers\Staff;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Order;
=======
use App\Events\OrderStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderRejection;
use App\Services\StockService;
>>>>>>> 5b466fb (more reliable and front-end changes)
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $orders = Order::with('user')->latest()->get();
=======
        $orders = Order::with('user', 'items.menuItem', 'rejection')->latest()->paginate(15);

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('staff.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,completed,cancelled',
        ]);

<<<<<<< HEAD
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated successfully.');
    }
=======
        $previousStatus = $order->status;

        $order->update(['status' => $request->status]);

        // Dispatch status change event for email notification
        event(new OrderStatusChanged($order, $previousStatus, $request->status));

        if ($request->status === 'completed' && $previousStatus !== 'completed') {
            StockService::deductStock($order);
        }

        return back()->with('success', 'Order status updated successfully.');
    }

    public function reject(Request $request, Order $order)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
        ]);

        OrderRejection::create([
            'order_id' => $order->id,
            'user_id' => auth('staff')->id(),
            'reason' => $request->reason,
            'note' => $request->note,
        ]);

        $previousStatus = $order->status;
        $order->update(['status' => 'cancelled']);

        // Dispatch status change event for email notification
        event(new OrderStatusChanged($order, $previousStatus, 'cancelled'));

        return back()->with('success', 'Order rejected successfully.');
    }

    public function verifyPayment(Order $order)
    {
        // Fix: Check for 'pending' or 'awaiting_verification' status
        if (! $order->payment_screenshot || in_array($order->payment_status, ['verified', 'paid'])) {
            return back()->with('error', 'No payment screenshot to verify or already verified.');
        }

        $order->update([
            'payment_status' => 'verified',
            'payment_verified_at' => now(),
            'payment_verified_by' => auth('staff')->id(),
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
            'payment_verified_by' => auth('staff')->id(),
        ]);

        return back()->with('error', 'Payment rejected.');
    }
>>>>>>> 5b466fb (more reliable and front-end changes)
}
