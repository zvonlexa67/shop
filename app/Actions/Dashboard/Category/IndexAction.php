<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use App\Models\Characteristic;

class IndexAction
{
	public function __invoke(int $id): array
	{
		return [
			'categories' => fn() => Category::getAll(),
			'category' => fn() => $this->getCategory($id),
			'characteristics' => fn() => $this->getCharacteristics(),
			// 'is_component' => fn() => $IsComponent,
		];
	}

	protected function getCharacteristics(): array
	{
		return Characteristic::with('children')
			->orderBy('sort')
			->orderBy('id')
			->get()
			->makeHidden([ 'created_at', 'updated_at'])
			->toTree()
			->toArray();
	}

	protected function getCategory(int $id)
	{
		return $id > 1 ? Category::with(['smart', 'compare'])->find($id) : null;
	}
}
