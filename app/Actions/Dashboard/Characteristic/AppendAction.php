<?php

namespace App\Actions\Dashboard\Characteristic;

use App\Models\Characteristic;

class AppendAction
{
    public function __invoke(Characteristic $temp, $data): array
    {
        if ($temp->parent_id) {
            $root = $temp->parent;

            $model = Characteristic::create([
                'title' => $data->title,
                'sort' => $data->sort,
                'smart' => $data->smart,
                'category_id' => $data->category_id,
                'type' => $data->type,
                'description' => $data->description,
            ], $root);
        } else {
            $model = Characteristic::create([
                'title' => $data->title,
                'sort' => $data->sort,
                'description' => $data->description,
                'category_id' => $data->category_id,
            ]);
        }

        return [ 'category_id' => $model->category_id, 'characteristic_id' => $model->id ];
    }
}
