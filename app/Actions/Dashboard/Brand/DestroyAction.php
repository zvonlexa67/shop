<?php

namespace App\Actions\Dashboard\Brand;

use App\Models\Brand;

class DestroyAction
{
    public function __invoke(int $id): void
    {
        Brand::destroy($id);
    }
}
