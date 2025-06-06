<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
// use App\Models\Characteristic;
// use App\Models\Product;

class AttachAction
{
  public function __invoke(array $request): array
  {
    // Product::clearCachePCC();

    // $category = Category::find($request['id']);
    // $category->smart()->sync($request['doneIds']);
    // Category::find($request['id'])->smart()->sync($request['doneIds']);
        
    $smart = Category::find($request['id'])->smart();

    $smart->detach($request['todoIds']);
    $smart->syncWithoutDetaching($request['doneIds']);

    // dd('------------------');

    return $request;

    // return match(Characteristic::find($characteristic_id)->parent_id) {
    //   null => tap(
    //     [ 'id' => $category_id ],
    //     fn() => Category::find($category_id)->characteristics()->syncWithoutDetaching(
    //      Characteristic::query()->select('id')->where('parent_id', $characteristic_id)->get()->modelKeys()
    //       ),
    //     ),
    //   default => tap(
    //     [ 'id' => $category_id ],
    //     fn() => Category::find($category_id)->characteristics()->syncWithoutDetaching([ $characteristic_id ]),
    //   ) 
    // };
  }

}
