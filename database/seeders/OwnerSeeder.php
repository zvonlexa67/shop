<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Owner::factory()->create();
    }
}
