<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CafeTableFactory extends Factory
{
    public function definition(): array
    {
        return [
            'table_number' => 'T'.$this->faker->unique()->numberBetween(1, 20),
            'capacity' => $this->faker->randomElement([2, 4, 6, 8]),
            'status' => 'available',
        ];
    }
}
