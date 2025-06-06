<?php

namespace App\Http\Requests\Dashboard\Chapter;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'lte:0'],
            'title' => ['required', 'string', 'max:250'],
            'image' => ['nullable', 'file', 'image'],
            'icon' => ['nullable', 'file', 'extensions:svg', 'mimes:svg'],
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'icon.extensions' => 'Не допустимое расширение',
            'icon.mimes' => 'Не правильный тип mimes',
        ];
    }
}
