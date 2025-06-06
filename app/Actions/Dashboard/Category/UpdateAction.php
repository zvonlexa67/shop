<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class UpdateAction
{
    public function __invoke(array $data): array
    {
        $pathRoot = config('filesystems.disks.public.url');
        // $root = config('filesystems.disks.public.root');

        $model = Category::find($data['id']);

        $model->title = $data['title'];
        $model->slug = $data['slug'];
        $model->sort = $data['sort'];

        if (!($data['picture_file_image'] === null)) {
            $this->deleteDirectionImage($data['id']);

            $pathImage = Storage::disk('public')->putFileAs(
                Category::STORAGE_DIR_IMAGES . $data['id'], //'images/category/' . $data['id'],
                $data['picture_file_image'],
                UlidFileName($data['picture_file_image']->extension()),
            );

            $model->picture_image = "$pathRoot/$pathImage";
        } else {
            $model->picture_image ??= '';
        }

        if (!($data['picture_file_icon'] === null)) {
            $this->deleteDirectionIcon($data['id']);

            $pathIcon = Storage::disk('public')->putFileAs(
                Category::STORAGE_DIR_ICONS . $data['id'], //'icons/category/' . $data['id'],
                $data['picture_file_icon'],
                UlidFileName($data['picture_file_icon']->extension()),
            );

            $model->picture_icon = "$pathRoot/$pathIcon";
        } else {
            $model->picture_icon ??= '';
        }

        $model->save();

        Category::clearCache();

        return [ 'id' => $model->id ];
    }

    protected function deleteDirectionImage(int $id): void
    {
        if (is_dir(config('filesystems.disks.public.root') . Category::STORAGE_DIR_IMAGES . $id)) {
            Storage::disk('public')->deleteDirectory(Category::STORAGE_DIR_IMAGES . $id);
        }
    }
    protected function deleteDirectionIcon(int $id): void
    {
        if (is_dir(config('filesystems.disks.public.root') . Category::STORAGE_DIR_ICONS . $id)) {
            Storage::disk('public')->deleteDirectory(Category::STORAGE_DIR_ICONS . $id);
        }
    }
}
