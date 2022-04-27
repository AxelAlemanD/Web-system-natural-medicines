<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->sentence,
            'description'   => $this->faker->paragraph,
            'url_image'     => 'https://picsum.photos/200/200?random='.rand(1, 100),
            'price'         => $this->faker->randomFloat(2, 100, 10000),
            'quantity'      => $this->faker->numberBetween(1, 50),
        ];
    }
}
