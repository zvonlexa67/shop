<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
// use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $root = Category::create([
            'title' => 'Каталог',
            'count_products' => 0,
        ]);

        // for ($i = 0; $i < 10; $i++) {
        //     $children1 = Category::create([
        //         'title' => fake()->unique()->company(),
        //         'count_products' => 0,
        //     ], $root);

        //     for ($j = 0; $j < 10; $j++) {
        //         $children2 = Category::create([
        //             'title' => fake()->unique()->company(),
        //             'count_products' => 0,
        //         ], $children1);

        //         for ($f = 0; $f < 10; $f++) {
        //             $children3 = Category::create([
        //                 'title' => fake()->unique()->company(),
        //                 'count_products' => 0,
        //             ], $children2);
        //         }
        //     }
        // }
    }
}
