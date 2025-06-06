<?php

namespace App\Http\Requests\Dashboard\Slide;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [ 'required', 'integer' ],
            'sort' => [ 'required', 'integer' ],
            'name' => [ 'required', 'string', 'max:100' ],
            'href' => [ 'required', 'string', 'max:150' ],
            'picture_file' => [ 'nullable', 'file', 'image' ],
        ];
    }

    public function messages(): array
    {
        return [
            'sort.required' => 'Отсутствует сортировка',
            'name.required' => 'Отсутствует наименование',
            'href.required' => 'Отсутствует ссылка',
        ];
    }
}
