<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class SyncCategoriesRequest extends FormRequest
{
  protected function prepareForValidation()
  {
    $this->replace([
       'id' => $this->id,
       'categories'=> $this->categories,
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
      'id'=>[ 'required', 'integer' ],
      'categories'=>[ 'nullable', 'array' ],
      'categories.*' => [ 'integer'],
    ];
  }

  public function messages(): array
  {
    return [
      'id.request'=> 'Отсутствует id',
      'categories.array' => 'Поле categories должно быть массивом',
      'categories.*.integer' => 'Все элементы массива categories должны быть целыми числами',
    ];
  }
}
