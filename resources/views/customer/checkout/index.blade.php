@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<<<<<<< HEAD
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
=======
<div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-6 sm:py-8">
    <h1 class="text-2xl sm:text-3xl font-serif font-bold mb-4 sm:mb-6">Checkout</h1>

    @if($errors->any())
    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3 sm:p-4 mb-4 sm:mb-6">
        <ul class="list-disc list-inside text-red-600 dark:text-red-400 text-sm">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        <div class="lg:col-span-2 order-2 lg:order-1">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 sm:p-6 mb-4 sm:mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-4">Payment Method</h2>
                    <div class="space-y-2 sm:space-y-3">
                        <label class="flex items-start sm:items-center p-3 sm:p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 {{ $errors->has('payment_method') ? 'border-red-500' : '' }}">
                            <input type="radio" name="payment_method" value="stripe" class="mt-1 sm:mt-0 mr-3 text-green-600" checked>
                            <span class="font-medium flex items-center gap-2">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" viewBox="0 0 24 24" fill="none">
                                    <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z" fill="#635BFF"/>
                                </svg>
                                <span class="text-sm sm:text-base">Credit/Debit Card (Stripe)</span>
                            </span>
                        </label>
                        <label class="flex items-center p-3 sm:p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 {{ $errors->has('payment_method') ? 'border-red-500' : '' }}">
                            <input type="radio" name="payment_method" value="cod" class="mr-3 text-green-600" {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                            <span class="font-medium text-sm sm:text-base">Cash on Delivery (COD)</span>
                        </label>
                        <label class="flex items-center p-3 sm:p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 {{ $errors->has('payment_method') ? 'border-red-500' : '' }}">
                            <input type="radio" name="payment_method" value="mpu" class="mr-3 text-green-600" {{ old('payment_method') == 'mpu' ? 'checked' : '' }}>
                            <span class="font-medium text-sm sm:text-base">MPU Card</span>
                        </label>
                        <label class="flex items-center p-3 sm:p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 {{ $errors->has('payment_method') ? 'border-red-500' : '' }}">
                            <input type="radio" name="payment_method" value="visa" class="mr-3 text-green-600" {{ old('payment_method') == 'visa' ? 'checked' : '' }}>
                            <span class="font-medium text-sm sm:text-base">Visa Card</span>
                        </label>
                        <label class="flex items-center p-3 sm:p-4 border dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 {{ $errors->has('payment_method') ? 'border-red-500' : '' }}">
                            <input type="radio" name="payment_method" value="kbz_pay" class="mr-3 text-green-600" {{ old('payment_method') == 'kbz_pay' ? 'checked' : '' }}>
                            <span class="font-medium text-sm sm:text-base">KBZ Pay</span>
                        </label>
                    </div>
                    @error('payment_method')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-3 sm:py-4 rounded-lg hover:bg-green-700 transition-colors font-semibold text-sm sm:text-base">Place Order - ${{ number_format($total, 2) }}</button>
            </form>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 sm:p-6 h-fit order-1 lg:order-2">
            <h3 class="font-semibold text-lg sm:text-xl mb-4">Order Summary</h3>
            <div class="max-h-60 overflow-y-auto">
                @forelse($cartItems as $item)
                <div class="flex justify-between py-2 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                    <span class="break-words">{{ $item->quantity }}x {{ $item->menuItem->name }}</span>
                    <span class="shrink-0 ml-2">${{ number_format($item->quantity * $item->menuItem->price, 2) }}</span>
                </div>
                @empty
                <p class="text-gray-500 dark:text-gray-400 text-sm">Your cart is empty.</p>
                @endforelse
            </div>
>>>>>>> 5b466fb (more reliable and front-end changes)
            <hr class="my-3 dark:border-gray-700">
            <div class="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span class="text-green-600 dark:text-green-400">${{ number_format($total, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
