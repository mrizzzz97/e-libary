<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // ================= LOGIN PAGE =================
    public function login()
    {
        return view('auth.login');
    }

    // ================= REGISTER PAGE =================
    public function registration()
    {
        return view('auth.registration');
    }

    // ================= REGISTER PROCESS =================
    public function store(Request $request)
    {
        // Validasi disesuaikan dengan gambar yang diberikan
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'role' => 'required'
        ]);

        // HASH PASSWORD
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi akun berhasil! Silahkan login.');
    }

    // ================= LOGIN PROCESS =================
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard');
            }

            return redirect('/');
        }

        return back()->with('error', 'Login Gagal!');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}