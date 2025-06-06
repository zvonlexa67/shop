<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;

class StorePriceAction
{
    public function __invoke(array $data)
    {

        


        Product::where('id', $data[ 'id' ])->update([ 
            'price' => [
                'base' => $data['base'],
                'nds' => $data['nds'],
                'purchase' => $data['purchase'],
                'price_nds' => $data['price_nds'],
            ]
        ]);

        return [ 'category_id' => $data['category_id'], 'product_id' => $data['id']];
    }
}
