<?php

namespace App\Http\Requests\Dashboard\Color;

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
            'id' => ['required', 'integer', 'gte:1'],
            'title' => ['required', 'string', 'max:250'],
            'sort' => ['required', 'integer', 'gte:0'],
            'picture_image' => ['nullable', 'file', 'image'],
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
        ];
    }
}
