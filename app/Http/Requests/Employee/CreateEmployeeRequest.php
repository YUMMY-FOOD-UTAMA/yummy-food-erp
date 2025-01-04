<?php

namespace App\Http\Requests\Employee;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role_name' => ['required', 'string'],
            'name' => ['nullable', 'string', 'max:15'],
            'full_name' => ['required', 'string', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'phone_number' => ['nullable', 'string', 'max:15', Rule::unique(User::class)],
            'date_of_birth' => ['nullable', 'date', 'date_format:Y-m-d'],
            'address' => ['nullable', 'string', 'max:255'],
            'timezone' => ['required', 'string', 'max:255'],
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
                Rule::unique(User::class),
            ],
            'sub_department_id' => ['required', 'integer', 'exists:sub_departments,id'],
            'level_grade_id' => ['required', 'integer', 'exists:level_grades,id'],
            'nik' => ['required', 'string', 'unique:employees,nik'],
            'join_date' => ['required', 'date', 'date_format:Y-m-d'],
            'date_of_exchange_status' => ['nullable', 'date', 'date_format:Y-m-d'],
            'status' => ['required', 'string'],
            'position' => ['required', 'string', 'max:255'],
        ];
    }
}
