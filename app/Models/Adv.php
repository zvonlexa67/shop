<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Adv extends Model
{
    use HasFactory;

    protected $table = 'advs';

    protected $fillable = [
        'title',
        'slug',
        'picture',
    ];

    protected $casts = [
        'picture' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Adv $adv) {
            $adv->slug = $adv->slug ?? Str::slug($adv->title);
        });
    }
}
