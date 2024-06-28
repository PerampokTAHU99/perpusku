<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('typeOfRole', 'admin');
        })->get();

        return view('admin', compact('users'));
    }

    public function showAnggota()
    {
        $anggotaRole = UserRole::where('typeOfRole', 'anggota')->first();
        $users = User::whereHas('role', function ($query) {
            $query->where('typeOfRole', 'anggota');
        })->get();

        return view('anggota', compact('users', 'anggotaRole'));
    }

    public function store(Request $request)
    {
        if ($request->has('username') && $request->has('email')) {
            // Store Admin
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
        } else {
            // Store Anggota
            $request->validate([
                'name' => 'required|string|max:255',
                'kelas' => 'required|integer',
                'jenis_kelamin' => 'required|string',
                'id_role' => 'required|integer',
            ]);

            User::create([
                'name' => $request->name,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_role' => $request->id_role,
                // Provide dummy values for email, username, and password if they are required in your model
                'email' => Str::random(10) . '@example.com',
                'username' => Str::random(10),
                'password' => Hash::make('password'), // Or any dummy password
            ]);

            return redirect()->route('anggota.index')->with('success', 'Anggota created successfully.');
        }
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

        if ($user->role->typeOfRole == 'admin') {
            // Update Admin
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
        } else {
            // Update Anggota
            $request->validate([
                'name' => 'required|string|max:255',
                'kelas' => 'required|integer',
                'jenis_kelamin' => 'required|string',
            ]);

            $user->update([
                'name' => $request->name,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            return redirect()->route('admin.index')->with('success', 'Anggota updated successfully.');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }
}
