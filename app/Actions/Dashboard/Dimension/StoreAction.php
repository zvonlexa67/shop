<?php

namespace App\Actions\Dashboard\Dimension;

use App\Models\Dimension;

class StoreAction
{
    public function __invoke($data): void
    {
        Dimension::create([
            'sort' => $data->sort,
            'title' => $data->title,
        ]);
    }
}
