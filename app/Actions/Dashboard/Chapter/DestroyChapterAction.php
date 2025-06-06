<?php

namespace App\Actions\Dashboard\Chapter;

use App\Models\Catalog;
use App\Models\Chapter;
use Illuminate\Support\Facades\Storage;

class DestroyChapterAction
{
    public function __invoke($id): int
    {
        if (is_dir(config('filesystems.disks.public.root').'/images/chapter/'.$id)) {
            Storage::disk('public')->deleteDirectory('images/chapter/'.$id);
        }

        if (is_dir(config('filesystems.disks.public.root').'/icons/chapter/'.$id)) {
            Storage::disk('public')->deleteDirectory('icons/chapter/'.$id);
        }

        $model = Chapter::find($id);
        $catalogId = $model->catalog_id;
        $model->delete();

        Catalog::clearCache();

        return $catalogId;
    }
}
