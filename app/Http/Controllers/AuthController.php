<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('auth.reset-password', [
            'token' => $token ?? $request->query('token'),
            'email' => $request->query('email'),
        ]);
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $remember = $request->boolean('remember', false);
            $user = User::where('email', $credentials['email'])->first();
            if (!$user) {
                return back()->with('error', 'User does not exist.')->withInput($request->only('email'));
            }
            if (!$user->status) {
                return back()->with('error', 'Your account is inactive. Please contact admin.')->withInput($request->only('email'));
            }
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();

                return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
            }
            return back()->with('error', 'Invalid credentials. Please try again.')->withInput($request->only('email'));
        } catch (Exception $e) {
            return back()->with('error', 'An error occurred during login. Please try again later.')->withInput($request->only('email'));
        }
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        try {
            $status = Password::sendResetLink($request->only('email'));

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with('success', __($status));
            }

            return back()->withErrors(['email' => __($status)]);
        } catch (Exception $e) {
            Log::error('Password reset link send failed: '.$e->getMessage());
            return back()->with('error', 'Failed to send password reset link. Please try again later.');
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, $password) {
                    $user->password = Hash::make($password);
                    $user->setRememberToken(Str::random(60));
                    $user->save();
                }
            );

            if ($status == Password::PASSWORD_RESET) {
                return redirect()->route('login')->with('success', __('Your password has been changed successfully.'));
            }

            return back()->withErrors(['email' => [__($status)]]);
        } catch (Exception $e) {
            Log::error('Password reset failed: '.$e->getMessage());
            return back()->with('error', 'Unable to reset password at this time. Please try again later.');
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Logged out successfully.');
        } catch (Exception $e) {
            Log::error('Logout failed: '.$e->getMessage());
            return redirect()->route('login')->with('error', 'Unable to log out at this time. Please try again.');
        }
    }
}