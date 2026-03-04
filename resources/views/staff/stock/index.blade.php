@extends('layouts.staff')

@section('title', 'Stock')

@section('content')
<h1 class="text-2xl font-bold mb-6">Stock Overview</h1>

@if($alerts->count() > 0)
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
    <p class="font-bold">Low Stock Alerts!</p>
    <ul class="list-disc list-inside">
        @foreach($alerts->take(5) as $alert)
            <li>{{ $alert->stockItem->name }} - Current: {{ $alert->stockItem->current_quantity }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Qty</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 dark:text-gray-300 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($stockItems as $stock)
            <tr class="text-slate-800 dark:text-white">
                <td class="px-6 py-4">{{ $stock->name }}</td>
                <td class="px-6 py-4 font-bold text-lg">{{ $stock->current_quantity }}</td>
                <td class="px-6 py-4">
                    @if($stock->isLowStock())
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">Low Stock</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">OK</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('staff.stock.adjust.form', $stock->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Adjust</a>
                        <a href="{{ route('staff.stock.in.form', $stock->id) }}" class="bg-green-500 text-white px-3 py-1 rounded text-sm">Add</a>
                        <a href="{{ route('staff.stock.waste.form', $stock->id) }}" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Waste</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
