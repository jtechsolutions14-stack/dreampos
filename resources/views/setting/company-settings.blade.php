@extends('layouts.master')
@section('title', 'Company Settings')

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
                            <form action="{{ route('company-settings.update') }}" method="POST" enctype="multipart/form-data" id="company-settings-form">
                                @csrf
                                <div class="setting-title">
                                    <h4>Company Settings</h4>
                                </div>

                                <!-- Company Information -->
                                <div class="card-title-head">
                                    <h6><span><i data-feather="briefcase" class="feather-chevron-up"></i></span>Company Information</h6>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Company Name</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $companySetting->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Company Email</label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $companySetting->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" name="contact" id="contact" class="form-control @error('contact') is-invalid @enderror" value="{{ old('contact', $companySetting->contact) }}">
                                            @error('contact')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Inquiry Email</label>
                                            <input type="email" name="inquiry_email" id="inquiry_email" class="form-control @error('inquiry_email') is-invalid @enderror" value="{{ old('inquiry_email', $companySetting->inquiry_email) }}">
                                            @error('inquiry_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-blocks">
                                            <label class="form-label">Address</label>
                                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $companySetting->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Logo & Media -->
                                <div class="card-title-head mt-4">
                                    <h6><span><i data-feather="image" class="feather-chevron-up"></i></span>Logo & Media</h6>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="new-employee-field">
                                            <span>Logo</span>
                                            <div class="profile-pic-upload mb-2">
                                                <div class="profile-pic">
                                                    <img id="logo_preview" src="{{ $companySetting->logo ? asset('storage/' . $companySetting->logo) : '' }}" alt="Logo preview" style="{{ $companySetting->logo ? 'display: block' : 'display: none' }}; width: 100px; height: 100px; object-fit: contain; border: 1px solid #ccc;" />
                                                    <span id="logo_preview_placeholder" style="{{ $companySetting->logo ? 'display: none' : 'display: block' }}"><i data-feather="plus-circle" class="plus-down-add"></i> Logo</span>
                                                </div>
                                                <div class="input-blocks mb-0">
                                                    <div class="image-upload mb-0">
                                                        <input type="file" name="logo" id="logo" accept="image/*">
                                                        <div class="image-uploads">
                                                            <h4>Upload Logo</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="logo-error" class="invalid-feedback d-block" style="display: none;"></div>
                                            @error('logo')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="new-employee-field">
                                            <span>Favicon</span>
                                            <div class="profile-pic-upload mb-2">
                                                <div class="profile-pic">
                                                    <img id="favicon_preview" src="{{ $companySetting->favicon ? asset('storage/' . $companySetting->favicon) : '' }}" alt="Favicon preview" style="{{ $companySetting->favicon ? 'display: block' : 'display: none' }}; width: 100px; height: 100px; object-fit: contain; border: 1px solid #ccc;" />
                                                    <span id="favicon_preview_placeholder" style="{{ $companySetting->favicon ? 'display: none' : 'display: block' }}"><i data-feather="plus-circle" class="plus-down-add"></i> Favicon</span>
                                                </div>
                                                <div class="input-blocks mb-0">
                                                    <div class="image-upload mb-0">
                                                        <input type="file" name="favicon" id="favicon" accept="image/*">
                                                        <div class="image-uploads">
                                                            <h4>Upload Favicon</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="favicon-error" class="invalid-feedback d-block" style="display: none;"></div>
                                            @error('favicon')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="new-employee-field">
                                            <span>Dark Logo</span>
                                            <div class="profile-pic-upload mb-2">
                                                <div class="profile-pic">
                                                    <img id="dark_logo_preview" src="{{ $companySetting->dark_logo ? asset('storage/' . $companySetting->dark_logo) : '' }}" alt="Dark Logo preview" style="{{ $companySetting->dark_logo ? 'display: block' : 'display: none' }}; width: 100px; height: 100px; object-fit: contain; border: 1px solid #ccc;" />
                                                    <span id="dark_logo_preview_placeholder" style="{{ $companySetting->dark_logo ? 'display: none' : 'display: block' }}"><i data-feather="plus-circle" class="plus-down-add"></i> Dark Logo</span>
                                                </div>
                                                <div class="input-blocks mb-0">
                                                    <div class="image-upload mb-0">
                                                        <input type="file" name="dark_logo" id="dark_logo" accept="image/*">
                                                        <div class="image-uploads">
                                                            <h4>Upload Dark Logo</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="dark_logo-error" class="invalid-feedback d-block" style="display: none;"></div>
                                            @error('dark_logo')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="new-employee-field">
                                            <span>Logo Icon</span>
                                            <div class="profile-pic-upload mb-2">
                                                <div class="profile-pic">
                                                    <img id="logo_icon_preview" src="{{ $companySetting->logo_icon ? asset('storage/' . $companySetting->logo_icon) : '' }}" alt="Logo Icon preview" style="{{ $companySetting->logo_icon ? 'display: block' : 'display: none' }}; width: 100px; height: 100px; object-fit: contain; border: 1px solid #ccc;" />
                                                    <span id="logo_icon_preview_placeholder" style="{{ $companySetting->logo_icon ? 'display: none' : 'display: block' }}"><i data-feather="plus-circle" class="plus-down-add"></i> Logo Icon</span>
                                                </div>
                                                <div class="input-blocks mb-0">
                                                    <div class="image-upload mb-0">
                                                        <input type="file" name="logo_icon" id="logo_icon" accept="image/*">
                                                        <div class="image-uploads">
                                                            <h4>Upload Logo Icon</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="logo_icon-error" class="invalid-feedback d-block" style="display: none;"></div>
                                            @error('logo_icon')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-start settings-bottom-btn mt-4">
                                    <button type="submit" class="btn btn-submit" id="company-settings-submit">Save Changes</button>
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
        // Custom validator for image file type
        $.validator.addMethod("accept", function(value, element, param) {
            if (!value) return true;
            if (!element.files || element.files.length === 0) return true;
            var acceptableTypes = param.split(',').map(s => s.trim());
            var fileType = element.files[0].type;
            return acceptableTypes.some(type => {
                if (type === 'image/*') return fileType.startsWith('image/');
                return fileType === type;
            });
        }, "Please select a valid image file");

        $(document).ready(function() {
            // Preview functions for all logo/favicon uploads - matching add user form implementation
            function previewImage(inputId, previewId, placeholderId) {
                $('#' + inputId).on('change', function() {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#' + previewId).attr('src', e.target.result).show();
                            $('#' + placeholderId).hide();
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $('#' + previewId).hide().attr('src', '');
                        $('#' + placeholderId).show();
                    }
                });
            }

            previewImage('logo', 'logo_preview', 'logo_preview_placeholder');
            previewImage('favicon', 'favicon_preview', 'favicon_preview_placeholder');
            previewImage('dark_logo', 'dark_logo_preview', 'dark_logo_preview_placeholder');
            previewImage('logo_icon', 'logo_icon_preview', 'logo_icon_preview_placeholder');

            // Form validation
            var validator = $('#company-settings-form').validate({
                rules: {
                    name: { required: true, minlength: 2 },
                    email: { required: true, email: true },
                    contact: { required: true },
                    inquiry_email: { required: true, email: true },
                    address: { required: true, minlength: 5 },
                    logo: { accept: "image/*" },
                    favicon: { accept: "image/*" },
                    dark_logo: { accept: "image/*" },
                    logo_icon: { accept: "image/*" }
                },
                messages: {
                    name: { required: 'Please enter company name', minlength: 'Name must be at least 2 characters' },
                    email: { required: 'Please enter company email', email: 'Please enter a valid email' },
                    contact: { required: 'Please enter contact number' },
                    inquiry_email: { required: 'Please enter inquiry email', email: 'Please enter a valid email' },
                    address: { required: 'Please enter address', minlength: 'Address must be at least 5 characters' },
                    logo: { required: 'Please upload logo', accept: 'Please upload a valid image file for logo' },
                    favicon: { required: 'Please upload favicon', accept: 'Please upload a valid image file for favicon' },
                    dark_logo: { required: 'Please upload dark logo', accept: 'Please upload a valid image file for dark logo' },
                    logo_icon: { required: 'Please upload logo icon', accept: 'Please upload a valid image file for logo icon' }
                },
                errorClass: 'invalid-feedback',
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    var fieldName = element.attr('name');
                    var errorContainer = $('#' + fieldName + '-error');
                    if (errorContainer.length) {
                        errorContainer.html(error);
                        errorContainer.show();
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) { $(element).addClass('is-invalid'); },
                unhighlight: function(element) { $(element).removeClass('is-invalid'); },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            // Trigger validation on file input change
            $('#logo, #favicon, #dark_logo, #logo_icon').on('change', function() {
                $(this).valid();
            });
        });
    </script>
@endpush