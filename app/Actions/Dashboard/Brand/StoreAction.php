<?php

namespace App\Actions\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class StoreAction
{
    public function __invoke(array $data): void
    {
        $pathRoot = config('filesystems.disks.public.url');

        $model = Brand::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'href' => $data['href'],
            'sort' => $data['sort'],
            'description' => $data['description'] ?? '',
            'picture_image' => '',
        ]);

        if (!($data['picture_file'] === null)) {
            $pathImage = Storage::disk('public')->putFileAs(
                Brand::STORAGE_DIR_IMAGES . $model->id,
                $data['picture_file'],
                UlidFileName($data['picture_file']->extension()),
            );

            $model->picture_image = "$pathRoot/$pathImage";
            $model->save();
        }
    }
}
