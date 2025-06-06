<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Actions\Dashboard\Api\Brand\OptionAction;

class BrandController extends Controller
{
    public function options(OptionAction $action): ResourceCollection
    {
        return $action();
    }
}
