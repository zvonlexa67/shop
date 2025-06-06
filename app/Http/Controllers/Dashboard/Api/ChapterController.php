<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Actions\Dashboard\Chapter\Api\GetListAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Catalog\Api\OptionsCatalogCollection;

class ChapterController extends Controller
{
    public function getList(GetListAction $action): OptionsCatalogCollection
    {
        return OptionsCatalogCollection::make($action());
    }
}
