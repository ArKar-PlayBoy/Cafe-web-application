<?php

namespace Database\Factories;

use App\Models\CafeTable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'table_id' => CafeTable::factory(),
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'reservation_time' => $this->faker->time('H:i:s'),
            'party_size' => $this->faker->numberBetween(1, 8),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed']),
            'notes' => $this->faker->sentence(),
        ];
    }
}
