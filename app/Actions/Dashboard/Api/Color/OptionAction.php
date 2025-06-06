<?php

namespace  App\Actions\Dashboard\Api\Color;

use App\Http\Resources\Dashboard\Color\OptionCollection;
use App\Models\Color;

class OptionAction
{
    public function __invoke(): OptionCollection
    {
        return OptionCollection::make(Color::query()->orderBy('sort')->orderBy('id')->get());
    }
}