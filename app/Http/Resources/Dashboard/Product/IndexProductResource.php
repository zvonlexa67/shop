<?php

namespace App\Http\Resources\Dashboard\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexProductResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'active' => $this->active,
      'sort' => $this->sort,
      'title' => $this->title,
      'tooltip' => $this->tooltip ?? '',
      'slug' => $this->slug,
      'price' => $this->price,
      'categories' => $this->categories->map(fn($item) => $item->id)->toArray(),
      'description' => $this->description,
      'picture_image' => $this->picture_image === null ? [] : $this->pictureImage($this->picture_image),
      'base' => $this->price === null ? null : $this->price->base,
      'nds' => $this->price === null ? null : $this->price->nds,
      'purchase' => $this->price === null ? null : $this->price->purchase,
      'price_nds' => $this->price === null ? true : $this->price->price_nds,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }

  protected function pictureImage(array $picture_image): array
  {
    $result = [];
    
    foreach ($picture_image as $key => $value) {
      $result[] = [ 'id' => $key + 1, 'url' => $value ];
    };

    return $result;
  }
}
