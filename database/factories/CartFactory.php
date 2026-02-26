<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'menu_item_id' => MenuItem::factory(),
            'quantity' => $this->faker->numberBetween(1, 3),
        ];
    }
}
