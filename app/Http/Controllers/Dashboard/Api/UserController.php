<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Http\Resources\Dashboard\User\Api\UserResource;
// use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // public function getUser(User $user): UserResource
    // {
    //     return UserResource::make($user);
    // }

    public function updateUser(UpdateRequest $request): int
    {
        $id = $request->id;
        $update = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_at,
        ];

        return User::whereId($id)->update($update);
    }
}
