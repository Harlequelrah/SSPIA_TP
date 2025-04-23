<?php

namespace App\Http\Requests;

use App\Enums\InterventionTypeEnum;
use App\Enums\UnitEnum;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InterventionFormRequest extends FormRequest
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
            'description'           => ['nullable', 'string'],
            'product_used_name'     => ['nullable', 'string'],
            'product_used_quantity' => ['nullable', 'numeric', 'min:0', 'max:9999999999.99'],
            'intervention_type'     => ['required', Rule::in(InterventionTypeEnum::values())],
            'intervention_date'     => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . Carbon::now()->subYears(20)->format('Y-m-d'),
            ],
            'unit'                  => ['required', Rule::in(UnitEnum::values())],
            'plot_id'               => ['required', 'exists:plots,id'],
        ];
    }

    public function messages()
    {
        return [
            'intervention_date.before_or_equal' => 'Le champ :attribute doit être une date avant ou égale à aujourd\'hui.',
        ];
    }
}
