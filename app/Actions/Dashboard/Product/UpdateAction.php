<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;

class UpdateAction
{
  public function __invoke($data): array
  {
    $model = Product::where('id', $data[ 'id' ])->update([ 
      'sort' => $data[ 'sort' ],
      'active' => $data[ 'active' ],
      'title' => $data[ 'title' ],
      'slug' => $data[ 'slug' ],
      'tooltip' => $data[ 'tooltip' ],
    ]);

      return [ 'product_id' => $data[ 'id' ] ];
  }
}
