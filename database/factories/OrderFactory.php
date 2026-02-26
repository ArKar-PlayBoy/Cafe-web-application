<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['pending', 'preparing', 'ready', 'completed']),
            'total' => $this->faker->randomFloat(2, 5, 50),
            'payment_method' => $this->faker->randomElement(['cod', 'mpu', 'visa', 'kbz_pay']),
            'payment_status' => 'paid',
        ];
    }
}
