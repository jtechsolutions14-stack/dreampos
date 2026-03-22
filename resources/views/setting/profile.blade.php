@extends('layouts.master')
@section('title', 'Profile Settings')

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
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
                                @csrf
                                <div class="setting-title">
                                    <h4>Profile Settings</h4>
                                </div>
                                <div class="card-title-head">
                                    <h6><span><i data-feather="user" class="feather-chevron-up"></i></span>Employee
                                        Information</h6>
                                </div>
                                <div class="profile-pic-upload">
                                    <div class="profile-pic">
                                        @if($user->photo)
                                            <img id="photo_preview" src="{{ asset('storage/' . $user->photo) }}" alt="Profile preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 1px solid #ccc;" />
                                        @else
                                            <span id="photo_preview_placeholder"><i data-feather="plus-circle" class="plus-down-add"></i> Profile Photo</span>
                                        @endif
                                    </div>
                                    <div class="new-employee-field">
                                        <div class="mb-0">
                                            <div class="image-upload mb-0">
                                                <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                                <div class="image-uploads">
                                                    <h4>Change Image</h4>
                                                </div>
                                            </div>
                                            @error('photo')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $user->first_name) }}">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name) }}">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile', $user->mobile) }}">
                                            @error('mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-start settings-bottom-btn">
                                    <button type="submit" class="btn btn-submit" id="profile-submit">Save Changes</button>
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
            let message = sessionStorage.getItem('success');
            if (message) {
                showToast(message, "success");
                sessionStorage.removeItem('success');
            }

            // Photo preview functionality
            $('#photo').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photo_preview').attr('src', e.target.result).show();
                        $('#photo_preview_placeholder').hide();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#photo_preview').hide();
                    $('#photo_preview_placeholder').show();
                }
            });

            // Form validation
            $('#profile-form').validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        required: true
                    },
                    photo: {
                        accept: "image/*"
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter first name",
                        minlength: "First name must be at least 2 characters"
                    },
                    last_name: {
                        required: "Please enter last name",
                        minlength: "Last name must be at least 2 characters"
                    },
                    email: {
                        required: "Please enter email address",
                        email: "Please enter a valid email address"
                    },
                    mobile: {
                        required: "Please enter mobile number"
                    },
                    photo: {
                        accept: "Please upload a valid image file"
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
                    var $submitBtn = $('#profile-submit');
                    var originalBtnText = $submitBtn.html();
                    
                    $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...');
                    
                    form.submit();
                }
            });
        });
    </script>
@endpush