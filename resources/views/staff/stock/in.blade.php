@extends('layouts.staff')

@section('title', 'Add Stock - ' . $stock->name)

@section('content')
<h1 class="text-2xl font-bold mb-6 dark:text-white">Add Stock: {{ $stock->name }}</h1>

<div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded">
    <p class="text-gray-600 dark:text-gray-300">Current Quantity: <span class="font-bold">{{ $stock->current_quantity }}</span></p>
</div>

<form action="{{ route('staff.stock.in', $stock->id) }}" method="POST" class="max-w-lg">
    @csrf
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2 dark:text-gray-300">Quantity to Add</label>
        <input type="number" name="quantity" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" min="1" required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-2 dark:text-gray-300">Cost (Optional)</label>
        <input type="number" name="cost" step="0.01" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-2 dark:text-gray-300">Expiry Date (Optional)</label>
        <input type="date" name="expiry_date" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-2 dark:text-gray-300">Note (Optional)</label>
        <textarea name="note" rows="2" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700"></textarea>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Add Stock</button>
        <a href="{{ route('staff.stock.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
    </div>
</form>
@endsection
