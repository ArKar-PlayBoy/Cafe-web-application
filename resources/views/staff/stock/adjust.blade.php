@extends('layouts.staff')

@section('title', 'Adjust Stock - ' . $stock->name)

@section('content')
<h1 class="text-2xl font-bold mb-6 dark:text-white">Adjust Stock: {{ $stock->name }}</h1>

<div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded">
    <p class="text-gray-600 dark:text-gray-300">Current Quantity: <span class="font-bold">{{ $stock->current_quantity }}</span></p>
    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Enter the new quantity to set.</p>
</div>

<form action="{{ route('staff.stock.adjust', $stock->id) }}" method="POST" class="max-w-lg">
    @csrf
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2 dark:text-gray-300">New Quantity</label>
        <input type="number" name="current_quantity" value="{{ $stock->current_quantity }}" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" min="0" required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-2 dark:text-gray-300">Note (Optional)</label>
        <textarea name="note" rows="2" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" placeholder="Reason for adjustment..."></textarea>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Adjust Stock</button>
        <a href="{{ route('staff.stock.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
    </div>
</form>
@endsection
