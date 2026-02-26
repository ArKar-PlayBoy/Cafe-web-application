@extends('layouts.staff')

@section('title', 'Orders')

@section('content')
<h1 class="text-2xl font-bold mb-6 dark:text-white">Orders</h1>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Order ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($orders as $order)
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
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
