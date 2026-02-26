<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Drinks', 'slug' => 'drinks'],
            ['name' => 'Food', 'slug' => 'food'],
            ['name' => 'Pastries', 'slug' => 'pastries'],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
