<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleVisitStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_ids' => ['nullable'],
            'employee_id' => ['required', 'exists:employees,id'],
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'visit_category' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_ids.required' => 'Please select a customer.',
            'customer_ids.array' => 'Please select a customer.',
            'customer_ids.min' => 'Please select a customer.',
            'customer_ids.exists' => 'Please select a customer.',
            'start_date.required' => 'Please select a visit range date.',
            'start_date.before_or_equal' => 'Start date cannot be less than end date.',
            'end_date.required' => 'Please select a visit range date.',
            'end_date.before_or_equal' => 'End date cannot be less than start date.',
            'start_date.date' => 'Start date must be a date.',
            'end_date.date' => 'End date must be a date.',
        ];
    }
}
