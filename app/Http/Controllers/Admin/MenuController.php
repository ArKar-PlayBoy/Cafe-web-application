<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('category')->latest()->get();
<<<<<<< HEAD
=======

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('admin.menu.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = Category::all();
<<<<<<< HEAD
=======

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
<<<<<<< HEAD
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'required|string',
            'is_available' => 'boolean',
        ]);

        MenuItem::create($validated);
=======
            'description' => 'nullable|string|max:5000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'required|url|max:2048',
            'is_available' => 'sometimes|boolean',
        ]);
        $validated['featured_image'] = strip_tags($validated['featured_image']);
        $validated['is_available'] = $request->boolean('is_available');

        MenuItem::create($validated);

>>>>>>> 5b466fb (more reliable and front-end changes)
        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menu)
    {
        $categories = Category::all();
<<<<<<< HEAD
=======

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('admin.menu.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
<<<<<<< HEAD
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'required|string',
            'is_available' => 'boolean',
        ]);

        $menu->update($validated);
=======
            'description' => 'nullable|string|max:5000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'required|url|max:2048',
            'is_available' => 'sometimes|boolean',
        ]);
        $validated['featured_image'] = strip_tags($validated['featured_image']);
        $validated['is_available'] = $request->boolean('is_available');

        $menu->update($validated);

>>>>>>> 5b466fb (more reliable and front-end changes)
        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
    }

    public function show(MenuItem $menu)
    {
        return view('admin.menu.show', compact('menu'));
    }
}
