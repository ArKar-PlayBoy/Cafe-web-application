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
        
        return view('customer.menu.index', compact('menuItems', 'categories'));
    }
}
