@extends('layouts.staff')

@section('title', 'Orders')

@section('content')
<h1 class="text-2xl font-bold mb-6 dark:text-white">Orders</h1>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
<<<<<<< HEAD
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Order ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
=======
                <th class="px-4 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Order ID</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Customer</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Items</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Total</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Payment</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Actions</th>
>>>>>>> 5b466fb (more reliable and front-end changes)
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($orders as $order)
<<<<<<< HEAD
            <tr class="dark:text-white">
                <td class="px-6 py-4">#{{ $order->id }}</td>
                <td class="px-6 py-4">{{ $order->user->name }}</td>
                <td class="px-6 py-4">${{ number_format($order->total, 2) }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : ($order->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
=======
            <tr class="text-gray-900 dark:text-white">
                <td class="px-4 py-4">#{{ $order->id }}</td>
                <td class="px-4 py-4">{{ $order->user->name }}</td>
                <td class="px-4 py-4 text-sm">
                    @foreach($order->items as $item)
                    <div>{{ $item->quantity }}x {{ $item->menuItem->name ?? 'N/A' }}</div>
                    @endforeach
                </td>
                <td class="px-4 py-4">${{ number_format($order->total, 2) }}</td>
                <td class="px-4 py-4">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ strtoupper($order->payment_method) }}</span>
                        @if($order->payment_method !== 'cod')
                        <span class="px-2 py-0.5 text-xs rounded-full {{ $order->payment_status === 'verified' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : ($order->payment_status === 'failed' ? 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' : ($order->payment_status === 'awaiting_verification' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-300')) }}">
                            {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                        </span>
                        @if($order->payment_screenshot)
                        <a href="{{ asset('storage/' . $order->payment_screenshot) }}" target="_blank" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">View Screenshot</a>
                        @endif
                        @endif
                    </div>
                </td>
                <td class="px-4 py-4">
                    @if($order->status === 'cancelled' && $order->rejection)
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                            Rejected
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs rounded {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : ($order->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    @endif
                </td>
                <td class="px-4 py-4">
                    @if($order->status !== 'cancelled' && $order->status !== 'completed')
                    @if($order->payment_method !== 'cod' && $order->payment_status !== 'verified' && $order->payment_screenshot)
                    <div class="flex flex-col gap-2 mb-2">
                        <form action="{{ route('staff.orders.verify-payment', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 w-full">Verify Payment</button>
                        </form>
                        <button type="button" onclick="document.getElementById('rejectPay{{ $order->id }}').showModal()" class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">Reject</button>
                        
                        <dialog id="rejectPay{{ $order->id }}" class="modal p-6 rounded-lg shadow-xl dark:bg-gray-800">
                            <h3 class="text-lg font-bold mb-4 dark:text-white">Reject Payment - Order #{{ $order->id }}</h3>
                            <form action="{{ route('staff.orders.reject-payment', $order->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium mb-2 dark:text-gray-300">Reason for rejection</label>
                                    <textarea name="note" rows="3" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600" required placeholder="Explain why payment is rejected..."></textarea>
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Reject Payment</button>
                                    <button type="button" onclick="document.getElementById('rejectPay{{ $order->id }}').close()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                                </div>
                            </form>
                        </dialog>
                    </div>
                    @endif
                    
>>>>>>> 5b466fb (more reliable and front-end changes)
                    <form action="{{ route('staff.orders.status', $order->id) }}" method="POST" class="inline">
                        @csrf @method('PUT')
                        <select name="status" class="border rounded px-2 py-1 text-sm dark:bg-gray-700 dark:text-white" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                            <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
<<<<<<< HEAD
=======
                    <button type="button" onclick="document.getElementById('rejectModal{{ $order->id }}').showModal()" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 ml-2">
                        Reject
                    </button>
                    
                    <dialog id="rejectModal{{ $order->id }}" class="modal p-6 rounded-lg shadow-xl dark:bg-gray-800">
                        <h3 class="text-lg font-bold mb-4 dark:text-white">Reject Order #{{ $order->id }}</h3>
                        <form action="{{ route('staff.orders.reject', $order->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2 dark:text-gray-300">Reason</label>
                                <select name="reason" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600" required>
                                    <option value="">Select a reason</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                    <option value="Expired Item">Expired Item</option>
                                    <option value="Damaged Item">Damaged Item</option>
                                    <option value="Customer Request">Customer Request</option>
                                    <option value="Kitchen Closed">Kitchen Closed</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2 dark:text-gray-300">Note (Optional)</label>
                                <textarea name="note" rows="2" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600"></textarea>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Reject Order</button>
                                <button type="button" onclick="document.getElementById('rejectModal{{ $order->id }}').close()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            </div>
                        </form>
                    </dialog>
                    @else
                        <span class="text-gray-400 text-sm">No actions available</span>
                    @endif
>>>>>>> 5b466fb (more reliable and front-end changes)
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<<<<<<< HEAD
=======
    <div class="px-6 py-4">
        {{ $orders->links() }}
    </div>
>>>>>>> 5b466fb (more reliable and front-end changes)
</div>
@endsection
