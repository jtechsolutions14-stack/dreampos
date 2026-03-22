@extends('layouts.master')
@section('title', 'Permissions')

@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Permissions</h4>
                        <h6>Manage your permissions</h6>
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
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-permission"><i
                            data-feather="plus-circle" class="me-2"></i> Add New Permission</a>
                </div>
            </div>
            <!-- /product list -->
            <div class="card table-list-card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a href="" class="btn btn-searchset"><i data-feather="search"
                                        class="feather-search"></i></a>
                            </div>
                        </div>
                        <div class="form-sort">
                            <i data-feather="sliders" class="info-img"></i>
                            <select class="select">
                                <option>Sort by Date</option>
                                <option>Newest</option>
                                <option>Oldest</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Permission Name</th>
                                    <th>Created On</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $index => $permission)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->created_at->format('d M Y') }}</td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit-permission"
                                                    onclick="editPermission({{ $permission->id }}, '{{ $permission->name }}')">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <a class="p-2" href="javascript:void(0);"
                                                    onclick="deletePermission({{ $permission->id }}, '{{ $permission->name }}')">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /product list -->
        </div>
    </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- Add Permission -->
    <div class="modal fade" id="add-permission">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header d-flex justify-content-between align-items-start">
                            <div class="page-title">
                                <h4>Create Permission</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form id="add-permission-form" action="{{ route('permissions.store') }}" method="POST">
                                @csrf
                                <div class="mb-0">
                                    <label class="form-label">Permission Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="modal-footer-btn">
                                    <button type="button" class="btn btn-cancel me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Create Permission</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Permission -->

    <!-- Edit Permission -->
    <div class="modal fade" id="edit-permission">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header d-flex justify-content-between align-items-start">
                            <div class="page-title">
                                <h4>Edit Permission</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form id="edit-permission-form" action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-0">
                                    <label class="form-label">Permission Name</label>
                                    <input type="text" name="name" id="edit-permission-name" class="form-control"
                                        required>
                                </div>
                                <div class="modal-footer-btn">
                                    <button type="button" class="btn btn-cancel me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Save Changes</button>
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
            let message = sessionStorage.getItem('success');
            if (message) {
                showToast(message, "success");
                sessionStorage.removeItem('success');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#add-permission-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a permission name",
                        minlength: "Permission name must be at least 2 characters"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: $(form).serialize(),
                        headers: {
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            $('#add-permission').modal('hide');
                            $('#add-permission-form')[0].reset();
                            $('#add-permission-form').validate().resetForm();
                            sessionStorage.setItem('success', 'Permission created successfully');
                            location.reload();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $('#add-permission-form').find('.is-invalid').removeClass(
                                    'is-invalid');
                                $('#add-permission-form').find('.invalid-feedback').remove();
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
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Validation for edit permission form
            $('#edit-permission-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a permission name",
                        minlength: "Permission name must be at least 2 characters"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: $(form).serialize(),
                        headers: {
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            $('#edit-permission').modal('hide');
                            $('#edit-permission-form')[0].reset();
                            $('#edit-permission-form').validate().resetForm();
                            sessionStorage.setItem('success', 'Permission updated successfully');
                            location.reload();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $('#edit-permission-form').find('.is-invalid').removeClass(
                                    'is-invalid');
                                $('#edit-permission-form').find('.invalid-feedback').remove();
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
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Reset form when add permission modal is closed
            $('#add-permission').on('hidden.bs.modal', function () {
                $('#add-permission-form')[0].reset();
                $('#add-permission-form').validate().resetForm();
                $('#add-permission-form').find('.is-invalid').removeClass('is-invalid');
                $('#add-permission-form').find('.invalid-feedback').remove();
            });

            // Reset form when edit permission modal is closed
            $('#edit-permission').on('hidden.bs.modal', function () {
                $('#edit-permission-form')[0].reset();
                $('#edit-permission-form').validate().resetForm();
                $('#edit-permission-form').find('.is-invalid').removeClass('is-invalid');
                $('#edit-permission-form').find('.invalid-feedback').remove();
            });
        });

        function editPermission(id, name) {
            document.getElementById('edit-permission-form').action = '{{ url('/permissions') }}/' + id;
            document.getElementById('edit-permission-name').value = name;
        }

        function deletePermission(id, name) {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: "You want to delete the permission '" + name + "'?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('/permissions') }}/' + id,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        headers: {
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            sessionStorage.setItem('success', 'Permission deleted successfully');
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>
@endpush