@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Users</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add User</a>
</div>

<<<<<<< HEAD
<div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/50 overflow-hidden">
=======
<div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border border-gray-100 dark:border-slate-700 rounded-2xl shadow-lg overflow-hidden transition-all duration-300">
>>>>>>> 5b466fb (more reliable and front-end changes)
    <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Role</th>
<<<<<<< HEAD
=======
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
>>>>>>> 5b466fb (more reliable and front-end changes)
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($users as $user)
<<<<<<< HEAD
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
=======
            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors duration-200">
>>>>>>> 5b466fb (more reliable and front-end changes)
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded {{ $user->role && $user->role->name === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' : ($user->role && $user->role->name === 'staff' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                        {{ $user->role ? ucfirst($user->role->name) : 'Customer' }}
                    </span>
                </td>
<<<<<<< HEAD
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $user->phone ?? '-' }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline mr-3">Edit</a>
                    @if(!$user->role || $user->role->name !== 'admin')
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
=======
                <td class="px-6 py-4">
                    @if($user->isBanned())
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">Banned</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Active</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $user->phone ?? '-' }}</td>
                <td class="px-6 py-4">
                    @if(!$user->role || $user->role->name !== 'admin')
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline mr-3">Edit</a>
                        @if($user->isBanned())
                            <form action="{{ route('admin.users.unban', $user->id) }}" method="POST" class="inline mr-3">
                                @csrf
                                <button type="submit" class="text-green-600 dark:text-green-400 hover:underline">Unban</button>
                            </form>
                        @else
                            <button type="button" onclick="showBanModal({{ $user->id }}, &quot;{{ $user->name }}&quot;)" class="text-orange-600 dark:text-orange-400 hover:underline mr-3">Ban</button>
                        @endif
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
>>>>>>> 5b466fb (more reliable and front-end changes)
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<<<<<<< HEAD
</div>
=======
    <div class="px-6 py-4">
        {{ $users->links() }}
    </div>
</div>

<div id="banModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl p-6 w-full max-w-md shadow-2xl">
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Ban User</h2>
        <p class="mb-4 text-gray-700 dark:text-gray-300">Are you sure you want to ban <span id="banUserName" class="font-semibold"></span>?</p>
        <form id="banForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="ban_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reason (optional)</label>
                <input type="text" name="ban_reason" id="ban_reason" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700 dark:text-gray-100" placeholder="Reason for ban">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="hideBanModal()" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-100 rounded hover:bg-gray-400 dark:hover:bg-gray-500">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">Ban User</button>
            </div>
        </form>
    </div>
</div>

<script>
function showBanModal(userId, userName) {
    document.getElementById('banUserName').textContent = userName;
    document.getElementById('banForm').action = '/admin/users/' + userId + '/ban';
    document.getElementById('banModal').classList.remove('hidden');
    document.getElementById('banModal').classList.add('flex');
}

function hideBanModal() {
    document.getElementById('banModal').classList.add('hidden');
    document.getElementById('banModal').classList.remove('flex');
}
</script>
>>>>>>> 5b466fb (more reliable and front-end changes)
@endsection
