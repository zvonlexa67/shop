<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['nullable', 'string', 'max:255', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Отсутствует имя',
            'password_confirmation.required' => 'Повторите пароль',
            'email.required' => 'Отсутствует почта',
            'password.required' => 'Отсутствует пароль',
            'confirmed' => 'Пароль не подтвержден',
            'unique' => 'Эта почта занята, смените почту',
        ];
    }
}
