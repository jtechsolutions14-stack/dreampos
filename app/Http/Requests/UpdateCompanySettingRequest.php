<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanySettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico,webp|max:2048',
            'dark_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'logo_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico,webp|max:2048',
            'address' => 'required|string|max:500',
            'inquiry_email' => 'required|email|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter company name',
            'email.required' => 'Please enter company email',
            'email.email' => 'Please enter a valid email address',
            'contact.required' => 'Please enter contact number',
            'logo.image' => 'Logo must be an image file',
            'favicon.image' => 'Favicon must be an image file',
            'dark_logo.image' => 'Dark logo must be an image file',
            'logo_icon.image' => 'Logo icon must be an image file',
            'address.required' => 'Please enter company address',
            'inquiry_email.required' => 'Please enter inquiry email',
            'inquiry_email.email' => 'Inquiry email must be a valid email address',
        ];
    }
}
