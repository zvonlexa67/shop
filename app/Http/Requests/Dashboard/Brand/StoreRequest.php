<?php

namespace App\Http\Requests\Dashboard\Brand;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'id' => ['required', 'integer', 'size:0'],
            'sort' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:250'],
            'href' => ['required', 'string', 'max:250'],
            'picture_file' => ['required', 'file', 'image'],
            // 'image' => ['nullable', 'file', 'image'],
            // 'icon' => ['nullable', 'file', 'extensions:svg', 'mimes:svg'],
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'href.required' => 'Отсутствует ссылка',
            'picture_file.required' => 'Отсутствует картинка',
            // 'icon.extensions' => 'Не допустимое расширение',
            // 'icon.mimes' => 'Не правильный тип mimes',
        ];
    }
}
