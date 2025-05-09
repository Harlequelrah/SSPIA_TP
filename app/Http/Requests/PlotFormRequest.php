<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlotFormRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                Rule::unique('plots')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
            'area' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'plantation_date' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . Carbon::now()->subYears(20)->format('Y-m-d'),
            ],
            'status' => ['required', Rule::in(StatusEnum::values())],
            'crop_type' => ['required', 'string'],
            'latitude' => ['nullable','numeric'],
            'longitude' => ['nullable','numeric'],
        ];
    }

    public function messages()
    {
        return [
            'plantation_date.before_or_equal' => 'Le champ :attribute doit être une date avant ou égale à aujourd\'hui.',
        ];
    }
}
