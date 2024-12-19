<?php

namespace App\Http\Requests\Customer;

use App\Utils\Primitives\Enum\CustomerStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'area_id' => 'exists:areas,id',
            'region_id' => 'exists:regions,id',
            'customer_segment_id' => 'exists:customer_segments,id',
            'customer_category_id' => 'exists:customer_categories,id',
            'customer_group_id' => 'required',
            'name' => 'string|max:255',
            'company_name' => 'string|max:255',
            'npwp' => '|nullable|string',
            'npwp_name' => '|nullable|string',
            'status' => 'required|in:' . implode(',', CustomerStatus::values()),
            'npwp_address' => '|nullable|string',
            'nppkp' => '|nullable|string',
            'outlet_name' => 'string',
            'alias' => 'string',
            'address' => 'string|required',
            'address_number' => 'nullable|string',
            'rt_rw' => 'nullable|string',
            'province' => '|nullable|integer',
            'district' => '|nullable|integer',
            'sub_district' => '|nullable|integer',
            'village' => '|nullable|integer',
            'contact_person_name' => '|nullable|string',
            'contact_person_phone' => '|nullable|string',
            'contact_person_title' => '|nullable|string',
        ];
    }
}
