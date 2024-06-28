<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $emailOrUsername = $request->post('email');
        $password = $request->post('password');

        $userData = User::where('email', $emailOrUsername)->orWhere('username', $emailOrUsername)->first();

        if (!$userData) {
            return redirect()->route('xyz')->with(['status' => 'ERROR', 'message' => 'Akun tidak ditemukan']);
        }

        if (!Hash::check($password, $userData->password)) {
            return redirect()->route('auth.login')->with(['status' => 'ERROR', 'message' => 'Password salah']);
        }

        $request->session()->put('userData', $userData->toArray());
        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('userData');
        return redirect()->route('auth.login');
    }
}
