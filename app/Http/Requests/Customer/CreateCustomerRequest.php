<?php

namespace App\Http\Requests\Customer;

use App\Utils\Primitives\Enum\CustomerStatus;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'customer_group_id' => 'exists:customer_groups,id',
            'name' => 'string|min:5|max:100',
            'company_name' => 'string|min:3|max:255',
            'npwp' => 'string',
            'npwp_name' => 'string',
            'status' => 'required|in:' . implode(',', CustomerStatus::values()),
            'npwp_address' => 'string',
            'nppkp' => 'string',
            'outlet_name' => 'string',
            'alias' => 'string',
            'address' => 'string|required',
            'address_number' => 'nullable|string',
            'rt_rw' => 'nullable|string',
            'province' => '|nullable|integer',
            'district' => '|nullable|integer',
            'sub_district' => '|nullable|integer',
            'village' => '|nullable|integer',
            'contact_person_name' => 'string',
            'contact_person_phone' => 'string',
            'contact_person_title' => 'string',
            'title' => 'string',
        ];
    }
}
