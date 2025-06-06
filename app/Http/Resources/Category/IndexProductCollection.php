<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexProductCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(function($item){
            return [
                'id' => $item->id,
                'active' => $item->active,
                'sort' => $item->sort,
                'title' => $item->title,
                'slug' => $item->slug,
                'picture_image' => $item->picture_image,
                'description' => $item->description,
                'price' => $item->price,
                'accounting' => $item->accounting,
            ];
        })->toArray();
    }
}
