<?php

namespace App\Http\Resources\Dashboard\Product;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexProductsCollection extends ResourceCollection
{
  public function toArray(Request $request): array
  {
    return $this->collection->map(callback: fn($item) => [
      'id' => $item->id,
      'active' => $item->active,
      'sort' => $item->sort,
      'title' => $item->title,
      'slug' => $item->slug,
      'price' => $item->price,
      'description' => $item->description,
      'picture_image' => $item->picture_image ?? [],
      'base' => $item->price === null ? null : $item->price->base,
      'nds' => $item->price === null ? null : $item->price->nds,
      'purchase' => $item->price === null ? null : $item->price->purchase,
      'price_nds' => $item->price === null ? true : $item->price->price_nds,
      'created_at' => Carbon::parse($item->created_at)->format('d-m-Y H:i:s'),
      'updated_at' => Carbon::parse($item->updated_at)->format('d-m-Y H:i:s'),
      ]
    )->toArray();
  }
}
