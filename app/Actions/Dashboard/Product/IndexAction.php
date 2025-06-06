<?php

namespace App\Actions\Dashboard\Product;

use App\Models\Color;
use App\Models\Category;
use App\Models\Product;
use App\Models\Characteristic;
use App\Models\CharacteristicProductValue;
use App\Http\Resources\Dashboard\Product\IndexCategoryResource;
use App\Http\Resources\Dashboard\Product\IndexProductResource;
use App\Http\Resources\Dashboard\Product\IndexProductsCollection;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Cache;

class IndexAction
{
  public function __invoke(int $product_id): array
  {
    return [ 
      'categories' => fn() => Category::getAll(),
      'characteristics' => fn() => $this->getChracteristics($product_id),    // Characteristic::get()->toTree()->toArray(),
      'product' => fn() => $this->getProduct($product_id),
      'products' => fn() => $this->getProducts(),    //  Product::all(),
    ];
  }
  /**
   * @param int $category_id
   * @return array|null
   */
  protected function category(int $category_id): ?array
  {
    return 
      $category_id > 0 ? 
        IndexCategoryResource::make(Category::with(['products' => function($query) {
          $query->orderBy('sort');
          $query->orderBy('id');
        }])->find($category_id))->resolve() : null;
        
        // IndexCategoryResource::make(Category::with('products')->find($category_id))->resolve() : null;
    }

  /**
   * @param int $category_id
   * @param int $product_id
   * @return array<array|array{field: string, id: mixed, title: mixed>|null}
   */
  protected function getColor(int $color_id): ?array
  {
    $color = Color::find($color_id);

    return $color instanceof Model ? [
      'value' => $color_id,
      'label' => $color->title,
    ] : $color;
  }

  protected function getChracteristics(int $product_id): array
  {
    $arrPivot = [];

    if ($product_id > 0) {
      $product = Product::with('characteristic')->find($product_id)->characteristic->toArray();

      foreach($product as $k => $v) {
        $arrPivot[$v['pivot']['characteristic_id']] = [
          'type' => $v['pivot']['value']['type'],
          'first' => $v['pivot']['value']['type'] == 8 ? $this->getColor($v['pivot']['value']['first']) : $v['pivot']['value']['first'],
          'last' => $v['pivot']['value']['last'] ?? null,
        ];
      }
    }

    $characteristics = Characteristic::with('children')
      ->orderBy('sort')
      ->orderBy('id')
      ->get()
      ->makeHidden(['created_at', 'updated_at'])
      ->toTree()
      ->toArray();

    foreach($characteristics as $ck => $ch) {
      foreach($ch['children'] as $k => $v) {
        $characteristics[$ck]['children'][$k]['first'] = $arrPivot[$v['id']]['first'] ?? null;
        $characteristics[$ck]['children'][$k]['last'] = $arrPivot[$v['id']]['last'] ?? null;
      }
    }

    return $characteristics;
  }

  protected function char(int $category_id, int $product_id): array
  {
    $category_product_id = Product::find($product_id)->categories()->wherePivot('category_id', $category_id)->get()[0]->pivot->id;

    $chars = Category::with('characteristics')->orderBy('sort')->orderBy('id')->find($category_id)->characteristics;
    $valueCharacteristicProductValue = CharacteristicProductValue::where('category_product_id', $category_product_id)->get();

    $arrChar = [];
    $arrIdParent = [];

    foreach($chars as $char) {
      $arrIdParent[] = $char->parent_id;

      $value = $valueCharacteristicProductValue->where('category_characteristic_id', $char->pivot->id);

      $first = $value->count() ? valueTypeCharacteristic($value->first()->first) : null;
      $last = $value->count() ? valueTypeCharacteristic($value->first()->last) : null;

      // $first = $value->count() ? valueTypeCharacteristic($value->first()->first, $char->type->value) : null;
      // $last = $value->count() ? valueTypeCharacteristic($value->first()->last, $char->type->value) : null;

      $arrChar[] = [
        'field' => 'ch',
        'id' => $char->id,
        'parent_id' => $char->parent_id,
        'pivot_id' => $char->pivot->id,
        'type' => $char->type->value,
        'title' => $char->title,
        'description' => $char->description,
        'first' => $first,
        'last' => $last,
      ];
    }

    $arrIdParent = array_values(array_unique($arrIdParent));

    $parents = Characteristic::orderBy('sort')->orderBy('id')->find($arrIdParent);

    $arrParent = [];

    foreach($parents as $parent) {
      $arrParent[] = [
        'field' => 'pr',
        'id' => $parent->id,
        'title' => $parent->title,
      ];
    }

    $arrResult = [];

    foreach($arrParent as $parent) {
      foreach($arrChar as $char) {
        if ($parent['id'] == $char['parent_id']) {
          $parent['char'][] = $char;
        }
      }

      $arrResult[] = $parent;
    }

    return $arrResult;
  }

  /**
   * @param int $product_id
   * @return array|null
   */
  protected function getProduct(int $product_id): ?IndexProductResource
  {
    return $product_id > 0 ? IndexProductResource::make(Product::with(['categories'])->find($product_id)) : null;
  }

  protected function getProducts(): IndexProductsCollection
  {
    return IndexProductsCollection::make(Product::all()->sortBy('id')->sortBy('sort'));
  }
}

