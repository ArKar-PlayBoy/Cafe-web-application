@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-serif font-bold mb-6">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                            <input type="radio" name="payment_method" value="cod" class="mr-3 text-green-600" checked>
                            <span class="font-medium">Cash on Delivery (COD)</span>
                        </label>
                        <label class="flex items-center p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                            <input type="radio" name="payment_method" value="mpu" class="mr-3 text-green-600">
                            <span class="font-medium">MPU Card</span>
                        </label>
                        <label class="flex items-center p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                            <input type="radio" name="payment_method" value="visa" class="mr-3 text-green-600">
                            <span class="font-medium">Visa Card</span>
                        </label>
                        <label class="flex items-center p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                            <input type="radio" name="payment_method" value="kbz_pay" class="mr-3 text-green-600">
                            <span class="font-medium">KBZ Pay</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold">Place Order - ${{ number_format($total, 2) }}</button>
            </form>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 h-fit">
            <h3 class="font-semibold text-xl mb-4">Order Summary</h3>
            @foreach($cartItems as $item)
            <div class="flex justify-between py-2 text-gray-600 dark:text-gray-400">
                <span>{{ $item->quantity }}x {{ $item->menuItem->name }}</span>
                <span>${{ number_format($item->quantity * $item->menuItem->price, 2) }}</span>
            </div>
            @endforeach
            <hr class="my-3 dark:border-gray-700">
            <div class="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span class="text-green-600 dark:text-green-400">${{ number_format($total, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
