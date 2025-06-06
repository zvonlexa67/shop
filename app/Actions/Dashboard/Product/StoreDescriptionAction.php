<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;

class StoreDescriptionAction
{
  public function __invoke(array $data): array
  {
    Product::where('id', $data[ 'id' ])->update([ 
      'description' => $data[ 'description' ]
      ]
    );

    return [ 'product_id' => $data[ 'id' ]];
  }
}