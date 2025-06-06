<?php

namespace App\Http\Resources\Dashboard\Dimension;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DimensionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'sort' => $item->sort,
                'title' => $item->title,
            ];
        })->toArray();
    }
}
