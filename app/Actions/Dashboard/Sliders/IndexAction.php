<?php

namespace App\Actions\Dashboard\Sliders;

use App\Models\Slide;

class IndexAction
{
    public function __invoke(): array
    {
        return [ 'slides' => fn() => Slide::orderBy('sort')->orderBy('id')->get()->toArray() ];
    }
}
