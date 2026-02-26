@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<h1 class="text-2xl font-bold mb-6">All Orders</h1>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/50 overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Order ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Payment</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($orders as $order)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">#{{ $order->id }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $order->user->name }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">${{ number_format($order->total, 2) }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ strtoupper($order->payment_method) }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300' : ($order->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $order->created_at->format('M d, Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
