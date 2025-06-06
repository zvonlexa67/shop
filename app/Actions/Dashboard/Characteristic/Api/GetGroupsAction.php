<?php

namespace App\Actions\Dashboard\Characteristic\Api;

use App\Models\Characteristic;
use Illuminate\Database\Eloquent\Collection;

class GetGroupsAction
{
  public function __invoke():Collection
  {
    return Characteristic::query()->whereNull('parent_id')->get();
  }
}