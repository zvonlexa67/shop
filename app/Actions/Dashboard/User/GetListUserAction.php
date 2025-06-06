<?php

namespace App\Actions\Dashboard\User;

use App\Http\Resources\Dashboard\User\GetListUserCollection;
use App\Models\User;

class GetListUserAction     //TODO delete
{
    public function __invoke(int $user_id): array
    {
        return [
            'users' => fn() => $user_id == 0 ? GetListUserCollection::make(User::all()) : null,
            'user' => fn() => $user_id > 0 ? User::find($user_id) : null,
        ];
    }
}
