@extends('layouts.master')
@section('title', 'Users')

@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Users</h4>
                        <h6>Manage your users</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a onclick="location.reload()" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn">
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-user"><i
                            data-feather="plus-circle" class="me-2"></i> Add New User</a>
                </div>
            </div>


            <!-- /product list -->
            <div class="card table-list-card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><i data-feather="search"
                                        class="feather-search"></i></a>
                            </div>
                        </div>
						<div class="search-path">
									<div class="d-flex align-items-center">
										<a class="btn btn-filter" id="filter_search">
											<i data-feather="filter" class="filter-icon"></i>
											<span><img src="assets/img/icons/closes.svg" alt="img"></span>
										</a>
									</div>
								</div>
                        <div class="form-sort">
                            <i data-feather="sliders" class="info-img"></i>
                            <select class="select" id="sort-select" name="sort">
                                <option value="default" {{ $sort === 'default' ? 'selected' : '' }}>Sort by order</option>
                                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest</option>
                            </select>
                        </div>
                    </div>
					<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="stop-circle" class="info-img"></i>
												<select class="select" id="filter-status">
													<option value="">Choose Status</option>
													<option value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="zap" class="info-img"></i>
												<select class="select" id="filter-role">
													<option value="">Choose Role</option>
													@foreach ($roles as $role)
														<option value="{{ $role->id }}">{{ $role->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created On</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body">
                                @include('users.table-rows')
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination-container">
                        @if ($users->hasPages())
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-center">
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User -->
    <div class="modal fade" id="add-user">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header d-flex justify-content-between align-items-start">
                            <div class="page-title">
                                <h4>Create User</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form id="add-user-form" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="new-employee-field">
                                            <span>Profile Photo</span>
                                            <div class="profile-pic-upload mb-2">
                                                <div class="profile-pic">
                                                    <img id="photo_preview" src="" alt="Profile preview" style="display: none; width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 1px solid #ccc;" />
                                                    <span id="photo_preview_placeholder"><i data-feather="plus-circle" class="plus-down-add"></i> Profile Photo</span>
                                                </div>
                                                <div class="input-blocks mb-0">
                                                    <div class="image-upload mb-0">
                                                        <input type="file" name="photo" id="photo" accept="image/*">
                                                        <div class="image-uploads">
                                                            <h4>Upload Image</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Role</label>
                                            <select class="select" name="role_id" id="role_id">
                                                <option value="">Choose</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Status</label>
                                            <select class="select" name="status" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label>Password</label>
                                            <div class="pass-group">
                                                <input type="password" name="password" id="password" class="pass-input">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label>Confirm Password</label>
                                            <div class="pass-group">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="pass-input">
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer-btn">
                                    <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-submit" id="add-user-submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /Add User -->

    <!-- Edit User -->
    <div class="modal fade" id="edit-user">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header d-flex justify-content-between align-items-start">
                            <div class="page-title">
                                <h4>Edit User</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form id="edit-user-form" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="new-employee-field">
                                            <span>Profile Photo</span>
                                            <div class="profile-pic-upload mb-2">
                                                <div class="profile-pic">
                                                    <img id="edit_photo_preview" src="" alt="Profile preview" style="display: none; width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 1px solid #ccc;" />
                                                    <span id="edit_photo_preview_placeholder"><i data-feather="plus-circle" class="plus-down-add"></i> Profile Photo</span>
                                                </div>
                                                <div class="input-blocks mb-0">
                                                    <div class="image-upload mb-0">
                                                        <input type="file" name="photo" id="edit_photo" accept="image/*">
                                                        <div class="image-uploads">
                                                            <h4>Upload Image</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="first_name" id="edit-user-first-name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="last_name" id="edit-user-last-name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" id="edit-user-email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" name="mobile" id="edit-user-mobile" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Role</label>
                                            <select name="role_id" id="edit-user-role" class="select">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Status</label>
                                            <select name="status" id="edit-user-status" class="select">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer-btn">
                                    <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-submit" id="edit-user-submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit User -->

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let message = sessionStorage.getItem('success');
            if (message) {
                showToast(message, "success");
                sessionStorage.removeItem('success');
            }
        });

        function editUser(id, firstName, lastName, email, mobile, status, roleId, photo) {
            $('#edit-user-form').attr('action', '/users/' + id);
            $('#edit-user-first-name').val(firstName);
            $('#edit-user-last-name').val(lastName);
            $('#edit-user-email').val(email);
            $('#edit-user-mobile').val(mobile);
            $('#edit_photo').val(''); // Clear file input
            
            // Set status value and trigger change for Select2
            $('#edit-user-status').val(status).trigger('change');
            
            // Store existing photo path and display it
            if (photo && photo.trim() !== '') {
                var photoUrl = '{{ asset("storage") }}/' + photo;
                $('#edit_photo_preview').attr('src', photoUrl).attr('data-existing-src', photoUrl).show();
                $('#edit_photo_preview_placeholder').hide();
            } else {
                $('#edit_photo_preview').hide().attr('src', '').removeAttr('data-existing-src');
                $('#edit_photo_preview_placeholder').show();
            }
            
            // Set role and trigger change for Select2
            if (roleId && roleId !== 'null' && roleId !== null) {
                $('#edit-user-role').val(roleId).trigger('change');
            }
        }

		function deleteUser(id, name) {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: "You want to delete the user '" + name + "'?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('users.destroy',':id') }}".replace(':id', id),
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        headers: {
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            sessionStorage.setItem('success', 'User deleted successfully');
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>

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
            // Validation for add user form
            $('#add-user-form').validate({
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
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '[name="password"]'
                    },
                    role_id: {
                        required: true
                    },
                    status: {
                        required: true
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
                    },
                    password: {
                        required: "Please enter password",
                        minlength: "Password must be at least 8 characters"
                    },
                    password_confirmation: {
                        required: "Please confirm password",
                        equalTo: "Passwords do not match"
                    },
                    role_id: {
                        required: "Please select a role"
                    },
                    status: {
                        required: "Please select status"
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    var $submitBtn = $('#add-user-submit');
                    var originalBtnText = $submitBtn.html();
                    
                    $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Submitting...');
                    
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            $('#add-user').modal('hide');
                            $('#add-user-form')[0].reset();
                            $('#add-user-form').validate().resetForm();
                            sessionStorage.setItem('success', 'User created successfully');
                            location.reload();
                        },
                        error: function(xhr) {
                            // Restore button state on error
                            $submitBtn.prop('disabled', false).html(originalBtnText);
                            
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $('#add-user-form').find('.is-invalid').removeClass('is-invalid');
                                $('#add-user-form').find('.invalid-feedback').remove();
                                $.each(errors, function(field, messages) {
                                    var input = $('[name="' + field + '"]');
                                    input.addClass('is-invalid');
                                    input.after('<div class="invalid-feedback">' +
                                        messages[0] + '</div>');
                                });
                            } else {
                                alert('An error occurred. Please try again.');
                            }
                        }
                    });
                },
                errorClass: 'invalid-feedback',
                errorElement: 'div',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                    if ($(element).hasClass('select')) {
                        $(element).closest('.input-blocks').find('.select2-container').addClass('is-invalid');
                    }
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                    if ($(element).hasClass('select')) {
                        $(element).closest('.input-blocks').find('.select2-container').removeClass('is-invalid');
                    }
                }
            });

            // validate select2-like change events
            $('#add-user-form select, #edit-user-form select').on('change', function() {
                $(this).valid();
            });

            // preview profile photo in add-user form
            $('#photo').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photo_preview').attr('src', e.target.result).show();
                        $('#photo_preview_placeholder').hide();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#photo_preview').hide().attr('src', '');
                    $('#photo_preview_placeholder').show();
                }
            });

            // preview profile photo in edit-user form
            $('#edit_photo').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#edit_photo_preview').attr('src', e.target.result).show();
                        $('#edit_photo_preview_placeholder').hide();
                    };
                    reader.readAsDataURL(file);
                } else {
                    // If no new file selected and there's an existing photo, show it
                    var existingPhoto = $('#edit_photo_preview').attr('data-existing-src');
                    if (existingPhoto && existingPhoto !== '') {
                        $('#edit_photo_preview').attr('src', existingPhoto).show();
                        $('#edit_photo_preview_placeholder').hide();
                    } else {
                        $('#edit_photo_preview').hide().attr('src', '');
                        $('#edit_photo_preview_placeholder').show();
                    }
                }
            });

            // Validation for edit user form
            $('#edit-user-form').validate({
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
                    },
                    role_id: {
                        required: true
                    },
                    status: {
                        required: true
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
                    },
                    role_id: {
                        required: "Please select a role"
                    },
                    status: {
                        required: "Please select status"
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    var $submitBtn = $('#edit-user-submit');
                    var originalBtnText = $submitBtn.html();
                    
                    // Show loading state
                    $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...');
                    
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            $('#edit-user').modal('hide');
                            $('#edit-user-form')[0].reset();
                            $('#edit-user-form').validate().resetForm();
                            sessionStorage.setItem('success', 'User updated successfully');
                            location.reload();
                        },
                        error: function(xhr) {
                            // Restore button state on error
                            $submitBtn.prop('disabled', false).html(originalBtnText);
                            
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $('#edit-user-form').find('.is-invalid').removeClass('is-invalid');
                                $('#edit-user-form').find('.invalid-feedback').remove();
                                $.each(errors, function(field, messages) {
                                    var input = $('[name="' + field + '"]');
                                    input.addClass('is-invalid');
                                    input.after('<div class="invalid-feedback">' +
                                        messages[0] + '</div>');
                                });
                            } else {
                                alert('An error occurred. Please try again.');
                            }
                        }
                    });
                },
                errorClass: 'invalid-feedback',
                errorElement: 'div',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                    if ($(element).hasClass('select')) {
                        $(element).closest('.input-blocks').find('.select2-container').addClass('is-invalid');
                    }
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                    if ($(element).hasClass('select')) {
                        $(element).closest('.input-blocks').find('.select2-container').removeClass('is-invalid');
                    }
                }
            });

            // Handle sort dropdown change
            $('#sort-select').on('change', function() {
                var sortValue = $(this).val();
                var url = new URL(window.location);
                url.searchParams.set('sort', sortValue);
                window.location.href = url.toString();
            });

            // Handle filter button click
            $('#apply-filters').on('click', function() {
                applyFilters();
            });

            // Handle filter dropdown changes (real-time filtering)
            $('#filter-status, #filter-role').on('change', function() {
                applyFilters();
            });

            function applyFilters() {
                var status = $('#filter-status').val();
                var role = $('#filter-role').val();
                var sort = $('#sort-select').val();

                $.ajax({
                    url: '{{ route("users.index") }}',
                    type: 'GET',
                    data: {
                        status: status,
                        role: role,
                        sort: sort
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        $('#users-table-body').html(response.html);
                        $('#pagination-container').html(response.pagination);
                        if (typeof feather !== 'undefined') {
                            feather.replace();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Filter error:', error);
                        alert('Error applying filters. Please try again.');
                    }
                });
            }
        });
    </script>
@endpush