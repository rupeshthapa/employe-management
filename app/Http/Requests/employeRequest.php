<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class employeRequest extends FormRequest
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
            'employee_name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required|string',
            'designation' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|in:male,female',
            'status' => 'required|in:active,inactive',
            'joined_date' => 'required|date',
            'basic_salary' => 'required',
            'image' => 'nullable',
            
        ];
    }
}
