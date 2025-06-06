<?php

namespace App\Http\Resources\Dashboard\Catalog\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OptionsCatalogCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->title,
            ];
        })->toArray();
    }
}
