<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::all();
            return view('roles.index', compact('roles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load roles. Please try again.');
        }
    }

    public function permissions(Role $role)
    {
        try {
            $permissions = Permission::all();
            $rolePermissions = $role->permissions->pluck('name')->toArray();
            return view('roles.assign-permissions', compact('role', 'permissions', 'rolePermissions'));
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Failed to load role permissions. Please try again.');
        }
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'sometimes|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        try {
            $role->syncPermissions($request->input('permissions', []));
            return redirect()->route('roles.index')->with('success', 'Role permissions updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', 'Failed to update role permissions. Please try again.');
        }
    }

    public function create()
    {
        return redirect()->route('roles.index');
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            $role = Role::create(['name' => $request->name]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Role created successfully.',
                    'role' => $role
                ]);
            }

            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create role.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to create role. Please try again.');
        }
    }

    public function show(Role $role)
    {
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        return redirect()->route('roles.index');
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $role->update(['name' => $request->name]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Role updated successfully.',
                    'role' => $role
                ]);
            }

            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update role.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to update role. Please try again.');
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();

            if (request()->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Role deleted successfully.']);
            }

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete role.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to delete role. Please try again.');
        }
    }
}