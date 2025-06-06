<?php

namespace App\Actions\Dashboard\User;

use App\Models\User;

class DestroyAction
{
    public function __invoke(int $user_id): array
    {
        User::destroy($user_id);

        return ['user_id' => 0];
    }
}
