<?php

namespace App\Http\Resources\Dashboard\Catalog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemsCatalogCollection extends ResourceCollection
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
                'slug' => $item->slug,
                'image' => is_null($item->picture) ? null : $item->picture['image'],
                'icon' => is_null($item->picture) ? null : $item->picture['icon'],
            ];
        })->toArray();
    }
}
