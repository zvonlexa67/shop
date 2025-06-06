<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;

class SyncSmartRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'id' => ['required','integer'],
      'todoIds' => [ 'nullable', 'array' ],
      'doneIds' => [ 'nullable', 'array' ],
    ];
  }

  public function messages(): array
  {
    return [
      'id.required' => 'Отсутствует идентификатор категории',
    ];
  }
}
