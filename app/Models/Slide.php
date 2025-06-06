<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';

    protected $fillable = [
        'name',
        'href',
        'disk',
        'picture',
    ];

    protected $attributes = [
        'disk' => 'public',
    ];

    protected function casts() {
        return [
            'created_at' => 'datetime:Y-m-d h:i:s',
            'updated_at' => 'datetime:Y-m-d h:i:s',
        ];
    }
}
