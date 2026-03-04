<?php

namespace Database\Seeders;

use App\Models\StockItem;
use Illuminate\Database\Seeder;

class StockItemSeeder extends Seeder
{
    public function run(): void
    {
        $stockItems = [
            // Ingredients - Beverages
            ['name' => 'Coffee Beans', 'category' => 'ingredient', 'min_quantity' => 20, 'bin_location' => 'Dry Storage A'],
            ['name' => 'Milk', 'category' => 'ingredient', 'min_quantity' => 30, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Oat Milk', 'category' => 'ingredient', 'min_quantity' => 15, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Almond Milk', 'category' => 'ingredient', 'min_quantity' => 15, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Soy Milk', 'category' => 'ingredient', 'min_quantity' => 15, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Chocolate Syrup', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Dry Storage B'],
            ['name' => 'Vanilla Syrup', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Dry Storage B'],
            ['name' => 'Caramel Syrup', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Dry Storage B'],
            ['name' => 'Honey Syrup', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Dry Storage B'],
            ['name' => 'Matcha Powder', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Dry Storage A'],
            ['name' => 'Tea Bags (Black)', 'category' => 'ingredient', 'min_quantity' => 50, 'bin_location' => 'Dry Storage A'],
            ['name' => 'Tea Bags (Green)', 'category' => 'ingredient', 'min_quantity' => 30, 'bin_location' => 'Dry Storage A'],
            ['name' => 'Chai Concentrate', 'category' => 'ingredient', 'min_quantity' => 15, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Ice', 'category' => 'ingredient', 'min_quantity' => 100, 'bin_location' => 'Freezer'],

            // Ingredients - Food
            ['name' => 'Flour', 'category' => 'ingredient', 'min_quantity' => 20, 'bin_location' => 'Dry Storage A'],
            ['name' => 'Sugar', 'category' => 'ingredient', 'min_quantity' => 20, 'bin_location' => 'Dry Storage A'],
            ['name' => 'Brown Sugar', 'category' => 'ingredient', 'min_quantity' => 15, 'bin_location' => 'Dry Storage A'],
            ['name' => 'Eggs', 'category' => 'ingredient', 'min_quantity' => 30, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Butter', 'category' => 'ingredient', 'min_quantity' => 15, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Heavy Cream', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Strawberry Jam', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Dry Storage B'],
            ['name' => 'Chocolate Spread', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Dry Storage B'],
            ['name' => 'Whipped Cream', 'category' => 'ingredient', 'min_quantity' => 10, 'bin_location' => 'Walk-in Fridge'],
            ['name' => 'Fresh Fruits', 'category' => 'ingredient', 'min_quantity' => 20, 'bin_location' => 'Walk-in Fridge'],

            // Supplies - Packaging
            ['name' => 'Paper Cups (8oz)', 'category' => 'supply', 'min_quantity' => 100, 'bin_location' => 'Storage Room'],
            ['name' => 'Paper Cups (12oz)', 'category' => 'supply', 'min_quantity' => 100, 'bin_location' => 'Storage Room'],
            ['name' => 'Paper Cups (16oz)', 'category' => 'supply', 'min_quantity' => 100, 'bin_location' => 'Storage Room'],
            ['name' => 'Glass Cups', 'category' => 'supply', 'min_quantity' => 30, 'bin_location' => 'Storage Room'],
            ['name' => 'Straws', 'category' => 'supply', 'min_quantity' => 200, 'bin_location' => 'Storage Room'],
            ['name' => 'Lids (8oz)', 'category' => 'supply', 'min_quantity' => 100, 'bin_location' => 'Storage Room'],
            ['name' => 'Lids (12oz)', 'category' => 'supply', 'min_quantity' => 100, 'bin_location' => 'Storage Room'],
            ['name' => 'Lids (16oz)', 'category' => 'supply', 'min_quantity' => 100, 'bin_location' => 'Storage Room'],
            ['name' => 'Paper Bags', 'category' => 'supply', 'min_quantity' => 50, 'bin_location' => 'Storage Room'],
            ['name' => 'Takeout Boxes', 'category' => 'supply', 'min_quantity' => 30, 'bin_location' => 'Storage Room'],

            // Supplies - Utensils & Other
            ['name' => 'Napkins', 'category' => 'supply', 'min_quantity' => 200, 'bin_location' => 'Storage Room'],
            ['name' => 'Stirrers', 'category' => 'supply', 'min_quantity' => 100, 'bin_location' => 'Storage Room'],
            ['name' => 'Forks', 'category' => 'supply', 'min_quantity' => 50, 'bin_location' => 'Storage Room'],
            ['name' => 'Spoons', 'category' => 'supply', 'min_quantity' => 50, 'bin_location' => 'Storage Room'],
            ['name' => 'Knives', 'category' => 'supply', 'min_quantity' => 30, 'bin_location' => 'Storage Room'],
            ['name' => 'Plates', 'category' => 'supply', 'min_quantity' => 30, 'bin_location' => 'Storage Room'],
            ['name' => 'Tissues', 'category' => 'supply', 'min_quantity' => 50, 'bin_location' => 'Storage Room'],
            ['name' => 'Sanitizer', 'category' => 'supply', 'min_quantity' => 10, 'bin_location' => 'Storage Room'],
            ['name' => 'Gloves', 'category' => 'supply', 'min_quantity' => 20, 'bin_location' => 'Storage Room'],
            ['name' => 'Cleaning Supplies', 'category' => 'supply', 'min_quantity' => 10, 'bin_location' => 'Storage Room'],
        ];

        foreach ($stockItems as $item) {
            StockItem::firstOrCreate(
                ['name' => $item['name']],
                [
                    'current_quantity' => $item['min_quantity'] * 3,
                    'min_quantity' => $item['min_quantity'],
                    'bin_location' => $item['bin_location'],
                    'category' => $item['category'],
                    'barcode' => 'STK-'.strtoupper(substr($item['name'], 0, 3)).'-'.rand(1000, 9999),
                ]
            );
        }
    }
}
