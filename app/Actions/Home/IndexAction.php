<?php

namespace App\Actions\Home;

use App\Models\Category;

class IndexAction
{
    public function __invoke(): array
    {
        return [
            'categories' => fn() => Category::getAll(),
        ];
    }
}
