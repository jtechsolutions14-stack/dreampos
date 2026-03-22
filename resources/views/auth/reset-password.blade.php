@extends('auth.layouts')
@section('title','Reset Password')
@section('content')
    <div class="account-content">
        <div class="login-wrapper reset-pass-wrap bg-img">
            <div class="login-content">
                <form id="reset-password-form" action="{{ route('password.update') }}" method="post">
                     @csrf
                    <input type="hidden" name="token" value="{{ old('token', $token ?? '') }}">
                    <input type="hidden" name="email" value="{{ old('email', $email ?? '') }}">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ company_logo_url(asset('assets/img/logo.png')) }}" alt="img">
                        </div>
                        <a href="{{ route('login') }}" class="login-logo logo-white">
                            <img src="{{ company_setting('dark_logo') ? asset('storage/' . company_setting('dark_logo')) : asset('assets/img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Reset password?</h3>
                            <h4>Enter New Password & Confirm Password to get inside</h4>
                        </div>
                        <div class="form-login">
                            <label>New Password</label>
                            <div class="pass-group">
                                <input type="password" name="password" id="new-password" class="pass-inputs form-control" placeholder="Enter new password">
                                <span class="fas toggle-passwords fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <label>New Confirm Password</label>
                            <div class="pass-group">
                                <input type="password" name="password_confirmation" id="password-confirm" class="pass-inputa form-control" placeholder="Confirm new password">
                                <span class="fas toggle-passworda fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Change Password</button>
                        </div>
                        <div class="signinform text-center">
                            <h4>Return to <a href="{{ route('login') }}" class="hover-a"> login </a></h4>
                        </div>
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>Copyright &copy; {{ now()->year }} {{ company_setting('name', 'DreamsPOS') }}. All rights reserved</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection