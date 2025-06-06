<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
	use HasFactory, NodeTrait;

	private const string CACHE_ALL = 'allCategory';

	private const int COUNT_COLUMN = 4;

	public const string STORAGE_DIR_IMAGES = '/images/category/';

	public const string STORAGE_DIR_ICONS = '/icons/category/';

	protected $table = 'categories';

  protected $fillable = [
    'parent_id',
    'sort',
    'title',
    'slug',
    'count_products',
    'picture_icon',
    'picture_image',
  ];

  protected $attributes = [
    'count_products' => 0,
  ];

  protected $hidden = [
    '_lft',
    '_rgt',
  ];

  protected function casts(): array
  {
    return [
      'created_at' => 'datetime:d.m.Y H:i:s',
      'updated_at' => 'datetime:d.m.Y H:i:s',
    ];
  }

  protected static function boot(): void
  {
    parent::boot();

    static::creating(function (Category $category) {
      $category->slug ??= Str::slug($category->title);
    });

    static::deleting(function (Category $category) {
      deleteStorageDirId(self::STORAGE_DIR_IMAGES, $category->id);
      deleteStorageDirId(self::STORAGE_DIR_ICONS, $category->id);
    });
  }

  public function smart(): BelongsToMany
  {
    return $this->belongsToMany(Characteristic::class,'smart_cc');
  }

  public function compare(): BelongsToMany
  {
    return $this->belongsToMany(Characteristic::class,'compare_cc');
  }

  // public function characteristics(): BelongsToMany
  // {
  //   return $this->belongsToMany(Characteristic::class)->withPivot('id');
  // }

  public function products(): BelongsToMany
  {
    // return $this->belongsToMany(Product::class, 'product_category')->withPivot('id');
    return $this->belongsToMany(Product::class, 'product_category');
  }

  public static function getAll(): array
  {
    return match (Cache::has(self::CACHE_ALL)) {
      true => Cache::get(self::CACHE_ALL),
      default => tap(self::indexColumn(), fn ($all) => Cache::put(self::CACHE_ALL, $all)),
    };
  }

  public static function clearCache(): bool
  {
    return Cache::forget(self::CACHE_ALL);
  }

  private static function indexColumn(): array
  {
    $arrCat = self::with('children')
      ->orderBy('sort')
      ->orderBy('id')
      ->get()
      ->makeHidden(['created_at', 'updated_at'])
      ->toTree()
      ->toArray();

    $col = self::COUNT_COLUMN - 1;

    if($arrCat) {
      foreach ($arrCat[0]['children'] as $key => $child) {
        $arr = [];
        $arr = $child['children'];
        $arrChildren = [];

        foreach ($arr as $children) {
          $arrChildren[] = count($children['children']) + 2;
        }

        $sum = array_sum($arrChildren);
        $h = ceil($sum / $col);

        $index = 0;
        $level = 0;
        $arrColumn = [];

        foreach ($arrChildren as $char) {
          if (($level + $char) > $h) {
            $index++;
            $level = $char;
          } else {
            $level += $char;
          }

          $arrColumn[] = $index;
        }

        foreach ($arrColumn as $k => $ic) {
          $arrCat[0]['children'][$key]['children'][$k]['ic'] = $ic;
        }
      }
    }

    return $arrCat;
  }
}
