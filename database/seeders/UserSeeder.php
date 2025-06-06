<?php

namespace Database\Seeders;

// use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    // use WithoutModelEvents;

    public $count = 30;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory($this->count)
        //     ->has(Profile::factory(), 'profile')
        //     ->create();

        User::create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
            ]);
        // User::factory()
        //     ->has(Profile::factory(), 'profile')
        //     ->create([
        //         'name' => 'admin',
        //         'email' => 'admin@example.com',
        //         'password' => Hash::make('admin'),
        //     ]);
    }
}
