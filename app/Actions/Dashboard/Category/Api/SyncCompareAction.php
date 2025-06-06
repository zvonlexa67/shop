<?php

namespace App\Actions\Dashboard\Category\Api;

use App\Models\Category;

class SyncCompareAction
{
  public function __invoke(array $request): void
  {
    $compare = Category::find($request['id'])->compare();

    $compare->detach($request['todoIds']);
    $compare->syncWithoutDetaching($request['doneIds']);
  }
}