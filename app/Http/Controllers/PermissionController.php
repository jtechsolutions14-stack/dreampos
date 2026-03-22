<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        try {
            $permissions = Permission::all();
            return view('permissions.index', compact('permissions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load permissions. Please try again.');
        }
    }

    public function create()
    {
        return redirect()->route('permissions.index');
    }

    public function store(StorePermissionRequest $request)
    {
        try {
            $permission = Permission::create(['name' => $request->name]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Permission created successfully.',
                    'permission' => $permission
                ]);
            }

            return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create permission.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to create permission. Please try again.');
        }
    }

    public function show(Permission $permission)
    {
        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        return redirect()->route('permissions.index');
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        try {
            $permission->update(['name' => $request->name]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Permission updated successfully.',
                    'permission' => $permission
                ]);
            }

            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update permission.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to update permission. Please try again.');
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();

            if (request()->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Permission deleted successfully.']);
            }

            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete permission.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to delete permission. Please try again.');
        }
    }
}