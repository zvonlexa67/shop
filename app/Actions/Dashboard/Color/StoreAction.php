<?php

namespace App\Actions\Dashboard\Color;

use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class StoreAction
{
  public function __invoke(array $data): void
  {
    $pathRoot = config('filesystems.disks.public.url');

    $model = Color::create([
      'title' => $data['title'],
      'sort' => $data['sort'],
      'picture_image' => '',
    ]);

    if ($data['picture_file'] !== null) {
      $pathImage = Storage::disk('public')->putFileAs(
        Color::STORAGE_DIR_IMAGES . $model['id'],
        $data['picture_file'],
        UlidFileName($data['picture_file']->extension()),
    );

    $model->picture_image = "$pathRoot/$pathImage";
    $model->save();
    }
  }
}
