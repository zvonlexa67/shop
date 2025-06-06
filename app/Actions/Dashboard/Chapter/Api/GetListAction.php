<?php

namespace App\Actions\Dashboard\Chapter\Api;

use App\Models\Chapter;
use Illuminate\Support\Collection;

class GetListAction
{
    public function __invoke(): Collection
    {
        return Chapter::query()->orderBy('sort')->orderBy('id')->get();
    }
}
