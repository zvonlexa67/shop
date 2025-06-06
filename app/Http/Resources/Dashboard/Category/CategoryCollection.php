<?php

namespace App\Http\Resources\Dashboard\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
                // 'chapter_id' => $item->chapter_id,
                'title' => $item->title,
                'slug' => $item->slug,
                'picture_image' => $item->picture_image,
                'picture_icon' => $item->picture_icon,
                // 'image' => is_null($item->picture) ? null : $item->picture['image'],
                // 'icon' => is_null($item->picture) ? null : $item->picture['icon'],
            ];
        })->toArray();
    }
}
