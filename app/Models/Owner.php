<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $table = 'owners';

    protected $fillable = [
        'title',
        'name',
        'email',
        'watsapp',
        'phone',
        'vk',
        'telegram',
        'vk',
        'youtube',
        'rutube',
        'address',
    ];
}
