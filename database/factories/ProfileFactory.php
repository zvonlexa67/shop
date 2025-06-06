<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            // 'id' => User::factory()->create()->id,
            'type' => 0,
            'telegram' => '@'.fake()->company(),
            'whatsapp' => fake()->domainWord(),
            'site' => fake()->url(),
            'vk' => fake()->domainWord(),
            'inn' => fake()->numberBetween(11111111111, 99999999999),
            'ogrnip' => fake()->numberBetween(11111111111, 99999999999),
            'phone' => ['home' => fake()->phoneNumber(), 'work' => fake()->phoneNumber()],
            'email' => ['user1' => fake()->safeEmail(), 'user2' => fake()->safeEmail(), 'user3' => fake()->safeEmail()],
        ];
    }
}
