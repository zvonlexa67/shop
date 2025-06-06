<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacteristicProductValue extends Model
{
    protected $primaryKey = [
        'category_characteristic_id',
        'category_product_id',
    ];

    protected $table = 'characteristic_product_value';

    public $incrementing = false;

    protected $fillable = [
        'category_characteristic_id',
        'category_product_id',
        'type',
        'first',
        'last',
    ];

    protected function casts(): array
    {
        return [
            'first' => 'array',
            'last' => 'array',
        ];
    }
}
