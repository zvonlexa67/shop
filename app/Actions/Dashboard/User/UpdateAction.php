<?php

namespace App\Actions\Dashboard\User;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateAction
{
    public function __invoke(array $data): array
    {
        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if ($data['password']) {
            $update['password'] = Hash::make($data['password']);
        }

        User::where('id', $data['id'])->update($update);

        return ['user_id' => $data['id']];
    }
}
