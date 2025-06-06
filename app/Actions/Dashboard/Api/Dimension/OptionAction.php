<?php

namespace App\Actions\Dashboard\Api\Dimension;

use App\Http\Resources\Dashboard\Dimension\OptionCollection;
use App\Models\Dimension;

class OptionAction
{
    public function __invoke(): OptionCollection
    {
        return OptionCollection::make(Dimension::query()->orderBy('sort')->orderBy('id')->get());
    }
}
