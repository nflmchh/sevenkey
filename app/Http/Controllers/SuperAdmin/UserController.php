<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || !$user->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        $users = User::paginate(10);
        return view('superadmin.users.index', compact('users'));
    }

    public function create()
    {
        $user = Auth::user();
        if (!$user || !$user->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        return view('superadmin.users.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:superadmin,owner,admin_gudang,operator_gudang,kasir,supervisor_keuangan,marketing',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('superadmin.users.index')
                        ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser || !$authUser->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        return view('superadmin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser || !$authUser->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        return view('superadmin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $authUser = Auth::user();
        if (!$authUser || !$authUser->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:superadmin,owner,admin_gudang,operator_gudang,kasir,supervisor_keuangan,marketing',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('superadmin.users.index')
                        ->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser || !$authUser->hasRole('superadmin')) {
            abort(403, 'Unauthorized');
        }

        if ($user->id === Auth::id()) {
            return redirect()->route('superadmin.users.index')
                            ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('superadmin.users.index')
                        ->with('success', 'User berhasil dihapus.');
    }
}
