<?php

namespace App\Http\Resources\Dashboard\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexCategoryResource extends JsonResource
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
            'products' => IndexProductsCollection::make($this->products)->resolve(),
        ];
    }
}
