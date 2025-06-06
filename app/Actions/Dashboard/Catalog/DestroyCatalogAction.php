<?php

namespace App\Actions\Dashboard\Catalog;

use App\Models\Catalog;
use Illuminate\Support\Facades\Storage;

class DestroyCatalogAction
{
    public function __invoke($id): void
    {
        if (is_dir(config('filesystems.disks.public.root').'/images/catalog/'.$id)) {
            Storage::disk('public')->deleteDirectory('images/catalog/'.$id);
        }

        if (is_dir(config('filesystems.disks.public.root').'/icons/catalog/'.$id)) {
            Storage::disk('public')->deleteDirectory('icons/catalog/'.$id);
        }

        Catalog::whereId($id)->delete();
        Catalog::clearCache();
    }
}
