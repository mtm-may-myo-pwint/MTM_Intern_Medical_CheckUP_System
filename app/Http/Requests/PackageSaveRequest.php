<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageSaveRequest extends FormRequest
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
                'package_name'      => 'required|string|max:50',
                'package_price'     => 'required',
                'package_type'      => 'required|integer',
                'package_year'      => 'required',
                'package_image'     => 'nullable|image',
                'hospital_id'       => 'required'
            ];
        }
        return $rules;
    }
}
