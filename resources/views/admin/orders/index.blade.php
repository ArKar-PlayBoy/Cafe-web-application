@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">All Orders</h1>
    <a href="{{ route('admin.orders.export-all', request()->only('status', 'from', 'to')) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
        Export All (CSV)
    </a>
</div>

<div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border border-gray-100 dark:border-slate-700 rounded-2xl shadow-lg overflow-hidden transition-all duration-300">
    <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Order ID</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Customer</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Items</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Payment</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Date</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($orders as $order)
            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors duration-200">
                <td class="px-4 py-4 text-gray-900 dark:text-gray-100">#{{ $order->id }}</td>
                <td class="px-4 py-4 text-gray-900 dark:text-gray-100">{{ $order->user->name }}</td>
                <td class="px-4 py-4 text-gray-900 dark:text-gray-100 text-sm">
                    @foreach($order->items as $item)
                    <div>{{ $item->quantity }}x {{ $item->menuItem->name ?? 'N/A' }}</div>
                    @endforeach
                </td>
                <td class="px-4 py-4 text-gray-900 dark:text-gray-100">${{ number_format($order->total, 2) }}</td>
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
                    <span class="px-2 py-1 text-xs rounded {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300' : ($order->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-4 py-4 text-gray-900 dark:text-gray-100 text-sm">{{ $order->created_at->format('M d, Y H:i') }}</td>
                <td class="px-4 py-4">
                    <div class="flex flex-col gap-2">
                        @if($order->payment_method !== 'cod' && $order->payment_status !== 'verified' && $order->payment_screenshot)
                        <div class="flex gap-2">
                            <form action="{{ route('admin.orders.verify-payment', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">Verify</button>
                            </form>
                            <button type="button" onclick="document.getElementById('rejectPayment{{ $order->id }}').showModal()" class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">Reject</button>
                            
                            <dialog id="rejectPayment{{ $order->id }}" class="modal p-6 rounded-2xl shadow-2xl dark:bg-slate-800 border dark:border-slate-700 backdrop-blur-md bg-white/90 dark:bg-slate-800/90">
                                <h3 class="text-lg font-bold mb-4 dark:text-white">Reject Payment - Order #{{ $order->id }}</h3>
                                <form action="{{ route('admin.orders.reject-payment', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium mb-2 dark:text-gray-300">Reason for rejection</label>
                                        <textarea name="note" rows="3" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600" required placeholder="Explain why payment is rejected..."></textarea>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Reject Payment</button>
                                        <button type="button" onclick="document.getElementById('rejectPayment{{ $order->id }}').close()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                                    </div>
                                </form>
                            </dialog>
                        </div>
                        @elseif($order->payment_method === 'cod')
                        <span class="text-xs text-gray-500 dark:text-gray-400">COD</span>
                        @else
                        <span class="text-xs text-gray-500 dark:text-gray-400">No action</span>
                        @endif

                        <a href="{{ route('admin.orders.export', $order->id) }}" class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-3 py-1 rounded text-xs hover:bg-gray-300 dark:hover:bg-gray-600">
                            Export CSV
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
