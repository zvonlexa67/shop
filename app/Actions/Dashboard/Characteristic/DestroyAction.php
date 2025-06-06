<?php

namespace App\Actions\Dashboard\Characteristic;

use App\Models\Characteristic;

class DestroyAction
{
    public function __invoke(int $id): array
    {
        Characteristic::destroy($id);

        return [ 'characteristic_id' => 0 ];
    }
}
