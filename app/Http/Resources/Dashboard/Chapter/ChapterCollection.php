<?php

namespace App\Http\Resources\Dashboard\Chapter;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChapterCollection extends ResourceCollection
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
                'catalog_id' => $item->catalog_id,
                'title' => $item->title,
                'slug' => $item->slug,
                'sort' => $item->sort,
                'image' => is_null($item->picture) ? null : $item->picture['image'],
                'icon' => is_null($item->picture) ? null : $item->picture['icon'],
            ];
        })->toArray();
    }
}
