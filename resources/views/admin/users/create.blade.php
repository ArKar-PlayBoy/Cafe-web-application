@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add User</h1>

<form action="{{ route('admin.users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Role</label>
        <select name="role_id" class="w-full border rounded px-3 py-2" required>
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Phone</label>
        <input type="text" name="phone" class="w-full border rounded px-3 py-2">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">Address</label>
        <textarea name="address" class="w-full border rounded px-3 py-2" rows="2"></textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create</button>
    <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
</form>
@endsection
