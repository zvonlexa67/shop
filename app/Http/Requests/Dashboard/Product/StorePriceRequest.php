<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [ 'required', 'integer', 'gt:0' ],
            'category_id' => [ 'required', 'integer', 'gt:0' ],
            'base' => [ 'required', 'integer' ],
            'nds' => [ 'required', 'integer' ],
            'purchase' => [ 'required', 'integer' ],
            'price_nds' => [ 'required', 'boolean' ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Отсутствует id',
            'category_id.required' => 'Отсутствует id категории',
            'base.required' => 'Отсутствует базовая цена',
            'nds.required' => 'Отсутствует ставка НДС',
            'purchase.required' => 'Отсутствует закупочная цена',
            'price_nds.required' => 'Включен НДС - отсутствует',
        ];
    }

}
