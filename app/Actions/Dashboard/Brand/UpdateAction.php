<?php

namespace App\Actions\Dashboard\Brand;

use Illuminate\Support\Facades\Storage;
use App\Models\Brand;

class UpdateAction
{
    public function __invoke(array $data): void
    {
        $pathRoot = config('filesystems.disks.public.url');

        $brandId = $data['id'];

        $model = Brand::find($brandId);

        $model->title = $data['title'];
        $model->slug = $data['slug'];
        $model->href = $data['href'];
        $model->sort = $data['sort'];
        $model->description = $data['description'] ?? '';

        if (!($data['picture_file'] === null)) {
            deleteStorageDirId(Brand::STORAGE_DIR_IMAGES, $brandId);

            $pathImage = Storage::disk('public')->putFileAs(
                Brand::STORAGE_DIR_IMAGES . $brandId,
                $data['picture_file'],
                UlidFileName($data['picture_file']->extension()),
            );

            $model->picture_image = "$pathRoot/$pathImage";
        }

        $model->save();
    }
}
