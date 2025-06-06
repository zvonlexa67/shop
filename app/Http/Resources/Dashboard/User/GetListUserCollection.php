<?php

namespace App\Http\Resources\Dashboard\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetListUserCollection extends ResourceCollection      //TODO Delete
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'email_verified_at' => $item->email_verified_at ? $item->email_verified_at->toDateTimeString() : '',
                'created_at' => $item->created_at->toDateTimeString(),
                'updated_at' => $item->updated_at->toDateTimeString(),
            ];
        })->toArray();
    }
}
