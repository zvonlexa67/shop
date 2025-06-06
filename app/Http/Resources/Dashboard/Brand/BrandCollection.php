<?php

namespace App\Http\Resources\Dashboard\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BrandCollection extends ResourceCollection
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
                'title' => $item->title,
                'slug' => $item->slug,
                'href' => $item->href,
                'sort' => $item->sort,
                'count_products' => $item->count_products,
                'picture_image' => $item->picture_image ?? '',
                'description' => $item->description ?? '',
            ];
        })->toArray();
    }
}
