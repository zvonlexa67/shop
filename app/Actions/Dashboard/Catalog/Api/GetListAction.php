<?php

namespace App\Actions\Dashboard\Catalog\Api;

use App\Models\Catalog;
use Illuminate\Support\Collection;

class GetListAction
{
    public function __invoke(): Collection
    {
        return Catalog::query()->orderBy('sort')->orderBy('id')->get();
    }
}
