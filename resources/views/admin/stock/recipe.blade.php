@extends('layouts.admin')

@section('title', 'Configure Recipe - ' . $stock->name)

@section('content')
<h1 class="text-2xl font-bold mb-6">Configure Recipe for {{ $stock->name }}</h1>
<p class="mb-4 text-gray-600 dark:text-gray-400">Set how much of this stock item is needed for each menu item.</p>

<form action="{{ route('admin.stock.recipe.update', $stock->id) }}" method="POST" class="max-w-4xl">
    @csrf
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow dark:shadow-gray-900/50 overflow-hidden mb-6">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Menu Item</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity Needed</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($menuItems as $menuItem)
                <tr>
                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $menuItem->name }}</td>
                    <td class="px-6 py-4">
                        <input type="number" name="recipes[{{ $menuItem->id }}]" 
                            value="{{ $menuItem->stockItems->contains($stock->id) ? $menuItem->stockItems->find($stock->id)->pivot->quantity_needed : 0 }}"
                            min="0" 
                            class="w-24 border rounded px-3 py-2 dark:bg-gray-800 dark:border-gray-700">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex gap-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save Recipe</button>
        <a href="{{ route('admin.stock.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
    </div>
</form>
@endsection
