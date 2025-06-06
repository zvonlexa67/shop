<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    // use WithoutModelEvents;

    public $count = 30;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Catalog::factory($this->count)->has(
        //     Chapter::factory($this->count)->has(
        //         Category::factory($this->count)->has(
        //             Product::factory($this->count)
        //         )
        //     )
        // )
        //     ->create();
    }
}
