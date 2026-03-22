<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ImageUploadTrait;

    // public function index(Request $request)
    // {
    //     try {
    //         $sort = $request->get('sort', 'default');
    //         $status = $request->get('status', '');
    //         $roleId = $request->get('role', '');
            
    //         $query = User::with('roles');
            
    //         // Apply filters
    //         if ($status !== '') {
    //             $query->where('status', $status);
    //         }
            
    //         if ($roleId !== '') {
    //             $query->whereHas('roles', function ($q) use ($roleId) {
    //                 $q->where('role_id', $roleId);
    //             });
    //         }
            
    //         // Apply sorting
    //         if ($sort === 'newest') {
    //             $query->orderBy('created_at', 'DESC');
    //         } elseif ($sort === 'oldest') {
    //             $query->orderBy('created_at', 'ASC');
    //         } else {
    //             $query->orderBy('id', 'DESC');
    //         }
            
    //         $users = $query->paginate(10);
    //         $roles = Role::all();
            
    //         // Return JSON for AJAX requests
    //         if ($request->ajax()) {
    //             return response()->json([
    //                 'html' => view('users.table-rows', compact('users'))->render(),
    //                 'pagination' => (string) $users->links()
    //             ]);
    //         }
            
    //         return view('users.index', compact('users', 'roles', 'sort', 'status', 'roleId'));
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to load users. Please try again.');
    //     }
    // }

    public function index(Request $request)
{
    try {
        $sort   = $request->get('sort', 'default');
        $status = $request->get('status');
        $roleId = $request->get('role');

        $query = User::with('roles');

        // ✅ Apply status filter
        if (!is_null($status) && $status !== '') {
            $query->where('status', $status);
        }

        // ✅ Apply role filter (FIXED)
        if (!is_null($roleId) && $roleId !== '') {
            $query->where('role_id', $roleId);
        }

        // ✅ Apply sorting (clean switch)
        switch ($sort) {
            case 'newest':
                $query->latest(); // same as orderBy created_at DESC
                break;

            case 'oldest':
                $query->oldest(); // same as ASC
                break;

            default:
                $query->orderByDesc('id');
                break;
        }

        $users = $query->paginate(10)->withQueryString(); // ✅ keep filters on pagination
        $roles = Role::select('id', 'name')->get(); // ✅ optimized

        // ✅ AJAX response
        if ($request->ajax()) {
            return response()->json([
                'html' => view('users.table-rows', compact('users'))->render(),
                'pagination' => $users->links()->render(), // cleaner
            ]);
        }

        return view('users.index', compact('users', 'roles', 'sort', 'status', 'roleId'));

    } catch (\Throwable $e) {
        return back()->with('error', 'Failed to load users. Please try again.');
    }
}

    public function create()
    {
        return redirect()->route('users.index');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $photoPath = null;
            
            if ($request->hasFile('photo')) {
                $photoPath = $this->uploadImageAsWebp($request->file('photo'), 'users/photos');
            }

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role_id' => (int) $request->role_id,
                'photo' => $photoPath,
                'password' => Hash::make($request->password),
                'status' => $request->status,
            ]);

            if ($request->has('role_id') && $request->role_id) {
                $role = Role::find($request->role_id);
                if ($role) {
                    $user->assignRole($role);
                } else {
                    return redirect()->back()->with('error', 'Selected role does not exist.')->withInput();
                }
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully.',
                    'user' => $user
                ]);
            }

            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create user.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
        }
    }

    public function show($id)
    {
        try {
            $user = User::with('roles')->findOrFail($id);
            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
    }

    public function edit($id)
    {
        return redirect()->route('users.index');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role_id' => (int) $request->role_id,
                'status' => $request->status,
            ];

            if ($request->hasFile('photo')) {
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo);
                }
                $data['photo'] = $this->uploadImageAsWebp($request->file('photo'), 'users/photos');
            }

            $user->update($data);

            // Sync role if provided
            if ($request->has('role_id') && $request->role_id) {
                $role = Role::find($request->role_id);
                if ($role) {
                    $user->syncRoles($role);
                } else {
                    return redirect()->back()->with('error', 'Selected role does not exist.')->withInput();
                }
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User updated successfully.',
                    'user' => $user
                ]);
            }

            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update user.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to update user. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete user. Please try again.');
        }
    }
}