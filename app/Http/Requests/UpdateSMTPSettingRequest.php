<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSMTPSettingRequest extends FormRequest
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
            'smtp_host' => 'required|string',
            'smtp_port' => 'required|integer|min:1|max:65535',
            'smtp_username' => 'required|string',
            'smtp_password' => 'required|string|min:6',
            'smtp_from_email' => 'required|email',
            'smtp_from_name' => 'required|string|min:2',
            'smtp_encryption' => 'required|in:tls,ssl',
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'smtp_host.required' => 'Please enter SMTP host',
            'smtp_port.required' => 'Please enter SMTP port',
            'smtp_port.integer' => 'SMTP port must be a number',
            'smtp_port.min' => 'SMTP port must be at least 1',
            'smtp_port.max' => 'SMTP port cannot exceed 65535',
            'smtp_username.required' => 'Please enter SMTP username',
            'smtp_password.required' => 'Please enter SMTP password',
            'smtp_password.min' => 'SMTP password must be at least 6 characters',
            'smtp_from_email.required' => 'Please enter sender email',
            'smtp_from_email.email' => 'Please enter a valid email address',
            'smtp_from_name.required' => 'Please enter sender name',
            'smtp_from_name.min' => 'Sender name must be at least 2 characters',
            'smtp_encryption.required' => 'Please select encryption type',
            'smtp_encryption.in' => 'Encryption type must be TLS or SSL',
        ];
    }
}
