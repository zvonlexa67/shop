<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexCollection extends ResourceCollection
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
                'picture_image' => $item->picture_image,
                'picture_icon' => $item->picture_icon,
            ];
        })->toArray();
    }
}
