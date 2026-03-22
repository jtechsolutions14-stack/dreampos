<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateCompanySettingRequest;
use App\Http\Requests\UpdateSMTPSettingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\CompanySetting;
use App\Models\SMTPSetting;
use App\Traits\ImageUploadTrait;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function showProfile()
    {
        $user = Auth::user();
        return view('setting.profile', compact('user'));
    }

    public function showCompanySettings()
    {
        $companySetting = CompanySetting::first() ?? new CompanySetting();
        return view('setting.company-settings', compact('companySetting'));
    }

    public function showChangePassword()
    {
        $user = Auth::user();
        return view('setting.change-password', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->only(['first_name', 'last_name', 'email', 'mobile']);

        if ($request->hasFile('photo')) {
            $photoPath = $this->uploadImageAsWebp($request->file('photo'), 'users/photos');
            $data['photo'] = $photoPath;
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('password_success', 'Password updated successfully');
    }

    public function updateCompanySettings(UpdateCompanySettingRequest $request)
    {
        $companySetting = CompanySetting::first() ?? new CompanySetting();
        $data = $request->only(['name', 'email', 'contact', 'address', 'inquiry_email']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $this->uploadImageAsWebp($request->file('logo'), 'company/logos');
            $data['logo'] = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $faviconPath = $this->uploadImageAsWebp($request->file('favicon'), 'company/favicons');
            $data['favicon'] = $faviconPath;
        }

        // Handle dark logo upload
        if ($request->hasFile('dark_logo')) {
            $darkLogoPath = $this->uploadImageAsWebp($request->file('dark_logo'), 'company/logos');
            $data['dark_logo'] = $darkLogoPath;
        }

        // Handle logo icon upload
        if ($request->hasFile('logo_icon')) {
            $logoIconPath = $this->uploadImageAsWebp($request->file('logo_icon'), 'company/icons');
            $data['logo_icon'] = $logoIconPath;
        }

        $companySetting->fill($data)->save();

        return redirect()->back()->with('success', 'Company settings updated successfully');
    }

    public function showSMTPSettings()
    {
        $smtpSetting = SMTPSetting::first() ?? new SMTPSetting();
        return view('setting.smtp-settings', compact('smtpSetting'));
    }

    public function updateSMTPSettings(UpdateSMTPSettingRequest $request)
    {
        $smtpSetting = SMTPSetting::first() ?? new SMTPSetting();
        $data = $request->only([
            'smtp_host',
            'smtp_port',
            'smtp_username',
            'smtp_password',
            'smtp_from_email',
            'smtp_from_name',
            'smtp_encryption'
        ]);

        $smtpSetting->fill($data)->save();

        return redirect()->back()->with('success', 'SMTP settings updated successfully');
    }
}