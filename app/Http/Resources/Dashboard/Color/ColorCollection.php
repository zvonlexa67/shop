<?php

namespace App\Http\Resources\Dashboard\Color;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ColorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(fn($item) => [
            'id' => $item->id,
            'sort' => $item->sort,
            'title' => $item->title,
            'picture_image' => $item->picture_image,
        ])->toArray();
    }
}
