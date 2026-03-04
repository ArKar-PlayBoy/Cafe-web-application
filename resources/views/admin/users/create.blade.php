@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add User</h1>

@if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Name</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Role</label>
        <select name="role_id" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="">Customer</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Phone</label>
        <input type="text" name="phone" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Address</label>
        <textarea name="address" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="2"></textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create</button>
    <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
</form>
@endsection
