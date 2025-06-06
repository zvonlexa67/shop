<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;

class DestroyImageAction
{
  public function __invoke(array $data): array
  {
    $product = Product::find($data['id']);
    $arr = $product->picture_image;
    $key = array_find_key($arr, fn ($value) => $value == $data['picture_image']);
    $index = indexDirPictureImage($product->picture_image[$key]);
    unset($arr[$key]);
    $product->picture_image = reInstanceArray($arr);
    $product->save();
    deleteStorageDirId(Product::STORAGE_DIR_IMAGES . $product['id'] . '/', $index);

    return [ 'product_id' => $data['id'] ];
  }
}
