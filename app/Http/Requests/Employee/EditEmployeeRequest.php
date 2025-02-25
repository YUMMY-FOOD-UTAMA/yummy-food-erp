<?php

namespace App\Http\Requests\Employee;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:15'],
            'full_name' => ['required', 'string', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'phone_number' => ['nullable', 'string', 'max:15', Rule::unique(User::class)],
            'bio' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['date', 'date_format:Y-m-d'],
            'address' => ['string', 'max:255'],
            'timezone' => ['string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:255'],
            'province_id' => ['nullable', 'integer', 'exists:provinces,id'],
            'district_id' => ['nullable', 'integer', 'exists:districts,id'],
            'sub_district_id' => ['nullable', 'integer', 'exists:sub_districts,id'],
            'sub_district_village_id' => ['nullable', 'integer', 'exists:sub_district_villages,id'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->request->get('id')),
            ],
        ];
    }
}
