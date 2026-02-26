@extends('layouts.app')

@section('title', 'Make Reservation')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('reservations.index') }}" class="text-green-600 dark:text-green-400 hover:underline mb-4 inline-block">&larr; Back to Reservations</a>
    
    <h1 class="text-3xl font-serif font-bold mb-6">Make a Reservation</h1>

    <form action="{{ route('reservations.store') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 max-w-2xl">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Date</label>
                <input type="date" name="reservation_date" class="w-full border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2" min="{{ date('Y-m-d') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Time</label>
                <input type="time" name="reservation_time" class="w-full border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2" required>
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Party Size</label>
            <select name="party_size" class="w-full border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2" required>
                @for($i = 1; $i <= 20; $i++)
                <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'person' : 'persons' }}</option>
                @endfor
            </select>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Table (Optional)</label>
            <select name="table_id" class="w-full border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2">
                <option value="">Auto-assign</option>
                @foreach($tables as $table)
                <option value="{{ $table->id }}">Table {{ $table->table_number }} (Capacity: {{ $table->capacity }})</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Notes</label>
            <textarea name="notes" class="w-full border dark:border-gray-600 dark:bg-gray-700 rounded-lg px-3 py-2" rows="3" placeholder="Special requests..."></textarea>
        </div>
        <button type="submit" class="mt-6 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold">Confirm Reservation</button>
    </form>
</div>
@endsection
