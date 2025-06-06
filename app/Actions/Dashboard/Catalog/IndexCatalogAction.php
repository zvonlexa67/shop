<?php

namespace App\Actions\Dashboard\Catalog;

use App\Http\Resources\Dashboard\Catalog\ItemsCatalogCollection;
use App\Models\Catalog;

class IndexCatalogAction
{
    public function __invoke(): array
    {
        return ItemsCatalogCollection::make(Catalog::query()->orderBy('sort')->orderBy('id')->get())->resolve();
    }
}
