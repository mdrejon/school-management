<?php

namespace Modules\Student\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'class_id' => 'required',
            'section_id' => 'required',
            'group' => 'required|string|max:255',
            'gender' => 'nullable|string|max:50',
            'roll_no' => 'required|string|max:255',
            'registration_no' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:50',
            'religion' => 'nullable|string|max:100',
            'admission_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            
            'guardian_name' => 'required|string|max:255',
            'guardian_email' => 'nullable|email|max:255',
            'guardian_phone' => 'required|string|max:255',
            'guardian_relationship' => 'required|string|max:255',
            'guardian_address' => 'nullable|string',
            
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            
            'picture' => 'nullable|image|max:2048'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
