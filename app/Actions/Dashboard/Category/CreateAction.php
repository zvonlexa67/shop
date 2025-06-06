<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CreateAction
{
    public function __invoke(array $data): array
    {
        $pathRoot = config('filesystems.disks.public.url');
        $root = Category::where('id', $data['parent_id'])->first();

        $create = [
            'title' => $data['title'],
            'sort' => $data['sort'],
        ];

        if (!($data['slug'] === null)) {
            $create['slug'] = $data['slug'];
        }

        $model = Category::create($create, $root);

        if (!($data['picture_file_image'] === null)) {
            $pathImage = Storage::disk('public')->putFileAs(
                Category::STORAGE_DIR_IMAGES . $model['id'],
                $data['picture_file_image'],
                UlidFileName($data['picture_file_image']->extension()),
            );

            $picture_image = "$pathRoot/$pathImage";
        } else {
            $picture_image = '';
        }

        if (!($data['picture_file_icon'] === null)) {
            $pathIcon = Storage::disk('public')->putFileAs(
                Category::STORAGE_DIR_ICONS . $model['id'],
                $data['picture_file_icon'],
                UlidFileName($data['picture_file_icon']->extension()),
            );

            $picture_icon = "$pathRoot/$pathIcon";
        } else {
            $picture_icon = '';
        }

        $model->picture_image = $picture_image;
        $model->picture_icon = $picture_icon;
        $model->save();

        Category::clearCache();

        return [ 'id' => $model->id ];
    }
}
