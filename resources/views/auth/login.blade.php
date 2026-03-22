@extends('auth.layouts')
@section('title','Login')
@section('content')
    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content">
                <form id="login-form" action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ company_logo_url(asset('assets/img/logo.png')) }}" alt="img">
                        </div>
                        <a href="#" class="login-logo logo-white">
                            <img src="{{ company_setting('dark_logo') ? asset('storage/' . company_setting('dark_logo')) : asset('assets/img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Access the {{ company_setting('name', 'DreamsPOS') }} panel using your email and passcode.</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-login mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="form-addons">
                                <input type="text" class="form- control" name="email" id="email"
                                    placeholder="Enter email">
                                <img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
                            </div>
                        </div>
                        <div class="form-login mb-3">
                            <label class="form-label">Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input form-control" name="password" id="password"
                                    placeholder="Enter password">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login authentication-check">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center justify-content-between">
                                    <div class="custom-control custom-checkbox">
                                        <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                            <input type="checkbox" class="form-control" name="remember" value="1">
                                            <span class="checkmarks"></span>Remember me
                                        </label>
                                    </div>
                                    <div class="text-end">
                                        <a class="forgot-link" href="{{ route('forgot-password') }}">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Sign In</button>
                        </div>
                        <div class="form-sociallink">
                            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                <p>Copyright &copy; {{ now()->year }} {{ company_setting('name', 'DreamsPOS') }}. All rights reserved</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection