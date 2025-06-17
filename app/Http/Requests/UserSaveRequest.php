<?php

namespace App\Http\Requests;

use App\Constants\GeneralConst;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserSaveRequest extends FormRequest
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
                'name' => 'required|string|max:255',
                'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($this->route('id')),
                'password' => Rule::requiredIf(!$this->route('id')) . '|string|min:8|confirmed',
                'password_confirmation' => Rule::requiredIf(!$this->route('id')) . '|string|min:8',
                'role' => 'required|in:' . implode(',', array_keys(GeneralConst::ROLES)),
            ];
        }
        return $rules;
    }
}
