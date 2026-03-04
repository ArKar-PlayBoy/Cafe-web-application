@extends('layouts.admin')

@section('title', 'Edit Stock Item')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Stock Item</h1>

<form action="{{ route('admin.stock.update', $stock->id) }}" method="POST" class="max-w-2xl">
    @csrf
    @method('PUT')
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Name</label>
        <input type="text" name="name" value="{{ $stock->name }}" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" required>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-2">Current Quantity</label>
            <input type="number" name="current_quantity" value="{{ $stock->current_quantity }}" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Min Quantity (Alert Level)</label>
            <input type="number" name="min_quantity" value="{{ $stock->min_quantity }}" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" required>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium mb-2">Barcode (Optional)</label>
            <input type="text" name="barcode" value="{{ $stock->barcode }}" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700">
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Bin Location</label>
            <input type="text" name="bin_location" value="{{ $stock->bin_location }}" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700">
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Category</label>
        <select name="category" class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700" required>
            <option value="ingredient" {{ $stock->category == 'ingredient' ? 'selected' : '' }}>Ingredient</option>
            <option value="supply" {{ $stock->category == 'supply' ? 'selected' : '' }}>Supply</option>
        </select>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.stock.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
    </div>
</form>
@endsection
