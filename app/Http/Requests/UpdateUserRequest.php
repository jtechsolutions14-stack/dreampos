<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id . '|max:255',
            'mobile' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:1,0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email is already registered.',
            'mobile.required' => 'The mobile field is required.',
            'photo.image' => 'Please upload a valid image file.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, webp.',
            'photo.max' => 'The photo size must not exceed 2MB.',
            'role_id.required' => 'Please select a role.',
            'role_id.exists' => 'The selected role does not exist.',
            'status.required' => 'Please select a status.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
