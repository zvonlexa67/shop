<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['nullable'],
            'email_verified_at' => ['date', 'nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Отсутствует имя',
            'password_confirmation.required' => 'Повторите пароль',
            'email.required' => 'Отсутствует почта',
            //            'password.required' => 'Отсутствует пароль',
            'confirmed' => 'Пароль не подтвержден',
            'unique' => 'Эта почта занята, смените почту',
        ];
    }
}
