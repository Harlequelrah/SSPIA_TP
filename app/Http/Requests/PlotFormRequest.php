<?php
namespace App\Http\Requests;

use App\Enums\StatusEnum;
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
            'name' => ['required','string'],
            'area' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'plantation_date' => ['required','date'],
            'status'=>['required',Rule::in(StatusEnum::values())],
            'crop_type' => ['required','string'],
        ];
    }
}
