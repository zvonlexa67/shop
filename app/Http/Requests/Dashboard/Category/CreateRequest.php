<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->slug ?? Str::slug($this->title)
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => ['required', 'integer', 'gt:0' ],
            'title' => ['required', 'string', 'max:250'],
            'picture_file_image' => ['nullable', 'file', 'image'],
            'picture_file_icon' => ['nullable', 'file', 'extensions:svg', 'mimes:svg'],
            'slug' => ['required', 'string', 'unique:categories,slug'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'slug.required' => 'Отсутствует слаг или наименование',
            'slug.unique' => "Слаг '{$this->slug}' - уже существует",
            'picture_file_icon.extensions' => 'Не допустимое расширение',
            'picture_file_icon.mimes' => 'Не правильный тип mimes',
        ];
    }
}
