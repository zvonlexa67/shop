<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'id' => [ 'required', 'integer', 'lte:0' ],
      'title' => [ 'required', 'string', 'max:250' ],
      'tooltip' => [ 'nullable', 'string', 'max:250' ],
      'slug' => [ 'nullable', 'string', 'max:250' ],
      'sort' => [ 'required', 'integer', 'gt:0' ],
    ];
  }

  public function messages(): array
  {
    return [
      'title.required' => 'Отсутствует наименование',
      'slug.required' => 'Отсутствует слаг',
      'sort.required' => 'Отсутствует сортировка',
    ];
  }
}
