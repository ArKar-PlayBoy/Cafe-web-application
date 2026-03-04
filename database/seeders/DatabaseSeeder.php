<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            CafeTableSeeder::class,
            MenuItemSeeder::class,
            UserSeeder::class,
<<<<<<< HEAD
=======
            StockItemSeeder::class,
>>>>>>> 5b466fb (more reliable and front-end changes)
        ]);
    }
}
