@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
<<<<<<< HEAD
    <a href="{{ route('orders') }}" class="text-green-600 dark:text-green-400 hover:underline mb-4 inline-block">&larr; Back to Orders</a>
=======
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('orders') }}" class="text-green-600 dark:text-green-400 hover:underline">&larr; Back to Orders</a>
        @if($order->status === 'pending')
            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Cancel Order</button>
            </form>
        @endif
    </div>
>>>>>>> 5b466fb (more reliable and front-end changes)
    
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-serif font-bold">Order #{{ $order->id }}</h1>
                <p class="text-gray-500 dark:text-gray-400">{{ $order->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div class="text-right">
<<<<<<< HEAD
                <span class="px-3 py-1 text-sm rounded-full {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : ($order->status === 'completed' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400') }}">
                    {{ ucfirst($order->status) }}
                </span>
=======
                <span class="px-3 py-1 text-sm rounded-full {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : ($order->status === 'completed' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : ($order->status === 'cancelled' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400')) }}">
                    {{ ucfirst($order->status) }}
                </span>
                @if($order->status === 'cancelled' && $order->rejection)
                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">Reason: {{ $order->rejection->reason }}</p>
                    @if($order->rejection->note)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $order->rejection->note }}</p>
                    @endif
                @elseif($order->status === 'cancelled' && $order->canceller)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Cancelled by you</p>
                @endif
>>>>>>> 5b466fb (more reliable and front-end changes)
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
<<<<<<< HEAD
            <p class="text-gray-600 dark:text-gray-400"><strong>Status:</strong> {{ ucfirst($order->payment_status) }}</p>
=======
            <p class="text-gray-600 dark:text-gray-400"><strong>Status:</strong> 
                <span class="{{ in_array($order->payment_status, ['verified', 'paid']) ? 'text-green-600 dark:text-green-400' : ($order->payment_status === 'failed' ? 'text-red-600 dark:text-red-400' : 'text-yellow-600 dark:text-yellow-400') }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </p>
            @if($order->payment_status === 'failed' && $order->payment_note)
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">Reason: {{ $order->payment_note }}</p>
            @endif
            
            @if($order->payment_method !== 'cod' && !in_array($order->payment_status, ['verified', 'paid']))
            <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                <h3 class="font-medium text-yellow-800 dark:text-yellow-200 mb-2">Payment Instructions</h3>
                <p class="text-sm text-yellow-700 dark:text-yellow-300 mb-3">
                    Please transfer <strong>${{ number_format($order->total, 2) }}</strong> to our KBZ Pay number and upload the screenshot below.
                </p>
                
                @if($order->payment_status !== 'awaiting_verification')
                <form action="{{ route('orders.upload-payment', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload Payment Screenshot (JPG only, max 2MB)</label>
                        <input type="file" name="screenshot" accept="image/jpeg" required class="w-full border dark:border-gray-600 dark:bg-gray-700 rounded-lg p-2 text-sm">
                        <p class="text-xs text-gray-500 mt-1">Only JPG files are allowed. PDF is not accepted.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Transaction ID (Optional)</label>
                        <input type="text" name="reference" placeholder="Enter KBZ transaction ID" class="w-full border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2">
                    </div>
                    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">Upload Payment</button>
                </form>
                @else
                <div class="bg-yellow-100 dark:bg-yellow-900/40 p-3 rounded-lg">
                    <p class="text-yellow-800 dark:text-yellow-200 text-sm">Your payment screenshot has been submitted and is waiting for verification. Please wait for staff to verify your payment.</p>
                </div>
                @endif
            </div>
            @endif
            
            @if($order->payment_screenshot)
            <div class="mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Uploaded Screenshot:</p>
                <a href="{{ asset('storage/' . $order->payment_screenshot) }}" target="_blank">
                    <img src="{{ asset('storage/' . $order->payment_screenshot) }}" alt="Payment Screenshot" class="max-w-xs rounded-lg border dark:border-gray-600">
                </a>
            </div>
            @endif
>>>>>>> 5b466fb (more reliable and front-end changes)
        </div>

        <div class="border-t dark:border-gray-700 pt-6 mt-6">
            <h2 class="font-semibold text-lg mb-4">Order Status Timeline</h2>
            <div class="flex items-center gap-2">
<<<<<<< HEAD
                @php $statuses = ['pending', 'preparing', 'ready', 'completed']; @endphp
                @foreach($statuses as $status)
                <div class="flex items-center">
                    <div class="w-4 h-4 rounded-full {{ in_array($status, array_slice($statuses, 0, array_search($order->status, $statuses) + 1)) ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' }}"></div>
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ ucfirst($status) }}</span>
=======
                @php 
                $statuses = ['pending', 'preparing', 'ready', 'completed'];
                if ($order->status === 'cancelled') {
                    $activeStatuses = ['pending'];
                } else {
                    $activeStatuses = array_slice($statuses, 0, array_search($order->status, $statuses) + 1);
                }
                @endphp
                @foreach($statuses as $status)
                <div class="flex items-center">
                    <div class="w-4 h-4 rounded-full {{ in_array($status, $activeStatuses) ? ($order->status === 'cancelled' ? 'bg-red-500' : 'bg-green-500') : 'bg-gray-300 dark:bg-gray-600' }}"></div>
                    <span class="ml-2 text-sm {{ $order->status === 'cancelled' && $status === 'pending' ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400' }}">{{ ucfirst($status) }}</span>
>>>>>>> 5b466fb (more reliable and front-end changes)
                    @if(!$loop->last)<div class="w-8 h-0.5 bg-gray-300 dark:bg-gray-600 mx-2"></div>@endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
