<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public const string STORAGE_DIR_IMAGES = '/images/color/';

    protected $table = 'colors';

    protected $fillable = [
        'sort',
        'title',
        'picture_image',
    ];

    protected $attributes = [
        'sort' => 100,
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function (Color $color) {
            deleteStorageDirId(self::STORAGE_DIR_IMAGES, $color->id);
        });
    }
}
