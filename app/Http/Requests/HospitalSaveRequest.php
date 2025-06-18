<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalSaveRequest extends FormRequest
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
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'hospital_name'     => 'required|string|max:255',
                'hospital_address'  => 'required|string',
                'hospital_image'    => 'nullable|image|max:5120',
                'hospital_ph_no'    => 'required|string|min:6|max:12'
            ];
        }
        return $rules;
    }
}
