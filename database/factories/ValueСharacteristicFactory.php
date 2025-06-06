<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ValueСharacteristic>
 */
class ValueСharacteristicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1, 810000),
            'value' => fake()->jobTitle(),
            'description' => fake()->text(),
        ];
    }
}
