<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'id' => ['required', 'integer', 'gt:1'],
            'sort' => ['required', 'integer', 'gt:0'],
            'title' => ['required', 'string', 'max:250'],
            'slug' => ['required', 'string', 'max:250', Rule::unique('categories')->ignore($this->id) ],
            'picture_file_image' => ['nullable', 'file', 'image'],
            'picture_file_icon' => ['nullable', 'file', 'extensions:svg', 'mimes:svg'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'slug.required' => 'Отсутствует слаг',
            'slug.unique' => "Слаг '{$this->slug}' - уже существует",
            'sort.required' => 'Отсутствует сортировка',
            'picture_file_icon.extensions' => 'Не допустимое расширение',
            'picture_file_icon.mimes' => 'Не правильный тип mimes',
        ];
    }
}
