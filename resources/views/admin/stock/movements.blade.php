@extends('layouts.admin')

@section('title', 'Stock History - ' . $stock->name)

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Stock History: {{ $stock->name }}</h1>
    <a href="{{ route('admin.stock.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
</div>

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <p class="text-sm text-gray-500">Current Stock</p>
        <p class="text-2xl font-bold">{{ $stock->current_quantity }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <p class="text-sm text-gray-500">Min Level</p>
        <p class="text-2xl font-bold">{{ $stock->min_quantity }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <p class="text-sm text-gray-500">Status</p>
        <p class="text-2xl font-bold {{ $stock->isLowStock() ? 'text-red-600' : 'text-green-600' }}">
            {{ $stock->isLowStock() ? 'Low Stock' : 'OK' }}
        </p>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/50 overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Note</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($movements as $movement)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                    {{ $movement->created_at->format('Y-m-d H:i') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $typeColors = [
                            'in' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
                            'out' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300',
                            'waste' => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300',
                            'deduction' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/50 dark:text-orange-300',
                            'adjustment' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300',
                        ];
                    @endphp
                    <span class="px-2 py-1 text-xs rounded {{ $typeColors[$movement->type] ?? 'bg-gray-100' }}">
                        {{ ucfirst($movement->type) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 {{ $movement->quantity_change > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $movement->quantity_change > 0 ? '+' : '' }}{{ $movement->quantity_change }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">
                    {{ $movement->user->name ?? 'System' }}
                </td>
                <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                    {{ $movement->note ?? '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No movements found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
