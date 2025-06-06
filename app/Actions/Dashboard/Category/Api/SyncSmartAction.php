<?php

namespace App\Actions\Dashboard\Category\Api;

use App\Models\Category;

class SyncSmartAction
{
  public function __invoke(array $request): void
  {
    $smart = Category::find($request['id'])->smart();

    $smart->detach($request['todoIds']);
    $smart->syncWithoutDetaching($request['doneIds']);
  }
}
