<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Please enter your current password',
            'new_password.required' => 'Please enter a new password',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.confirmed' => 'The new password and confirmation do not match.',
            'new_password.regex' => 'Password must include uppercase, lowercase, number and special character.',
        ];
    }
}
