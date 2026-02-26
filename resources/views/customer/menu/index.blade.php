@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-serif font-bold mb-2">Our Menu</h1>
    <p class="text-gray-600 dark:text-gray-400 mb-6">Discover our selection of coffee, pastries, and more</p>
    
    <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
        <a href="{{ route('menu') }}" class="px-4 py-2 rounded-full whitespace-nowrap {{ !request('category') ? 'bg-green-600 text-white' : 'bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
            All
        </a>
        @foreach($categories as $category)
        <a href="{{ route('menu', ['category' => $category->id]) }}" class="px-4 py-2 rounded-full whitespace-nowrap {{ request('category') == $category->id ? 'bg-green-600 text-white' : 'bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
            {{ $category->name }}
        </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($menuItems as $item)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
            <img src="{{ $item->featured_image }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="font-semibold text-lg">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->category->name }}</p>
                    </div>
                    <span class="text-xl font-bold text-green-600 dark:text-green-400">${{ number_format($item->price, 2) }}</span>
                </div>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">{{ $item->description }}</p>
                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 text-white py-2.5 rounded-lg hover:bg-green-700 transition-colors">Add to Cart</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
