<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
{
  protected function prepareForValidation(): void
  {
    foreach ($this->all()['picture_image'] as $value) {
      if($value['id'] == 0) {
        $this->replace([
          'image'=> $value['file'],
          'id'=> $this->id,
        ]);
      }
    }
  }

  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'id' => [ 'required', 'integer' ],
      'image' => [ 'required', 'file', 'image' ],
    ];
  }

  public function messages(): array
  {
    return [
      'image.required' => 'Отсутствует image',
      'id.required' => 'Отсутствует id',
    ];
  }
}
