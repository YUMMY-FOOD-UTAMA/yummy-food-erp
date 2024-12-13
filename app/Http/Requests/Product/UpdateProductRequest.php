<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand_id' => ['required', 'integer', 'exists:master_data_code_values,id'],
            'type_id' => ['required', 'integer', 'exists:master_data_code_values,id'],
            'manufacture_id' => ['required', 'integer', 'exists:master_data_code_values,id'],
            'category_id' => ['required', 'integer', 'exists:master_data_code_values,id'],
            'group_id' => ['required', 'integer', 'exists:master_data_code_values,id'],
            'division_id' => ['required', 'integer', 'exists:master_data_code_values,id'],
            'small_unit_id' => ['nullable', 'integer', 'exists:master_data_code_values,id'],
            'big_unit_id' => ['nullable', 'integer', 'exists:master_data_code_values,id'],
        ];
    }
}
