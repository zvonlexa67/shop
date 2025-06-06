<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCharacteristics extends Pivot
{
    protected $casts = [
        'value' => 'array' // Автоматическое преобразование JSON <-> array
    ];
}
