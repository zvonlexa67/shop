<?php

namespace App\Http\Resources\Dashboard\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->map(fn($item) => [
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'email_verified_at' => $item->email_verified_at ? $item->email_verified_at->toDateTimeString() : '',
            'created_at' => $item->created_at->toDateTimeString(),
            'updated_at' => $item->updated_at->toDateTimeString(),
        ])->toArray();
    }
}
