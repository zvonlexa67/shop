<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
  use HasFactory;

  public const string STORAGE_DIR_IMAGES = '/images/products/';
  public const string KEY_CACHE_PCC = 'pcc_';
  protected $table = 'products';
  protected $fillable = [
    'active',
    'sort',
    'price',
    'title',
    'tooltip',
    'slug',
    'picture_image',
    'description',
    'ancestor',
  ];

  protected $attributes = [
    'active' => true,
    'sort' => 100,
    // 'price' => 0,
  ];

  protected function casts(): array
  {
    return [
      'created_at' => 'datetime:d-m-Y H:i:s',
      'updated_at' => 'datetime:d-m-Y H:i:s',
      'picture_image' => 'array',
      'price' => 'object',
    ];
  }

  protected static function boot(): void
  {
    parent::boot();

    static::creating(function (Product $product) {
      $product->slug ??= Str::slug($product->title);
    });

    static::deleting(function (Product $product) {
      deleteStorageDirId(self::STORAGE_DIR_IMAGES, $product->id);
    });
  }

  public function categories(): BelongsToMany
  {
    return $this->belongsToMany(Category::class, 'product_category');
  }

  public function characteristic(): BelongsToMany
  {
    // return $this->belongsToMany(Characteristic::class, 'product_characteristic');

    return $this->belongsToMany(Characteristic::class, 'product_characteristic')
        ->using(ProductCharacteristics::class)
        ->withPivot('value');
  }

  public static function clearCachePCC() : void
  {
    $prefix = config('database.redis.options.prefix') .env('CACHE_PREFIX') . self::KEY_CACHE_PCC;
      
    $store = Cache::store('redis');
    $redis = $store->getRedis();
    $cursor = null;

    [$cursor, $keys] = $redis->scan(
      $cursor, 
      [ 
        'match' => "$prefix*", 
        'count' => 10000 
      ]
    );

    if ($keys) {
      $cleanKeys = array_map(fn($p) => self::KEY_CACHE_PCC . $p, 
      array_map(fn($k) => str_replace($prefix, '', $k), $keys));

      Cache::deleteMultiple($cleanKeys);
    }
  }
}
