@extends('layouts.admin')

@section('title', 'Edit Table')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Table</h1>

<form action="{{ route('admin.tables.update', $table->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow max-w-lg">
    @csrf @method('PUT')
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Table Number</label>
        <input type="text" name="table_number" value="{{ $table->table_number }}" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Capacity</label>
        <input type="number" name="capacity" value="{{ $table->capacity }}" class="w-full border rounded px-3 py-2" min="1" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Status</label>
        <select name="status" class="w-full border rounded px-3 py-2" required>
            <option value="available" {{ $table->status === 'available' ? 'selected' : '' }}>Available</option>
            <option value="occupied" {{ $table->status === 'occupied' ? 'selected' : '' }}>Occupied</option>
            <option value="reserved" {{ $table->status === 'reserved' ? 'selected' : '' }}>Reserved</option>
        </select>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
    <a href="{{ route('admin.tables.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
</form>
@endsection
