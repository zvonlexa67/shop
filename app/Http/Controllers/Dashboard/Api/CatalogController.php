<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Actions\Dashboard\Catalog\Api\GetListAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Catalog\Api\OptionsCatalogCollection;

class CatalogController extends Controller
{
    public function getList(GetListAction $action): OptionsCatalogCollection
    {
        return OptionsCatalogCollection::make($action());
    }
}
