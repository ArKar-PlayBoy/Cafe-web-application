@extends('layouts.staff')

@section('title', 'Reservations')

@section('content')
<h1 class="text-2xl font-bold mb-6 dark:text-white">Reservations</h1>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Party Size</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($reservations as $reservation)
            <tr class="text-slate-800 dark:text-white">
                <td class="px-6 py-4">#{{ $reservation->id }}</td>
                <td class="px-6 py-4">{{ $reservation->user->name }}</td>
                <td class="px-6 py-4">{{ $reservation->reservation_date }}</td>
                <td class="px-6 py-4">{{ $reservation->reservation_time }}</td>
                <td class="px-6 py-4">{{ $reservation->party_size }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded {{ $reservation->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : ($reservation->status === 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200') }}">
                        {{ ucfirst($reservation->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('staff.reservations.status', $reservation->id) }}" method="POST" class="inline">
                        @csrf @method('PUT')
                        <select name="status" class="border rounded px-2 py-1 text-sm dark:bg-gray-700 dark:text-white" onchange="this.form.submit()">
                            <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $reservation->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
