@forelse ($users as $index => $user)
    <tr>
        <td>{{ $users->firstItem() + $index }}</td>
        <td>
            <div class="userimgname">
                <div>
                    <a href="javascript:void(0);">{{ $user->first_name }} {{ $user->last_name }}</a>
                </div>
            </div>
        </td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->mobile ?? 'N/A' }}</td>
        <td>
            @forelse ($user->roles as $role)
                <span class="badge badge-primary">{{ $role->name }}</span>
            @empty
                <span class="badge badge-secondary">No Role</span>
            @endforelse
        </td>
        <td>
            @if ($user->status === 1)
                <span class="badge badge-linesuccess">Active</span>
            @else
                <span class="badge badge-linedanger">Inactive</span>
            @endif
        </td>
        <td>{{ $user->created_at->format('d M Y') }}</td>
        <td class="action-table-data">
            <div class="edit-delete-action">
                <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                    data-bs-target="#edit-user"
                    onclick="editUser({{ $user->id }}, '{{ $user->first_name }}', '{{ $user->last_name }}', '{{ $user->email }}', '{{ $user->mobile }}', '{{ $user->status }}', '{{ $user->roles->first()->id ?? 'null' }}', '{{ $user->photo ?? '' }}')">
                    <i data-feather="edit" class="feather-edit"></i>
                </a>
                <a class="p-2" href="javascript:void(0);"
                    onclick="deleteUser({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')">
                    <i data-feather="trash-2" class="feather-trash-2"></i>
                </a>
            </div>
        </td>
    </tr>
@empty    
@endforelse
