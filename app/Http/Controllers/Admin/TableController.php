<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = CafeTable::all();

        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|unique:cafe_tables,table_number',
            'capacity' => 'required|integer|min:1',
        ]);

        CafeTable::create($validated);

        return redirect()->route('admin.tables.index')->with('success', 'Table created successfully.');
    }

    public function edit(CafeTable $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, CafeTable $table)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|unique:cafe_tables,table_number,'.$table->id,
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,reserved',
        ]);

        $table->update($validated);

        return redirect()->route('admin.tables.index')->with('success', 'Table updated successfully.');
    }

    public function destroy(CafeTable $table)
    {
        $table->delete();

        return redirect()->route('admin.tables.index')->with('success', 'Table deleted successfully.');
    }
}
