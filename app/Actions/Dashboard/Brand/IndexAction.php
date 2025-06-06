<?php

namespace App\Actions\Dashboard\Brand;

use App\Http\Resources\Dashboard\Brand\BrandCollection;
use App\Models\Brand;

class IndexAction
{
    public function __invoke(): array
    {
        return [ 'brands' => fn() => BrandCollection::make(Brand::orderBy('id')->get()) ];
    }
}
