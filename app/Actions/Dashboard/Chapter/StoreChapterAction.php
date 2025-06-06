<?php

namespace App\Actions\Dashboard\Chapter;

use App\Models\Catalog;
use App\Models\Chapter;
use Illuminate\Support\Facades\Storage;

class StoreChapterAction
{
    public function __invoke($data): int
    {
        $pathRoot = config('filesystems.disks.public.url');

        $create = [
            'title' => $data->title,
            'catalog_id' => $data->catalog_id,
        ];

        if (! is_null($data->slug)) {
            $create['slug'] = $data->slug;
        }

        $model = Chapter::create($create);

        $picture['disk'] = 'public';

        if (! is_null($data->image)) {
            $pathImage = Storage::disk('public')->putFileAs(
                'images/chapter/'.$model->id,
                $data->image,
                'chapter.'.$data->image->extension(),
            );

            $picture['image'] = $pathRoot.'/'.$pathImage;
        } else {
            $picture['image'] = null;
        }

        if (! is_null($data->icon)) {
            $pathIcon = Storage::disk('public')->putFileAs(
                'icons/chapter/'.$model->id,
                $data->icon,
                'chapter.'.$data->icon->extension(),
            );

            $picture['icon'] = $pathRoot.'/'.$pathIcon;
        } else {
            $picture['icon'] = null;
        }

        $model->picture = $picture;
        $model->save();

        Catalog::clearCache();

        return $model->catalog_id;
    }
}
