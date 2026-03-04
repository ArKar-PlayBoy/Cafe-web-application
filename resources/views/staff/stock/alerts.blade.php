@extends('layouts.staff')

@section('title', 'Stock Alerts')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold dark:text-white">Stock Alerts</h1>
    <a href="{{ route('staff.stock.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/50 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock Item</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Current Qty</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Min Level</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($alerts as $alert)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($alert->type === 'low_stock')
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">Low Stock</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300">Expiring</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $alert->stockItem->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 font-bold">{{ $alert->stockItem->current_quantity }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">{{ $alert->stockItem->min_quantity }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No alerts.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
