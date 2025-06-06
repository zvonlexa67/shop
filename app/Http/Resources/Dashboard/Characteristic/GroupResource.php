<?php

namespace App\Http\Resources\Dashboard\Characteristic;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'id'=> $this->id,
          'title'=> $this->title,
        ];
    }
}
