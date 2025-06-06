<?php

namespace App\Actions\Dashboard\Category\Api;

use App\Models\Category;
//use Illuminate\Support\Collection;

class GetCategoryAction
{
  public function __invoke(int $id): Array
  {
    return Category::query()->orderBy('sort')->orderBy('id')->get()->toArray();
  }
}
