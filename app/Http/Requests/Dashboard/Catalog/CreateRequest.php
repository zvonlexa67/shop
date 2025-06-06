<?php

namespace App\Http\Requests\Dashboard\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'id' => [ 'required', 'integer', 'lte:0' ],
            'title' => [ 'required', 'string', 'max:250' ],
            'image' => [ 'nullable', 'file', 'image' ],
            'icon' =>  [ 'nullable', 'file', 'extensions:svg', 'mimes:svg' ],
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



