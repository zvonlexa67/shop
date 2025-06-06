<?php

namespace App\Actions\Dashboard\Color;

use App\Models\Color;

class DestroyAction
{
    public function __invoke(int $id): void
    {
        Color::destroy($id);
    }
}
