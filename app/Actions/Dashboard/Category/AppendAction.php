<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AppendAction
{
    public function __invoke(int $category_id, array $data): array
    {
        $pathRoot = config('filesystems.disks.public.url');

        $root = Category::find($category_id)->parent;

        $create = [
            'title' => $data['title'],
            'sort' => $data['sort'],
        ];

        if (! is_null($data['slug'])) {
            $create['slug'] = $data['slug'];
        }

        $model = Category::create($create, $root);

        if (! is_null($data['picture_image'])) {
            $pathImage = Storage::disk('public')->putFileAs(
                'images/category/' . $model['id'],
                $data['picture_image'],
                UlidFileName($data['picture_image']->extension()),
            );

            $picture_image = $pathRoot . '/' . $pathImage;
        } else {
            $picture_image = '';
        }

        if (! is_null($data['picture_icon'])) {
            $pathIcon = Storage::disk('public')->putFileAs(
                'icons/category/' . $model['id'],
                $data['picture_icon'],
                UlidFileName($data['picture_icon']->extension()),
            );

            $picture_icon = $pathRoot . '/' . $pathIcon;
        } else {
            $picture_icon = '';
        }

        $model->picture_image = $picture_image;
        $model->picture_icon = $picture_icon;
        $model->save();

        Category::clearCache();

        return [ 'is_component' => 'Update', 'category_id' => $model->id ];
    }
}
