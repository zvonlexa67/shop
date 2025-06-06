<?php

namespace App\Http\Resources\Dashboard\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemsCollection extends ResourceCollection
{
  public function toArray(Request $request): array
  {
    return $this->collection->map(fn ($item) =>
      [
        'id' => $item->id,
        'title' => $item->title,
      ]
    )->toArray();
  }
}
