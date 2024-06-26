<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('typeOfRole', 'admin');
        })->get();

        return view('admin', compact('users'));
    }

    public function create()
    {
        $roles = UserRole::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'jenis_kelamin' => 'required',
        ]);

        $roleAdmin = UserRole::where('typeOfRole', 'admin')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_role' => $roleAdmin->id_role,
        ]);

        return redirect()->route('users.index')->with('success', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = UserRole::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id_user.',id_user',
            'username' => 'required|unique:users,username,'.$user->id_user.',id_user',
            'password' => 'nullable|min:6',
            'jenis_kelamin' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('users.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Admin deleted successfully.');
    }
};
