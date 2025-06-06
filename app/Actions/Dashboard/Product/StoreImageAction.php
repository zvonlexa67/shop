<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class StoreImageAction
{
  public function __invoke(array $data): array
  {
    $pathRoot = config('filesystems.disks.public.url');
    $maxIndexDir = maxIndexDir(Storage::disk('public')->directories(Product::STORAGE_DIR_IMAGES . $data['id'])) + 1;

    if ($data['image'] !== null) {
      $pathImage = Storage::disk('public')->putFileAs(
        Product::STORAGE_DIR_IMAGES . "{$data['id']}/$maxIndexDir",
        $data['image'],
        UlidFileName($data['image']->extension()),
      );

      $product = Product::find($data['id']);
      $picture_image = $product->picture_image;
      $picture_image[] = "$pathRoot/$pathImage";
      $product->picture_image = $picture_image;
      $product->save();
    }

    return [ 'product_id' => $data['id'] ];
  }
}
