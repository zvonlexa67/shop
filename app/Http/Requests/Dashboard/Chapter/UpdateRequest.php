<?php

namespace App\Http\Requests\Dashboard\Chapter;

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
            'id' => ['required', 'integer', 'gt:0'],
            'sort' => ['required', 'integer', 'gt:0'],
            'catalog_id' => ['required', 'integer', 'gt:0'],
            'title' => ['required', 'string', 'max:250'],
            'slug' => ['required', 'string', 'max:250'],
            'image' => ['nullable', 'file', 'image'],
            'icon' => ['nullable', 'file', 'extensions:svg', 'mimes:svg'],
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'slug.required' => 'Отсутствует слаг',
            'sort.required' => 'Отсутствует сортировка',
            'icon.extensions' => 'Не допустимое расширение',
            'icon.mimes' => 'Не правильный тип mimes',
        ];
    }
}
