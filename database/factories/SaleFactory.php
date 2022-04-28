<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'       => $this->faker->numberBetween(1, 10),
            'total_amount'  => $this->faker->randomFloat(2, 100, 10000),
            'amount_paid'   => $this->faker->randomFloat(2, 100, 10000),
            'status_id'     => $this->faker->numberBetween(1, 3),
        ];
    }
}
