<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeSaveRequest extends FormRequest
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
            'employee_number' => 'required|string|' . Rule::unique('employees', 'employee_number')->ignore($this->route('id')),
            'name'              => 'required|string|max:100',
            'email'             => 'required|email|max:50',
            'position'          => 'required|integer',
            'gender'            => 'required|string',
            'entry_date'        => 'required|date',
            'member_type'       => 'required|integer',
            'password'          => Rule::requiredIf(!$this->route('id')) . '|string|min:8|max:64',
        ];  
    }
}
