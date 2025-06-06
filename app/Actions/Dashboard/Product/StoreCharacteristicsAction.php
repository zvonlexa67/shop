<?php

namespace App\Actions\Dashboard\Product;

// use App\Models\CharacteristicProductValue;
use App\Models\Product;

class StoreCharacteristicsAction
{
  public function __invoke(array $data): array
  {

    // dd($data['characteristics' ]);

    // $user->roles()->sync([1 => ['expires' => true], 2, 3]);
    $product = Product::query()->find($data['id']);

    // $product->characteristic()->sync([ 8 => [ 'value' => [ 'first' => 4 ]]]);
    $product->characteristic()->sync($data['characteristics' ]);

    // foreach($data['value'] as $value) {
    //   if(($value['first'] === null) && ($value['last'] === null)) {
    //     CharacteristicProductValue::query()
    //       ->where('category_characteristic_id', $value['category_characteristic_id'])
    //       ->where('category_product_id', $value['category_product_id'])
    //       ->delete();
    //   } else {
    //     if (CharacteristicProductValue::query()
    //       ->where('category_characteristic_id', $value['category_characteristic_id'])
    //       ->where('category_product_id', $value['category_product_id'])
    //       ->exists()
    //     ) 
    //     {
    //       CharacteristicProductValue::query()
    //         ->where('category_characteristic_id', $value['category_characteristic_id'])
    //         ->where('category_product_id', $value['category_product_id'])
    //         ->update(
    //             [
    //                 'first' => $value['first'],
    //                 'last' => $value['last'],
    //             ]
    //         );
    //     } else {
    //       CharacteristicProductValue::query()
    //         ->create(
    //           [
    //             'category_characteristic_id' => $value['category_characteristic_id'],
    //             'category_product_id' => $value['category_product_id'],
    //             'type' => $value['type'],
    //             'first' => $value['first'],
    //             'last' => $value['last'],
    //           ]
    //         );
    //       }
    //     }
    //   }

      return [ 'product_id' => $data['id' ] ];
      // return [ 'category_id' => $data['category_id'], 'product_id' => $data['product_id' ] ];
  }
}
