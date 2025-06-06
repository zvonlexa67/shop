<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use App\Models\Product;

class DetachAction
{
  public function __invoke(int $category_id, int $characteristic_id): array
  {
    Product::clearCachePCC();

    return tap(
      [ 'id' => $category_id ],
      fn() => Category::find($category_id)->characteristics()->detach($characteristic_id)
    );
  }
}

