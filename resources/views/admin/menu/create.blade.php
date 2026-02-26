@extends('layouts.admin')

@section('title', 'Add Menu Item')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add Menu Item</h1>

<form action="{{ route('admin.menu.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow max-w-2xl">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Description</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" rows="3"></textarea>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Price</label>
        <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Category</label>
        <select name="category_id" class="w-full border rounded px-3 py-2" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Image URL</label>
        <input type="url" name="featured_image" class="w-full border rounded px-3 py-2" placeholder="https://picsum.photos/400/300" required>
    </div>
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" name="is_available" value="1" class="mr-2" checked>
            <span class="font-bold">Available</span>
        </label>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create</button>
    <a href="{{ route('admin.menu.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
</form>
@endsection
