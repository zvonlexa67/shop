<?php

namespace App\Actions\Dashboard\Color;

use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class UpdateAction
{
  public function __invoke(array $data): void
  {
    $pathRoot = config('filesystems.disks.public.url');

    $update = [
      'title' => $data['title'],
      'sort' => $data['sort'],
    ];

    if ($data['picture_file'] !== null) {
      deleteStorageDirId(Color::STORAGE_DIR_IMAGES, $data['id']);

      $pathImage = Storage::disk('public')->putFileAs(
        Color::STORAGE_DIR_IMAGES . $data['id'],
        $data['picture_file'],
        UlidFileName($data['picture_file']->extension()),
      );

      $update['picture_image'] = "$pathRoot/$pathImage";
    }

    Color::query()->where('id', $data['id'])->update($update);
  }
}
