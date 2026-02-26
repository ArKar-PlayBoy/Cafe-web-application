@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow dark:shadow-gray-900/50">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Total Orders</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['totalOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow dark:shadow-gray-900/50">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Pending Orders</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['pendingOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow dark:shadow-gray-900/50">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Today's Orders</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['todayOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow dark:shadow-gray-900/50">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Total Revenue</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">${{ number_format($stats['totalRevenue'], 2) }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow dark:shadow-gray-900/50">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Total Users</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['totalUsers'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow dark:shadow-gray-900/50">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Menu Items</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['totalMenuItems'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow dark:shadow-gray-900/50">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Total Tables</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['totalTables'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow dark:shadow-gray-900/50">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Pending Reservations</h3>
        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['pendingReservations'] }}</p>
    </div>
</div>

<h2 class="text-xl font-bold mt-8 mb-4">Recent Orders</h2>
<div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/50 overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Order ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($recentOrders as $order)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">#{{ $order->id }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $order->user->name }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">${{ number_format($order->total, 2) }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300' : ($order->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $order->created_at->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
