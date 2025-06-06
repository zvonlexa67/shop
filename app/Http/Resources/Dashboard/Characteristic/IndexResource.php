<?php

namespace App\Http\Resources\Dashboard\Characteristic;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\TypeEnum;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'title' => $this->title,
            'smart' => $this->smart,
            'type' => $this->type->getOption(),
            'description' => $this->description,
        ];
    }
}
