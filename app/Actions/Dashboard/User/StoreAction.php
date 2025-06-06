<?php

namespace App\Actions\Dashboard\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreAction
{
    public function __invoke(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return ['user_id' => $user->id];
    }
}
