@extends('layouts.admin')

@section('title', 'Edit Menu Item')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Menu Item</h1>

<form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow max-w-2xl">
    @csrf @method('PUT')
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" value="{{ $menu->name }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Description</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" rows="3">{{ $menu->description }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Price</label>
        <input type="number" step="0.01" name="price" value="{{ $menu->price }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Category</label>
        <select name="category_id" class="w-full border rounded px-3 py-2" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Image URL</label>
        <input type="url" name="featured_image" value="{{ $menu->featured_image }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="flex items-center">
            <input type="checkbox" name="is_available" value="1" class="mr-2" {{ $menu->is_available ? 'checked' : '' }}>
            <span class="font-bold">Available</span>
        </label>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
    <a href="{{ route('admin.menu.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
</form>
@endsection
