<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
<<<<<<< HEAD
        
        if ($category) {
            $menuItems = MenuItem::with('category')
                ->where('category_id', $category)
                ->where('is_available', true)
                ->get();
        } else {
            $menuItems = MenuItem::with('category')
                ->where('is_available', true)
                ->get();
        }
        
        $categories = Category::all();
        
=======
        $search = $request->get('search');

        $query = MenuItem::with('category')
            ->where('is_available', true);

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $menuItems = $query->get();
        $categories = Category::all();

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('customer.menu.index', compact('menuItems', 'categories'));
    }
}
