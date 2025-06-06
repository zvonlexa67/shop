<?php

namespace App\Actions\Dashboard\Chapter;

use App\Models\Chapter;
use Illuminate\Support\Collection;

class ShowChapterAction
{
    public function __invoke(int $id): Collection
    {
        return match ($id) {
            0 => Collection::make(),
            default => Chapter::query()->where('catalog_id', $id)->orderBy('sort')->orderBy('id')->get(),
        };
    }
}
