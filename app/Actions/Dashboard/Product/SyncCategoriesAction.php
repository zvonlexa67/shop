<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;

class SyncCategoriesAction
{
  public function __invoke(array $data): array
  {
    // dd($data);

    $product = Product::find($data["id"]);
    $product->categories()->sync($data["categories"]);

    return [ 'product_id' => $product->id];
  }
}