@extends('auth.layouts')
@section('title','Forgot Password')
@section('content')
    <div class="account-content">
        <div class="login-wrapper forgot-pass-wrap bg-img">
            <div class="login-content">
                <form id="forgot-password-form" action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ company_logo_url(asset('assets/img/logo.png')) }}" alt="img">
                        </div>
                        <a href="index.html" class="login-logo logo-white">
                            <img src="{{ company_setting('dark_logo') ? asset('storage/' . company_setting('dark_logo')) : asset('assets/img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Forgot password?</h3>
                            <h4>If you forgot your password, well, then we’ll email you instructions to reset your password.
                            </h4>
                        </div>
                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input type="email" name="email" id="forgot-email" class="form-control" placeholder="Enter your email">
                                <img src="assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Send reset link</button>
                        </div>
                        <div class="signinform text-center">
                            <h4>Return to<a href="{{ route('login') }}" class="hover-a"> login </a></h4>
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