<?php

namespace App\Actions\Dashboard\Dimension;

use App\Models\Dimension;

class UpdateAction
{
    public function __invoke($data, int $id): void
    {
        Dimension::query()->where('id', $id)->update([
            'sort' => $data->sort,
            'title' => $data->title,
        ]);

    }
}
