<?php

namespace App\Actions\Dashboard\Chapter;

use App\Models\Catalog;
use App\Models\Chapter;
use Illuminate\Support\Facades\Storage;

class UpdateChapterAction
{
    public function __invoke($data, $id): int
    {
        $model = Chapter::find($id);

        $pathRoot = config('filesystems.disks.public.url');

        $model->title = $data->title;
        $model->slug = $data->slug;
        $model->sort = $data->sort;

        $picture['disk'] = 'public';

        if (! is_null($data->image)) {
            if (is_dir($pathRoot.'/images/chapter/'.$id)) {
                Storage::disk('public')->deleteDirectory('images/chapter/'.$id);
            }

            $pathImage = Storage::disk('public')->putFileAs(
                'images/chapter/'.$id,
                $data->image,
                'chapter.'.$data->image->extension(),
            );

            $picture['image'] = $pathRoot.'/'.$pathImage;
        } else {
            $picture['image'] = $model->picture['image'] ?? '';
        }

        if (! is_null($data->icon)) {
            if (is_dir($pathRoot.'/icons/chapter/'.$id)) {
                Storage::disk('public')->deleteDirectory('icon/chapter/'.$id);
            }

            $pathIcon = Storage::disk('public')->putFileAs(
                'icons/chapter/'.$id,
                $data->icon,
                'chapter.'.$data->icon->extension(),
            );

            // $picture['icon'] = $pathRoot.'/'.$pathIcon;
            $picture['icon'] = $pathRoot.'/'.$pathIcon;
        } else {
            $picture['icon'] = $model->picture['icon'] ?? '';
        }

        $model->picture = $picture;
        $model->save();

        Catalog::clearCache();

        return $model->catalog_id;
    }
}
