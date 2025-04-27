<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
    public function rules($userId)
    {
        return [
            'name' => ['required', 'string'],
            'username' => ['required', Rule::unique('users', 'username')->ignore($userId)],
            'phone' => ['nullable', 'digits:8', Rule::unique('users', 'phone')->ignore($userId)],  // Ou remplace par regex si nécessaire
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'address' => ['nullable', 'string'],
        ];
    }
}
