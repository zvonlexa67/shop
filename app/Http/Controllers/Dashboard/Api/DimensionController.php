<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Actions\Dashboard\Api\Dimension\OptionAction;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DimensionController extends Controller
{
    public function options(OptionAction $action): ResourceCollection
    {
        return $action();
    }
}
