<?php

namespace App\Actions\Dashboard\Dimension;

use App\Http\Resources\Dashboard\Dimension\DimensionCollection;
use App\Models\Dimension;

class IndexAction
{
    public function __invoke(): array
    {
        return ['dimensions' => fn() => DimensionCollection::make(Dimension::query()->orderBy('sort')->orderBy('id')->get())];
    }
}
