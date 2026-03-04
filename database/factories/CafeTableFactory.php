<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CafeTableFactory extends Factory
{
    public function definition(): array
    {
        return [
<<<<<<< HEAD
            'table_number' => 'T' . $this->faker->unique()->numberBetween(1, 20),
=======
            'table_number' => 'T'.$this->faker->unique()->numberBetween(1, 20),
>>>>>>> 5b466fb (more reliable and front-end changes)
            'capacity' => $this->faker->randomElement([2, 4, 6, 8]),
            'status' => 'available',
        ];
    }
}
