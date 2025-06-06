<?php

namespace App\Models;

use App\Enums\OwnerShipEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'type',
        'telegram',
        'whatsapp',
        'site',
        'vk',
        'inn',
        'ogrnip',
        'email',
        'phone',
        'picture',
    ];

    protected $attributes = [
        'type' => OwnerShipEnum::Individual,
    ];

    protected function casts(): array
    {
        return [
            'type' => OwnerShipEnum::class,
            'email' => 'array',
            'phone' => 'array',
            'picture' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
