<?php

namespace Database\Seeders;

// use App\Models\GroupСharacteristic;
// use App\Models\NameСharacteristic;
// use App\Models\ValueСharacteristic;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    // use WithoutModelEvents;

    protected $characteristics = [
        [
            'name' => 'Основные характеристики',
            'children' => [
                'Цвет',
                'Диаметр / Типоразмер',
                'Количество динамиков',
                'Объем короба, л',
            ],
        ],
        [
            'name' => 'Материалы',
            'children' => [
                'Материал короба',
            ],
        ],
        [
            'name' => 'Монтажные размеры',
            'children' => [
                'Монтажный диаметр, мм',
                'Глубина потая (углубления) сабвуфера, мм',
            ],
        ],
        [
            'name' => 'Другое',
            'children' => [
                'Сторона размещения',
                'Место установки акустического короба',
                'Цвет корпуса акустического короба',
                'Труба входит в комплект',
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->characteristics as $item) {
            $root = Characteristic::create([
                'title' => $item['name'],
                'description' => fake()->text(60),
            ]);
            foreach($item['children'] as $child){
                Characteristic::create([
                    'title' => $child,
                    'smart' => rand(0, 1),
                    'type' => rand(1, 5),
                    'description' => fake()->text(30),
                ], $root);
            }
        }

        // Characteristic::create([
        //     'title' => '',
        //     'smart' => rand(0, 1),
        //     'type' => rand(1, 5),
        //     'description' => fake()->text(30),
        // ], $root);

        // for ($v = 0; $v < 15; $v++) {
        //     $group = Characteristic::create([
        //         'title' => fake()->name(),
        //         'description' => fake()->text(30),
        //     ]);

        //     for ($k = 0; $k < 10; $k++) {
        //         Characteristic::create([
        //             'title' => fake()->title(),
        //             'smart' => rand(0, 1),
        //             'type' => rand(1, 5),
        //             'description' => fake()->text(30),
        //         ], $group);
        //     }
        // }
    }
}
