<?php

namespace App\Http\Requests\Dashboard\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'gt:0'],
            'sort' => ['required', 'integer', 'gt:0'],
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
