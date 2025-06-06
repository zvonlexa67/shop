<?php

namespace Database\Seeders;

use App\Models\Adv;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvSeeder extends Seeder
{
    // use WithoutModelEvents;

    public $count = 30;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adv::factory($this->count)->create();
    }
}
