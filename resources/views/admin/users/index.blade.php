@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Users</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add User</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/50 overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded {{ $user->role && $user->role->name === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' : ($user->role && $user->role->name === 'staff' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                        {{ $user->role ? ucfirst($user->role->name) : 'Customer' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $user->phone ?? '-' }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline mr-3">Edit</a>
                    @if(!$user->role || $user->role->name !== 'admin')
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
