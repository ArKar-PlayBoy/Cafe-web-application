<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $drinks = Category::where('slug', 'drinks')->first();
        $food = Category::where('slug', 'food')->first();
        $pastries = Category::where('slug', 'pastries')->first();

        $menuItems = [
            [
                'category_id' => $drinks->id,
                'name' => 'Espresso',
                'description' => 'Strong and bold Italian coffee',
                'price' => 3.50,
                'featured_image' => '/images/menu-1.svg',
                'is_available' => true,
            ],
            [
                'category_id' => $drinks->id,
                'name' => 'Cappuccino',
                'description' => 'Smooth espresso with steamed milk foam',
                'price' => 4.50,
                'featured_image' => '/images/menu-2.svg',
                'is_available' => true,
            ],
            [
                'category_id' => $pastries->id,
                'name' => 'Croissant',
                'description' => 'Flaky, buttery French pastry',
                'price' => 3.00,
                'featured_image' => '/images/menu-3.svg',
                'is_available' => true,
            ],
            [
                'category_id' => $pastries->id,
                'name' => 'Blueberry Muffin',
                'description' => 'Soft muffin loaded with fresh blueberries',
                'price' => 3.50,
                'featured_image' => '/images/menu-4.svg',
                'is_available' => true,
            ],
            [
                'category_id' => $food->id,
                'name' => 'Caesar Salad',
                'description' => 'Fresh romaine lettuce with Caesar dressing',
                'price' => 8.00,
                'featured_image' => '/images/menu-5.svg',
                'is_available' => true,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }
    }
}
