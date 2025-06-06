<?php

namespace App\Actions\Dashboard\Sliders;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class StoreAction
{
    public function __invoke(array $data): void
    {
        $url = config('filesystems.disks.public.url');

        $model = Slide::create([
            'sort' => $data['sort'],
            'name' => $data['name'],
            'href' => $data['href'],
        ]);

        if (!($data['picture_file'] === null)) {
            $path = Storage::disk('public')->putFileAs(
                "images/slides/{$model->id}",
                $data['picture_file'],
                UlidFileName($data['picture_file']->extension()),
            );

            $model->picture = "$url/$path";
            $model->save();
        }
    }
}
