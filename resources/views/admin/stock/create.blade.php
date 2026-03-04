@extends('layouts.admin')

@section('title', 'Add Stock Item')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add Stock Item</h1>

<form action="{{ route('admin.stock.store') }}" method="POST" class="max-w-2xl">
    @csrf
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" required>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-2">Initial Quantity</label>
            <input type="number" name="current_quantity" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" value="0" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Min Quantity (Alert Level)</label>
            <input type="number" name="min_quantity" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" value="10" required>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-2">Barcode (Optional)</label>
            <input type="text" name="barcode" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700">
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Bin Location</label>
            <input type="text" name="bin_location" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" placeholder="e.g., Walk-in Fridge">
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Category</label>
        <select name="category" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" required>
            <option value="ingredient">Ingredient</option>
            <option value="supply">Supply</option>
        </select>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create</button>
        <a href="{{ route('admin.stock.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
    </div>
</form>
@endsection
