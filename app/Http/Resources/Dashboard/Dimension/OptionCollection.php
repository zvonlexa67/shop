<?php

namespace App\Http\Resources\Dashboard\Dimension;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OptionCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function($item) {
            return [
                'label' => $item->title,
                'value' => $item->id,
            ];
        })->toArray();
    }
}
