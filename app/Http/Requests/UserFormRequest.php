<?php

namespace App\Http\Requests;

use App\Enums\InterventionTypeEnum;
use App\Enums\UnitEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
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
            'firstName'           => ['required', 'string'],
            'password' => ['required', 'min:8'],
            'lastName'     => ['required', 'string'],
            'userName' => ['required', 'unique:users,username'],
            'phone' => ['nullable', 'digits:8', 'unique:users,phone'],
            'email' => ['required', 'email', 'unique:users,email'],
            'address' => ['nullable', 'string']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'firstName' => trim($this->firstName),
            'lastName' => trim($this->lastName),
            'email' => trim($this->email),
            'userName' => trim($this->userName),
        ]);
    }
}
