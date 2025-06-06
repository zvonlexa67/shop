<?php

namespace App\Actions\Dashboard\Catalog;

use App\Models\Catalog;
use Illuminate\Support\Facades\Storage;

class UpdateCatalogAction
{
    public function __invoke($data, $id)
    {
        $model = Catalog::find($id);

        $pathRoot = config('filesystems.disks.public.url');

        $model->title = $data->title;
        $model->slug = $data->slug;
        $model->sort = $data->sort;

        $picture['disk'] = 'public';

        if (! is_null($data->image)) {
            if (is_dir($pathRoot.'/images/catalog/'.$id)) {
                Storage::disk('public')->deleteDirectory('images/catalog/'.$id);
            }

            $pathImage = Storage::disk('public')->putFileAs(
                'images/catalog/'.$id,
                $data->image,
                'catalog.'.$data->image->extension(),
            );

            $picture['image'] = $pathRoot.'/'.$pathImage;
        } else {
            $picture['image'] = $model->picture['image'];
        }

        if (! is_null($data->icon)) {
            if (is_dir($pathRoot.'/icons/catalog/'.$id)) {
                Storage::disk('public')->deleteDirectory('icon/catalog/'.$id);
            }

            $pathIcon = Storage::disk('public')->putFileAs(
                'icons/catalog/'.$id,
                $data->icon,
                'catalog.'.$data->icon->extension(),
            );

            $picture['icon'] = $pathRoot.'/'.$pathIcon;
        } else {
            $picture['icon'] = $model->picture['icon'];
        }

        $model->picture = $picture;
        $model->save();
        Catalog::clearCache();
    }
}
