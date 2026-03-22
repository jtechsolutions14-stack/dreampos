@extends('layouts.master')
@section('title', 'Roles')

@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content">            
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Roles & Permission</h4>
                        <h6>Manage your roles</h6>
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
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-role"><i
                            data-feather="plus-circle" class="me-2"></i> Add New Role</a>
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
                                    <th>Role Name</th>
                                    <th>Created On</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $index => $role)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->created_at->format('d M Y') }}</td>
                                        {{-- <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit-role" onclick="editRole({{ $role->id }}, '{{ $role->name }}')">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <button type="button" class="p-2 confirm-text" style="border: none; background: none;" onclick="deleteRole({{ $role->id }}, '{{ $role->name }}')">
                                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                                </button>
                                            </div>
                                        </td> --}}
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit-role"
                                                    onclick="editRole({{ $role->id }}, '{{ $role->name }}')">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <a class="p-2 me-2" href="{{ route('roles.permissions', $role->id) }}">
                                                    <i data-feather="shield" class="shield"></i>
                                                </a>
                                                <a class="p-2" href="javascript:void(0);"
                                                    onclick="deleteRole({{ $role->id }}, '{{ $role->name }}')">
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

    <!-- Add Role -->
    <div class="modal fade" id="add-role">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header d-flex justify-content-between align-items-start">
                            <div class="page-title">
                                <h4>Create Role</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form id="add-role-form" action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="mb-0">
                                    <label class="form-label">Role Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="modal-footer-btn">
                                    <button type="button" class="btn btn-cancel me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Create Role</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Role -->

    <!-- Edit Role -->
    <div class="modal fade" id="edit-role">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header d-flex justify-content-between align-items-start">
                            <div class="page-title">
                                <h4>Edit Role</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form id="edit-role-form" action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-0">
                                    <label class="form-label">Role Name</label>
                                    <input type="text" name="name" id="edit-role-name" class="form-control"
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
            $('#add-role-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a role name",
                        minlength: "Role name must be at least 2 characters"
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
                            $('#add-role').modal('hide');
                            $('#add-role-form')[0].reset();
                            $('#add-role-form').validate().resetForm();
                            sessionStorage.setItem('success', 'Role created successfully');
                            location.reload();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $('#add-role-form').find('.is-invalid').removeClass(
                                    'is-invalid');
                                $('#add-role-form').find('.invalid-feedback').remove();
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

            // Validation for edit role form
            $('#edit-role-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a role name",
                        minlength: "Role name must be at least 2 characters"
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
                            $('#edit-role').modal('hide');
                            $('#edit-role-form')[0].reset();
                            $('#edit-role-form').validate().resetForm();
                            sessionStorage.setItem('success', 'Role updated successfully');
                            location.reload();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $('#edit-role-form').find('.is-invalid').removeClass(
                                    'is-invalid');
                                $('#edit-role-form').find('.invalid-feedback').remove();
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

            // Reset form when add role modal is closed
            $('#add-role').on('hidden.bs.modal', function () {
                $('#add-role-form')[0].reset();
                $('#add-role-form').validate().resetForm();
                $('#add-role-form').find('.is-invalid').removeClass('is-invalid');
                $('#add-role-form').find('.invalid-feedback').remove();
            });

            // Reset form when edit role modal is closed
            $('#edit-role').on('hidden.bs.modal', function () {
                $('#edit-role-form')[0].reset();
                $('#edit-role-form').validate().resetForm();
                $('#edit-role-form').find('.is-invalid').removeClass('is-invalid');
                $('#edit-role-form').find('.invalid-feedback').remove();
            });
        });

        function editRole(id, name) {
            document.getElementById('edit-role-form').action = '{{ url('/roles') }}/' + id;
            document.getElementById('edit-role-name').value = name;
        }

        function deleteRole(id, name) {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: "You want to delete the role '" + name + "'?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('/roles') }}/' + id,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        headers: {
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            sessionStorage.setItem('success', 'Role deleted successfully');
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>
@endpush
