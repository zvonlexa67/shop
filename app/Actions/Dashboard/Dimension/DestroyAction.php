<?php

namespace App\Actions\Dashboard\Dimension;

use App\Models\Dimension;

class DestroyAction
{
    public function __invoke(int $id): void
    {
        Dimension::destroy($id);
    }
}
