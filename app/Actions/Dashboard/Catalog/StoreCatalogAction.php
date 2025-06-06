<?php

namespace App\Actions\Dashboard\Catalog;

use App\Models\Catalog;
use Illuminate\Support\Facades\Storage;

class StoreCatalogAction
{
    public function __invoke($data)
    {
        $pathRoot = config('filesystems.disks.public.url');

        $create = [
            'title' => $data->title,
        ];

        if (! is_null($data->slug)) {
            $create['slug'] = $data->slug;
        }

        $model = Catalog::create($create);

        $picture['disk'] = 'public';

        if (! is_null($data->image)) {
            $pathImage = Storage::disk('public')->putFileAs(
                'images/catalog/'.$model->id,
                $data->image,
                'catalog.'.$data->image->extension(),
            );

            $picture['image'] = $pathRoot.'/'.$pathImage;
        } else {
            $picture['image'] = null;
        }

        if (! is_null($data->icon)) {
            $pathIcon = Storage::disk('public')->putFileAs(
                'icons/catalog/'.$model->id,
                $data->icon,
                'catalog.'.$data->icon->extension(),
            );

            $picture['icon'] = $pathRoot.'/'.$pathIcon;
        } else {
            $picture['icon'] = null;
        }

        $model->picture = $picture;
        $model->save();

        Catalog::clearCache();
    }
}
