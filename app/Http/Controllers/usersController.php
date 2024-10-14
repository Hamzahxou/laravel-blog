<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class usersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->q) {
            $users = User::where('username', 'LIKE', '%' . $request->q . '%')->orWhere('name', 'LIKE', '%' . $request->q . '%')->paginate(1);
        } else {
            $users = User::paginate(10);
        }
        return view('admin.users', compact('users'));
    }
    public function create()
    {

        $get_all_username = User::get('username')->toArray();
        return view('admin.tambah_user', compact('get_all_username'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);
        if ($request->has('avatar')) {
            $request->validate([
                'avatar' => ['required', 'mimes:png,jpg,jpeg'],
            ]);
            $path = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'avatar' => $path ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);

        return redirect()->route('admin_users.index')->with('success', 'User berhasil dibuat.');
    }
    public function show() {}
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (isset($request->password)) {
            $request->validate([
                'password' => 'required|string|min:6',
            ]);
        }

        if ($request->has('avatar')) {
            $request->validate([
                'avatar' => ['required', 'mimes:png,jpg,jpeg'],
            ]);
            if ($request->old_avatar != null) {
                if (file_exists(public_path('storage/' . $request->old_avatar))) {
                    unlink(public_path('storage/' . $request->old_avatar));
                }
            }
            $path = $request->file('avatar')->store('avatars', 'public');
        }
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'password' => $request->password ?? $user->password,
            'avatar' => $path ?? $user->avatar,
        ]);
        return redirect()->route('admin_users.index')->with('success', 'User berhasil diubah.');
    }
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin_users.index')->with('success', 'User berhasil dihapus.');
    }
}
