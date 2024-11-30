<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagementSettingUpSertRequest extends FormRequest
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
            "maximum_range_visit" => "required|integer",
            "minimum_visit_per_day" => "required|integer|lt:maximum_visit_per_day",
            "maximum_visit_per_day" => "required|integer|gt:minimum_visit_per_day",
            "minimum_location_accuracy" => "required|integer|lte:100|gte:1",
        ];
    }
}
