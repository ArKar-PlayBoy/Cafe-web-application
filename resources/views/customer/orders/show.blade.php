@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('orders') }}" class="text-green-600 dark:text-green-400 hover:underline mb-4 inline-block">&larr; Back to Orders</a>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-serif font-bold">Order #{{ $order->id }}</h1>
                <p class="text-gray-500 dark:text-gray-400">{{ $order->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div class="text-right">
                <span class="px-3 py-1 text-sm rounded-full {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : ($order->status === 'completed' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="border-t dark:border-gray-700 pt-6">
            <h2 class="font-semibold text-lg mb-4">Order Items</h2>
            @foreach($order->items as $item)
            <div class="flex justify-between py-2 text-gray-600 dark:text-gray-400">
                <span>{{ $item->quantity }}x {{ $item->menuItem->name }}</span>
                <span>${{ number_format($item->quantity * $item->price, 2) }}</span>
            </div>
            @endforeach
            <hr class="my-3 dark:border-gray-700">
            <div class="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span class="text-green-600 dark:text-green-400">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div class="border-t dark:border-gray-700 pt-6 mt-6">
            <h2 class="font-semibold text-lg mb-4">Payment Information</h2>
            <p class="text-gray-600 dark:text-gray-400"><strong>Method:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p class="text-gray-600 dark:text-gray-400"><strong>Status:</strong> {{ ucfirst($order->payment_status) }}</p>
        </div>

        <div class="border-t dark:border-gray-700 pt-6 mt-6">
            <h2 class="font-semibold text-lg mb-4">Order Status Timeline</h2>
            <div class="flex items-center gap-2">
                @php $statuses = ['pending', 'preparing', 'ready', 'completed']; @endphp
                @foreach($statuses as $status)
                <div class="flex items-center">
                    <div class="w-4 h-4 rounded-full {{ in_array($status, array_slice($statuses, 0, array_search($order->status, $statuses) + 1)) ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' }}"></div>
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ ucfirst($status) }}</span>
                    @if(!$loop->last)<div class="w-8 h-0.5 bg-gray-300 dark:bg-gray-600 mx-2"></div>@endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
