@extends('layouts.staff')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6 dark:text-white">Staff Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Pending Orders</h3>
        <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['pendingOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Preparing</h3>
        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['preparingOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Ready</h3>
        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $stats['readyOrders'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h3 class="text-gray-500 dark:text-gray-400 text-sm">Pending Reservations</h3>
        <p class="text-3xl font-bold dark:text-white">{{ $stats['pendingReservations'] }}</p>
    </div>
</div>
@endsection
