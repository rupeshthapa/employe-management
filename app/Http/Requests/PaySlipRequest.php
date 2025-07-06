<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaySlipRequest extends FormRequest
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
            'employee_id' => 'required',
            'basic_salary' => 'required',
            'payroll_id' => 'required',
            'overtime' => 'required',
            'bonus_id' => 'required',
            'bonus_amount' => 'required',
            'deduction' => 'required',
            'gross_salary' => 'required',
            'net_salary' => 'required',


        ];
    }
}
