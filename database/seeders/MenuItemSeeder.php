<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
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
=======
        $coffee = Category::where('slug', 'coffee')->first();
        $tea = Category::where('slug', 'tea')->first();
        $frappuccino = Category::where('slug', 'frappuccino')->first();
        $coldDrinks = Category::where('slug', 'cold-drinks')->first();
        $pastries = Category::where('slug', 'pastries')->first();
        $food = Category::where('slug', 'food')->first();

        $menuItems = [
            // Coffee drinks
            [
                'category_id' => $coffee->id,
                'name' => 'Caffè Latte',
                'description' => 'Rich espresso with steamed milk and a light layer of foam. A smooth, creamy classic.',
                'price' => 4.50,
                'featured_image' => 'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $coffee->id,
                'name' => 'Caffè Mocha',
                'description' => 'Espresso with chocolate, steamed milk, and whipped cream. Perfect for chocolate lovers.',
                'price' => 5.25,
                'featured_image' => 'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $coffee->id,
                'name' => 'Americano',
                'description' => 'Espresso shots topped with hot water. Rich, bold flavor with a smooth finish.',
                'price' => 3.75,
                'featured_image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $coffee->id,
                'name' => 'Cappuccino',
                'description' => 'Espresso with steamed milk foam. Bold espresso with a creamy, velvety texture.',
                'price' => 4.25,
                'featured_image' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $coffee->id,
                'name' => 'Flat White',
                'description' => 'Espresso with microfoam milk. Smooth and creamy with a rich coffee taste.',
                'price' => 4.75,
                'featured_image' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $coffee->id,
                'name' => 'Caramel Macchiato',
                'description' => 'Vanilla, steamed milk, espresso, and caramel drizzle. Sweet and indulgent.',
                'price' => 5.50,
                'featured_image' => 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $coffee->id,
                'name' => 'Espresso',
                'description' => 'Pure, concentrated coffee served in small shots. Bold and intense flavor.',
                'price' => 3.00,
                'featured_image' => 'https://images.unsplash.com/photo-1510707577719-ae7c14805e3a?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            // Tea
            [
                'category_id' => $tea->id,
                'name' => 'Chai Latte',
                'description' => 'Spiced black tea with steamed milk. Warm, aromatic, and perfectly spiced.',
                'price' => 4.50,
                'featured_image' => 'https://images.unsplash.com/photo-1571934811356-5cc061b6821f?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $tea->id,
                'name' => 'Matcha Latte',
                'description' => 'Premium Japanese matcha green tea with steamed milk. Creamy and earthy.',
                'price' => 5.00,
                'featured_image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $tea->id,
                'name' => 'English Breakfast',
                'description' => 'Classic black tea blend. Robust and full-bodied, perfect for the morning.',
                'price' => 3.50,
                'featured_image' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            // Frappuccino
            [
                'category_id' => $frappuccino->id,
                'name' => 'Coffee Frappuccino',
                'description' => 'Blended coffee with ice, milk, and vanilla. Cool and refreshing.',
                'price' => 5.25,
                'featured_image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $frappuccino->id,
                'name' => 'Caramel Frappuccino',
                'description' => 'Blended coffee with caramel, milk, and ice. Sweet and creamy.',
                'price' => 5.75,
                'featured_image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            // Cold Drinks
            [
                'category_id' => $coldDrinks->id,
                'name' => 'Iced Latte',
                'description' => 'Espresso and cold milk over ice. Smooth, refreshing, and perfect for warm days.',
                'price' => 4.75,
                'featured_image' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $coldDrinks->id,
                'name' => 'Cold Brew',
                'description' => 'Smooth, slow-steeped coffee served cold. Less acidic and incredibly smooth.',
                'price' => 4.50,
                'featured_image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $coldDrinks->id,
                'name' => 'Iced Americano',
                'description' => 'Espresso shots over cold water and ice. Bold and refreshing.',
                'price' => 4.00,
                'featured_image' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            // Pastries
            [
                'category_id' => $pastries->id,
                'name' => 'Butter Croissant',
                'description' => 'Flaky, buttery French pastry. Light, airy, and perfectly baked.',
                'price' => 3.50,
                'featured_image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400&h=300&fit=crop',
>>>>>>> 5b466fb (more reliable and front-end changes)
                'is_available' => true,
            ],
            [
                'category_id' => $pastries->id,
                'name' => 'Blueberry Muffin',
<<<<<<< HEAD
                'description' => 'Soft muffin loaded with fresh blueberries',
                'price' => 3.50,
                'featured_image' => '/images/menu-4.svg',
=======
                'description' => 'Soft muffin loaded with fresh blueberries. Sweet and satisfying.',
                'price' => 3.75,
                'featured_image' => 'https://images.unsplash.com/photo-1607958996333-41aef7caefaa?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $pastries->id,
                'name' => 'Chocolate Danish',
                'description' => 'Flaky pastry filled with rich chocolate. A sweet treat for any time.',
                'price' => 4.00,
                'featured_image' => 'https://images.unsplash.com/photo-1509365390695-33aee754301f?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            // Food
            [
                'category_id' => $food->id,
                'name' => 'Avocado Toast',
                'description' => 'Smashed avocado on artisan bread with cherry tomatoes and sea salt.',
                'price' => 8.50,
                'featured_image' => 'https://images.unsplash.com/photo-1541519227354-08fa5d50c44d?w=400&h=300&fit=crop',
>>>>>>> 5b466fb (more reliable and front-end changes)
                'is_available' => true,
            ],
            [
                'category_id' => $food->id,
<<<<<<< HEAD
                'name' => 'Caesar Salad',
                'description' => 'Fresh romaine lettuce with Caesar dressing',
                'price' => 8.00,
                'featured_image' => '/images/menu-5.svg',
=======
                'name' => 'Chicken Caesar Salad',
                'description' => 'Grilled chicken, romaine lettuce, parmesan, and Caesar dressing.',
                'price' => 9.50,
                'featured_image' => 'https://images.unsplash.com/photo-1546793665-c74683f339c1?w=400&h=300&fit=crop',
                'is_available' => true,
            ],
            [
                'category_id' => $food->id,
                'name' => 'Turkey & Cheese Sandwich',
                'description' => 'Sliced turkey, Swiss cheese, lettuce, and tomato on freshly baked bread.',
                'price' => 8.00,
                'featured_image' => 'https://images.unsplash.com/photo-1528735602780-2552fd46c7af?w=400&h=300&fit=crop',
>>>>>>> 5b466fb (more reliable and front-end changes)
                'is_available' => true,
            ],
        ];

        foreach ($menuItems as $item) {
<<<<<<< HEAD
            MenuItem::create($item);
=======
            MenuItem::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
>>>>>>> 5b466fb (more reliable and front-end changes)
        }
    }
}
