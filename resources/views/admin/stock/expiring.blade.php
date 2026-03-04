@extends('layouts.admin')

@section('title', 'Expiring Items')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Expiring Items (Next 7 Days)</h1>
    <a href="{{ route('admin.stock.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/50 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock Item</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Batch Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Received Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Expiry Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Days Left</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($expiringItems as $batch)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $batch->stockItem->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 font-bold">{{ $batch->quantity }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">{{ $batch->received_date }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $batch->expiry_date }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php $daysLeft = now()->diffInDays($batch->expiry_date, false); @endphp
                    <span class="px-2 py-1 text-xs rounded {{ $daysLeft <= 3 ? 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300' }}">
                        {{ $daysLeft }} days
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No items expiring soon.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
