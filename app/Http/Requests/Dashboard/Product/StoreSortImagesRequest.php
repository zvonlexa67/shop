<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreSortImagesRequest extends FormRequest
{
  protected function prepareForValidation(): void
  {
    $arr = [];

    foreach($this->picture_image as $value) {
      $arr[] = $value['url'];
    }

    $this->replace([
      'picture_image' => $arr,
      'id'=> $this->id,
    ]);
  }

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'id' => [ 'required', 'integer', 'gt:0' ],
      'picture_image' => [ 'nullable', 'array' ],
    ];
  }
}
