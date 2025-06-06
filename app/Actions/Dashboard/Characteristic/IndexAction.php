<?php

namespace App\Actions\Dashboard\Characteristic;

use App\Models\Characteristic;
use App\Enums\TypeEnum;
use App\Http\Resources\Dashboard\Characteristic\IndexResource;

class IndexAction
{
    public function __invoke(int $id): array
    {
        return [
            'characteristics' => fn() => $this->getChracteristics(),
            'characteristic' => fn() => $this->getCharacteristic($id),
            'types' => fn() => $this->getTypes(),
        ];
    }

    protected function getChracteristics(): array
    {
        return  Characteristic::with('children')
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
            ->makeHidden(['created_at', 'updated_at'])
            ->toTree()
            ->toArray();
    }

    protected function getCharacteristic(int $id): ?IndexResource
    {
        return $id ? IndexResource::make(Characteristic::find($id)) : null;
    }

    protected function getTypes(): array
    {
        return TypeEnum::getOptions();
    }
}
