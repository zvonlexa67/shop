<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreDescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [ 'required', 'integer', 'gt:0' ],
            'description' => [ 'required', 'string' ],
        ];
    }

    public function message(): array
    {
        return [
            'id.required' => 'Отсутствует id',
            'description.required' => 'Отсутствует описание',
        ];
    }
}
