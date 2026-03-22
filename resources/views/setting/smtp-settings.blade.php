@extends('layouts.master')
@section('title', 'SMTP Settings')

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
                                                    <a href="javascript:void(0);" class="{{ request()->routeIs('profile') || request()->routeIs('profile.password') ? 'active subdrop' : '' }}"><i
                                                            data-feather="settings"></i><span>General Settings</span><span
                                                            class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a></li>
                                                        <li><a href="{{ route('profile.password') }}" class="{{ request()->routeIs('profile.password') ? 'active' : '' }}">Change Password</a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu">
                                                    <a href="javascript:void(0);" class="{{ request()->routeIs('company-settings') || request()->routeIs('smtp-settings') ? 'active subdrop' : '' }}"><i
                                                            data-feather="airplay"></i><span>Website Settings</span><span
                                                            class="menu-arrow"></span></a>
                                                    <ul>
                                                        <li><a href="{{ route('company-settings') }}" class="{{ request()->routeIs('company-settings') ? 'active' : '' }}">Company Settings</a></li>
                                                        <li><a href="{{ route('smtp-settings') }}" class="{{ request()->routeIs('smtp-settings') ? 'active' : '' }}">SMTP Settings</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="settings-page-wrap">
                            <form action="{{ route('smtp-settings.update') }}" method="POST" id="smtp-settings-form">
                                @csrf

                                <div class="setting-title">
                                    <h4>SMTP Settings</h4>
                                </div>

                                <!-- SMTP Configuration -->
                                <div class="card-title-head">
                                    <h6><span><i data-feather="mail" class="feather-chevron-up"></i></span>SMTP Configuration</h6>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">SMTP Host</label>
                                            <input type="text" name="smtp_host" id="smtp_host" class="form-control @error('smtp_host') is-invalid @enderror" placeholder="e.g., smtp.gmail.com" value="{{ old('smtp_host', $smtpSetting->smtp_host) }}">
                                            @error('smtp_host')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">SMTP Port</label>
                                            <input type="number" name="smtp_port" id="smtp_port" class="form-control @error('smtp_port') is-invalid @enderror" placeholder="e.g., 587" value="{{ old('smtp_port', $smtpSetting->smtp_port) }}">
                                            @error('smtp_port')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">SMTP Username</label>
                                            <input type="text" name="smtp_username" id="smtp_username" class="form-control @error('smtp_username') is-invalid @enderror" placeholder="Your email or username" value="{{ old('smtp_username', $smtpSetting->smtp_username) }}">
                                            @error('smtp_username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">SMTP Password</label>
                                            <div class="pass-group">
                                                <input type="password" name="smtp_password" id="smtp_password" class="pass-input @error('smtp_password') is-invalid @enderror" placeholder="Your password or app password" value="{{ old('smtp_password', $smtpSetting->smtp_password) }}">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                            @error('smtp_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Sender Email</label>
                                            <input type="email" name="smtp_from_email" id="smtp_from_email" class="form-control @error('smtp_from_email') is-invalid @enderror" placeholder="noreply@example.com" value="{{ old('smtp_from_email', $smtpSetting->smtp_from_email) }}">
                                            @error('smtp_from_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Sender Name</label>
                                            <input type="text" name="smtp_from_name" id="smtp_from_name" class="form-control @error('smtp_from_name') is-invalid @enderror" placeholder="Your Company Name" value="{{ old('smtp_from_name', $smtpSetting->smtp_from_name) }}">
                                            @error('smtp_from_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Encryption Type</label>
                                            <select name="smtp_encryption" id="smtp_encryption" class="select @error('smtp_encryption') is-invalid @enderror">
                                                <option value="">Select Encryption</option>
                                                <option value="tls" {{ old('smtp_encryption', $smtpSetting->smtp_encryption) === 'tls' ? 'selected' : '' }}>TLS</option>
                                                <option value="ssl" {{ old('smtp_encryption', $smtpSetting->smtp_encryption) === 'ssl' ? 'selected' : '' }}>SSL</option>
                                            </select>
                                            @error('smtp_encryption')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-start settings-bottom-btn mt-4">
                                    <button type="submit" class="btn btn-submit" id="smtp-settings-submit">Save Settings</button>
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
        $(document).ready(function() {
            // Form validation
            $('#smtp-settings-form').validate({
                rules: {
                    smtp_host: { required: true },
                    smtp_port: { required: true, number: true, min: 1, max: 65535 },
                    smtp_username: { required: true },
                    smtp_password: { required: true, minlength: 6 },
                    smtp_from_email: { required: true, email: true },
                    smtp_from_name: { required: true, minlength: 2 },
                    smtp_encryption: { required: true }
                },
                messages: {
                    smtp_host: { required: 'Please enter SMTP host' },
                    smtp_port: { required: 'Please enter SMTP port', number: 'Port must be a number', min: 'Port must be at least 1', max: 'Port cannot exceed 65535' },
                    smtp_username: { required: 'Please enter SMTP username' },
                    smtp_password: { required: 'Please enter SMTP password', minlength: 'Password must be at least 6 characters' },
                    smtp_from_email: { required: 'Please enter sender email', email: 'Please enter a valid email' },
                    smtp_from_name: { required: 'Please enter sender name', minlength: 'Name must be at least 2 characters' },
                    smtp_encryption: { required: 'Please select encryption type' }
                },
                errorClass: 'invalid-feedback',
                errorElement: 'div',
                highlight: function(element) { $(element).addClass('is-invalid'); },
                unhighlight: function(element) { $(element).removeClass('is-invalid'); },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
