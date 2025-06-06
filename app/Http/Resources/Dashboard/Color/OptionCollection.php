<?php

namespace App\Http\Resources\Dashboard\Color;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OptionCollection extends ResourceCollection
{
  public function toArray(Request $request): array
  {
    return $this->collection->map(fn($item) => 
      [
        'label' => $item->title,
        'value' => $item->id,
        'href' => $item->picture_image,
      ]
    )->toArray();
  }
}
