<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasRoles, Notifiable;

    private const string PASSWORD = 'password';

    // public const FRONT_LIST = 'List';
    // public const FRONT_UPDATE = 'Update';
    // public const FRONT_CREATE = 'Create';

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime:Y-m-d h:i:s',
            'created_at' => 'datetime:Y-m-d h:i:s',
            'updated_at' => 'datetime:Y-m-d h:i:s',
            'password' => 'hashed',
        ];
    }

    // protected static function booted(): void
    // {
    //     static::created(function (User $user) {
    //         event(new Registered($user));
    //     });
    // }

    // protected static function boot(): void
    // {
    //     parent::boot();

    //     static::created(function (User $user) {
    //         $user->password = $user->password ?? Hash::make(self::PASSWORD);
    //     });
    // }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'id', 'id');
    }
}
