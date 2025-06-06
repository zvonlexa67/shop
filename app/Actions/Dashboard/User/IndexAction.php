<?php

namespace App\Actions\Dashboard\User;

use App\Http\Resources\Dashboard\User\IndexCollection;
use App\Http\Resources\Dashboard\User\IndexResource;
use App\Models\User;

class IndexAction
{
    public function __invoke(int $user_id): array
    {
        return [
            'users' => fn() => $user_id == 0 ? IndexCollection::make(User::all()) : null,
            'user' => fn() => $user_id > 0 ? IndexResource::make(User::find($user_id)) : null,
        ];
    }
}
