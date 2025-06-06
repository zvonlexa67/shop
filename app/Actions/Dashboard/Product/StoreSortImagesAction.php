<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;

class StoreSortImagesAction
{
  public function __invoke(array $data): array
  {
    Product::where('id', $data['id'])->update(['picture_image' => $data['picture_image']]);
    // Product::where('id', $data['id'])->update(['picture_image' => reInstanceArray($data['picture_image'])]);

    return [ 'product_id' => $data['id'] ];
  }
}
