<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'watsapp' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'vk' => fake()->url(),
            'telegram' => '@'.fake()->company(),
            // 'vk' => fake()->url(),
            'youtube' => fake()->url(),
            'rutube' => fake()->url(),
            'address' => fake()->address(),
        ];
    }
}
