@extends('layouts.master')
@section('title', 'Change Password')

@section('content')
    <div class="page-wrapper">
        <div class="content settings-content">
            <div class="page-header settings-pg-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Settings</h4>
                        <h6>Manage your settings on portal</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="settings-wrapper d-flex">
                        <div class="sidebars settings-sidebar" id="sidebar2">
                            <div class="sidebar-inner slimscroll">
                                <div id="sidebar-menu5" class="sidebar-menu">
                                    <ul>
                                        <li class="submenu-open">
                                            <ul>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"
                                                        class="{{ request()->routeIs('profile') || request()->routeIs('profile.password') ? 'active subdrop' : '' }}"><i
                                                            data-feather="settings"></i><span>General Settings</span><span
                                                            class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a href="{{ route('profile') }}"
                                                                class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a>
                                                        </li>
                                                        <li><a href="{{ route('profile.password') }}"
                                                                class="{{ request()->routeIs('profile.password') ? 'active' : '' }}">Change
                                                                Password</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);"
                                                        class="{{ request()->routeIs('company-settings') || request()->routeIs('smtp-settings') ? 'active subdrop' : '' }}"><i
                                                            data-feather="airplay"></i><span>Website Settings</span><span
                                                            class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a href="{{ route('company-settings') }}"
                                                                class="{{ request()->routeIs('company-settings') ? 'active' : '' }}">Company
                                                                Settings</a></li>
                                                        <li><a href="{{ route('smtp-settings') }}"
                                                                class="{{ request()->routeIs('smtp-settings') ? 'active' : '' }}">SMTP
                                                                Settings</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="settings-page-wrap">
                            <form action="{{ route('profile.password.update') }}" method="POST" id="password-form">
                                @csrf
                                <div class="setting-title">
                                    <h4>Change Password</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Old Password</label>
                                            <div class="pass-group">
                                                <input type="password" name="old_password" id="old_password"
                                                    class="form-control pass-input @error('old_password') is-invalid @enderror">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                            @error('old_password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">New Password</label>
                                            <div class="pass-group">
                                                <input type="password" name="new_password" id="new_password"
                                                    class="form-control pass-input @error('new_password') is-invalid @enderror">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                            @error('new_password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Confirm New Password</label>
                                            <div class="pass-group">
                                                <input type="password" name="new_password_confirmation"
                                                    id="new_password_confirmation" class="form-control pass-input">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-start settings-bottom-btn mt-3">
                                    <button type="submit" class="btn btn-submit" id="password-submit">Change
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $.validator.addMethod('strongPassword', function(value, element) {
                return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(value);
            },
            'Password must be at least 8 characters long and include uppercase, lowercase, number and special character.'
            );

        $(document).ready(function() {
            $('#password-form').validate({
                rules: {
                    old_password: {
                        required: true
                    },
                    new_password: {
                        required: true,
                        minlength: 8,
                        strongPassword: true
                    },
                    new_password_confirmation: {
                        required: true,
                        equalTo: '#new_password'
                    }
                },
                messages: {
                    old_password: {
                        required: 'Please enter your old password'
                    },
                    new_password: {
                        required: 'Please enter a new password',
                        minlength: 'Password must be at least 8 characters',
                        strongPassword: 'Must include uppercase, lowercase, number and special character'
                    },
                    new_password_confirmation: {
                        required: 'Please confirm your new password',
                        equalTo: 'Passwords do not match'
                    }
                },
                errorClass: 'invalid-feedback',
                errorElement: 'div',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush