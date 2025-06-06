<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    use HasFactory;

    protected $table = 'dimensions';

    protected $fillable = [
        'title',
        'sort',
        'picture_image',
    ];

    protected $attribute = [
        'sort' => 100,
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
