<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
<<<<<<< HEAD
            ['name' => 'Drinks', 'slug' => 'drinks'],
            ['name' => 'Food', 'slug' => 'food'],
            ['name' => 'Pastries', 'slug' => 'pastries'],
        ];
        foreach ($categories as $category) {
            Category::create($category);
=======
            ['name' => 'Coffee', 'slug' => 'coffee'],
            ['name' => 'Tea', 'slug' => 'tea'],
            ['name' => 'Frappuccino', 'slug' => 'frappuccino'],
            ['name' => 'Cold Drinks', 'slug' => 'cold-drinks'],
            ['name' => 'Pastries', 'slug' => 'pastries'],
            ['name' => 'Food', 'slug' => 'food'],
        ];
        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
>>>>>>> 5b466fb (more reliable and front-end changes)
        }
    }
}
