<?php

namespace App\Actions\Dashboard\Category\Api;

use App\Models\Category;
use App\Models\Characteristic;
use App\Http\Resources\Dashboard\Api\ItemsCollection;

class GetCompareAction
{
  public function __invoke(int $cat_id, int $gr_id): array
  {
    $group = ItemsCollection::make(
      Characteristic::where('parent_id', $gr_id)->get()
      )->resolve();

    $compare = ItemsCollection::make(
      Category::query()->with([
        'compare' => function($query) use($gr_id) {
          $query->where('parent_id', $gr_id);
          }
        ])
        ->find($cat_id)
        ->compare
      )->resolve();

    $todo = [];
    $grsm = array_udiff($group, $compare, fn ($g, $s) => $g['id'] <=> $s['id']);

    foreach ($grsm as $item) {
      $todo[] = $item;
    }

    // dd([
    //   'group'=> $group,
    //   'todo'=> $todo,
    //   'done'=> $smart
    // ]);
    
    return [
      // 'group'=> $group,
      'todo'=> $todo,
      'done'=> $compare
    ];
  }
}