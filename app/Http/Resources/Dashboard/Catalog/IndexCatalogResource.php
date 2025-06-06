<?php

namespace App\Http\Resources\Dashboard\Catalog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexCatalogResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => is_null($this->picture) ? null : $this->picture->image,
            'icon' => is_null($this->picture) ? null : $this->picture->icon,
        ];
    }
}
