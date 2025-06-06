<?php

namespace App\Http\Requests\Dashboard\Dimension;

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
            'sort' => ['required', 'integer', 'gte: 0'],
            'title' => ['required', 'string', 'max:250'],
        ];
    }

    public function message(): array
    {
        return [
            'sort.required' => 'Отсутствует сортировка',
            'title.required' => 'Отсутствует наименование',
        ];
    }
}
