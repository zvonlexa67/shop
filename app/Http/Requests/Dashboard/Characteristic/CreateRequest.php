<?php

namespace App\Http\Requests\Dashboard\Characteristic;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'type' => $this->type === null ? 1 : $this->type[ 'value' ],
        ]);
        // $this->merge([
        //     'type' => is_null($this->type) ? 1 : $this->type[ 'value' ],
        // ]);
    }

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
            'id' => [ 'required', 'integer', 'size:0' ],
            // 'parent_id' => [ 'nullable', 'integer', 'gt:0' ],
            'sort' => [ 'required', 'integer', 'gte:1' ],
            'title' => [ 'required', 'string', 'max:250' ],
            'smart' => [ 'required', 'boolean' ],
            'type' => [ 'required', 'integer', 'gt:0' ],
            'description' => [ 'nullable', 'string', 'max:250' ],
        ];
    }

    public function message(): array
    {
        return [
            'title.required' => 'Отсутствует наименование',
            'sort.required' => 'Отсутствует сортировка',
        ];
    }
}
