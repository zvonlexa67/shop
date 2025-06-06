<?php

namespace App\Actions\Dashboard\Sliders;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class UpdateAction
{
    public function __invoke(array $data): void
    {
        $update = [
            'sort' => $data['sort'],
            'name' => $data['name'],
            'href' => $data['href'],
        ];

        if (!($data['picture_file'] === null)) {
            Storage::disk('public')->deleteDirectory("images/slides/{$data['id']}");

            $path = Storage::disk('public')->putFileAs(
                "images/slides/{$data['id']}",
                $data['picture_file'],
                'slide.' . $data['picture_file']->extension(),
            );

            $update['picture'] = config('filesystems.disks.public.url').'/'.$path;
        }

        Slide::whereId($data['id'])->update($update);
    }
}
