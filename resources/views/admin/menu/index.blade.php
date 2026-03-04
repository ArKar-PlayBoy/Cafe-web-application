@extends('layouts.admin')

@section('title', 'Menu Items')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Menu Items</h1>
    <a href="{{ route('admin.menu.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Menu Item</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($menuItems as $item)
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border border-gray-100 dark:border-slate-700 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <img src="{{ $item->featured_image }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">{{ $item->name }}</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $item->category->name }}</p>
            <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $item->description }}</p>
            <div class="flex justify-between items-center mt-4">
                <span class="text-xl font-bold text-gray-900 dark:text-gray-100">${{ number_format($item->price, 2) }}</span>
                <span class="px-2 py-1 text-xs rounded {{ $item->is_available ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' }}">
                    {{ $item->is_available ? 'Available' : 'Unavailable' }}
                </span>
            </div>
            <div class="flex gap-2 mt-4">
                <a href="{{ route('admin.menu.edit', $item->id) }}" class="bg-amber-500 text-white px-3 py-1 rounded-lg hover:bg-amber-600 transition-colors shadow-sm hover:shadow active:scale-95">Edit</a>
                <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-rose-600 text-white px-3 py-1 rounded-lg hover:bg-rose-700 transition-colors shadow-sm hover:shadow active:scale-95" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
