<?php

namespace App\Actions\Dashboard\Sliders;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class DestroySlidesAction
{
    public function __invoke(int $id): void
    {
        if (is_dir(config('filesystems.disks.public.root').'/images/slides/' . $id)) {
            Storage::disk('public')->deleteDirectory("images/slides/$id");
        }

        Slide::whereId($id)->delete();
    }
}
