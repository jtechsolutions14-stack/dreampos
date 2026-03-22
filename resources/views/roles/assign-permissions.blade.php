@extends('layouts.master')
@section('title', 'Assign Permissions')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            {{-- <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">Assign Permissions to Role</h4>
                    <p class="text-muted mb-0">Role: <strong>{{ $role->name }}</strong></p>
                </div>
                <div>
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Back to Roles</a>
                </div>
            </div> --}}

            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Assign Permissions to Role</h4>
                        <h6>Role: <strong>{{ $role->name }}</strong></h6>
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
            </div>

            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <strong class="me-2">Overall</strong>
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" id="select-all-permissions">
                        <label class="form-check-label" for="select-all-permissions">Select All</label>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('roles.permissions.update', $role->id) }}">
                @csrf

                @php
                    $groupedPermissions = $permissions->groupBy(function ($item) {
                        $parts = explode(':', $item->name);
                        $group = trim($parts[0] ?? 'Other');
                        return ucfirst(strtolower($group));
                    });
                @endphp

                <div class="row gx-3 gy-3">
                    @foreach ($groupedPermissions as $groupName => $group)
                        <div class="col-12 col-lg-4">
                            <div class="card h-100">
                                <div class="card-header bg-primary d-flex justify-content-between align-items-center p-2">
                                    <h6 class="mb-0 text-white">{{ $groupName }}</h6>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input group-select-all" type="checkbox" id="group-select-{{ Str::slug($groupName, '-') }}">
                                        <label class="form-check-label text-white" for="group-select-{{ Str::slug($groupName, '-') }}">Select All</label>
                                    </div>
                                </div>
                                <div class="card-body bg-light p-2">
                                    @foreach ($group as $permission)
                                        <div class="form-check rounded bg-white">
                                            <input class="form-check-input permission-checkbox group-{{ Str::slug($groupName, '-') }}" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission_{{ $permission->id }}" {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                {{ ucfirst(str_replace(['-', '_', '.'], ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 d-flex justify-content-start gap-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const globalSelectAll = document.getElementById('select-all-permissions');
            const allCheckboxes = () => document.querySelectorAll('.permission-checkbox');

            function updateGlobalSelectAll() {
                const permissions = allCheckboxes();
                if (permissions.length === 0) return;
                const total = permissions.length;
                const checked = Array.from(permissions).filter(i => i.checked).length;
                globalSelectAll.checked = checked === total;
                globalSelectAll.indeterminate = checked > 0 && checked < total;
            }

            globalSelectAll.addEventListener('change', function () {
                allCheckboxes().forEach(checkbox => checkbox.checked = this.checked);
                document.querySelectorAll('.group-select-all').forEach(groupCheckbox => groupCheckbox.checked = this.checked);
            });

            document.querySelectorAll('.group-select-all').forEach(groupCheckbox => {
                groupCheckbox.addEventListener('change', function () {
                    const group = this.id.replace('group-select-', '');
                    document.querySelectorAll('.group-' + group).forEach(checkbox => checkbox.checked = this.checked);
                    updateGlobalSelectAll();
                });
            });

            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('permission-checkbox')) {
                    updateGlobalSelectAll();
                    const groupClass = Array.from(event.target.classList).find(c => c.startsWith('group-'));
                    if (groupClass) {
                        const groupName = groupClass.replace('group-', '');
                        const allGroup = document.querySelectorAll('.' + groupName);
                        const allGroupChecked = Array.from(allGroup).every(c => c.checked);
                        const anyGroupChecked = Array.from(allGroup).some(c => c.checked);
                        const groupCheckbox = document.getElementById('group-select-' + groupName);
                        if (groupCheckbox) {
                            groupCheckbox.checked = allGroupChecked;
                            groupCheckbox.indeterminate = !allGroupChecked && anyGroupChecked;
                        }
                    }
                }
            });

            (function () {
                'use strict';
                const forms = document.querySelectorAll('.needs-validation');
                Array.prototype.slice.call(forms).forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            })();

            updateGlobalSelectAll();
        </script>
    @endpush
@endsection
