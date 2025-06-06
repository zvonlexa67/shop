<?php

namespace App\Models;

use App\Enums\TypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Kalnoy\Nestedset\NodeTrait;

class Characteristic extends Model
{
	use HasFactory, NodeTrait;

	protected $table = 'characteristics';

	protected $fillable = [
		'parent_id',
		'sort',
		'title',
		'smart',
		'type',
		'category_id',
		'description',
  ];

  protected $attribute = [
    'type' => TypeEnum::Boolean,
    'sort' => 100,
  ];

  protected $hidden = [
    '_lft',
    '_rgt',
  ];

  protected function casts(): array
  {
    return [
      'type' => TypeEnum::class,
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
  }

  // public function categories(): BelongsToMany
  // {
  //   return $this->belongsToMany(Category::class);
  // }

  public function smart(): BelongsToMany
  {
    return $this->belongsToMany(Category::class, 'smart_cc');
  }

  public function compare(): BelongsToMany
  {
    return $this->belongsToMany(Category::class,'compare_cc');
  }
}
