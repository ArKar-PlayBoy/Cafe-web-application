<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $users = User::with('role')->get();
=======
        $users = User::with('role')->paginate(15);

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
<<<<<<< HEAD
        $roles = Role::where('name', '!=', 'admin')->get();
=======
        $roles = Role::all();

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
<<<<<<< HEAD
            'role_id' => 'required|exists:roles,id',
=======
            'role_id' => 'nullable|exists:roles,id',
>>>>>>> 5b466fb (more reliable and front-end changes)
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

<<<<<<< HEAD
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
=======
        // (Removed previous block preventing admin role assignment)

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
>>>>>>> 5b466fb (more reliable and front-end changes)
            'phone' => $request->phone,
            'address' => $request->address,
            'email_verified_at' => now(),
        ]);

<<<<<<< HEAD
=======
        // Set role_id explicitly (not mass-assignable for security)
        $user->role_id = $request->role_id;
        $user->save();

>>>>>>> 5b466fb (more reliable and front-end changes)
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
<<<<<<< HEAD
        $roles = Role::where('name', '!=', 'admin')->get();
=======
        $roles = Role::all();

>>>>>>> 5b466fb (more reliable and front-end changes)
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
<<<<<<< HEAD
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
=======
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'nullable|exists:roles,id',
>>>>>>> 5b466fb (more reliable and front-end changes)
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:8',
        ]);

        $data = $request->only([
            'name',
            'email',
<<<<<<< HEAD
            'role_id',
            'phone',
            'address',
            'password',
        ]);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
=======
            'phone',
            'address',
        ]);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Set role_id explicitly (not mass-assignable for security)
        $user->role_id = $request->role_id;
        $user->save();

>>>>>>> 5b466fb (more reliable and front-end changes)
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot delete admin user.');
        }
        $user->delete();
<<<<<<< HEAD
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
=======

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function ban(Request $request, User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot ban admin user.');
        }

        $request->validate([
            'ban_reason' => 'nullable|string|max:255',
        ]);

        $user->ban($request->ban_reason);

        return back()->with('success', 'User has been banned successfully.');
    }

    public function unban(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot unban admin user.');
        }

        $user->unban();

        return back()->with('success', 'User has been unbanned successfully.');
    }
>>>>>>> 5b466fb (more reliable and front-end changes)
}
