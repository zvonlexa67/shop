<?php

namespace App\Actions\Dashboard\Characteristic;

use App\Models\Characteristic;

class CreateAction
{
    public function __invoke($data): array
    {
        $model = Characteristic::create([
            'parent_id' => $data->parent_id,
            'title' => $data->title,
            'sort' => $data->sort,
            'smart' => $data->smart,
            'type' => $data->type,
            'description' => $data->description,
        ]);




        // if ($data->parent_id) {
        //     $model = Characteristic::create([
        //         'title' => $data->title,
        //         'sort' => $data->sort,
        //         'smart' => $data->smart,
        //         'category_id' => $data->category_id,
        //         'type' => $data->type,
        //         'description' => $data->description,
        //     ], $root);
        // } else {
        //     $model = Characteristic::create([
        //         'title' => $data->title,
        //         'sort' => $data->sort,
        //         'description' => $data->description,
        //         'category_id' => $data->category_id,
        //     ]);
        // }

        return [ 'characteristic_id' => $model->id ];
    }
}