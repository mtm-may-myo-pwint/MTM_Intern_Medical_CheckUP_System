<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckupInformRequest extends FormRequest
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
            'checkup'   => 'required|array',
            'package_id' => 'required',
            'deadline_date' => 'required|date'
        ];
    }
}
