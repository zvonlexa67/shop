<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class DestroyImageRequest extends FormRequest
{
  protected function prepareForValidation(): void
  {
    $this->replace([
      'picture_image'=> $this->picture_image,
          'id'=> $this->id,
      ]
    );
  }

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'id' => [ 'required', 'integer' ],
      'picture_image'=> [ 'required', 'string' ],
    ];
  }
}
