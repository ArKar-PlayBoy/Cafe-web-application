<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 2, 15),
<<<<<<< HEAD
            'featured_image' => 'https://picsum.photos/400/300?random=' . $this->faker->unique()->numberBetween(1, 100),
=======
            'featured_image' => 'https://picsum.photos/400/300?random='.$this->faker->unique()->numberBetween(1, 100),
>>>>>>> 5b466fb (more reliable and front-end changes)
            'is_available' => true,
        ];
    }
}
