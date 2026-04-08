<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Dashboard | User';
        $users = User::all();
        return view('dashboard.user.index', compact('title', 'users'));
    }

    public function create()
    {
        $title = 'User | Create';
        return view('dashboard.user.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'slug' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/dashboard/user')->with('success', 'New user has been added!');
    }

    public function edit(User $user)
    {
        $title = 'User | Edit';
        return view('dashboard.user.edit', compact('title', 'user'));
    }

    public function update(Request $request, User $user)
    {
        // 1. Aturan validasi dasar (sesuai gambar)
        $rules = [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:5',
            'role' => 'required'
        ];

        // 2. Pengecekan perubahan data unik (sesuai gambar)
        if (request('slug') != $user->slug) {
            $rules['slug'] = 'unique:users|required';
        }
        
        if (request('email') != $user->email) {
            $rules['email'] = 'required|email|unique:users|email:dns';
        }
        
        if (request('username') != $user->username) {
            $rules['username'] = 'required|string|min:3|max:255|unique:users';
        }

        $validatedData = $request->validate($rules);

        // [TAMBAHAN KEAMANAN] - Hash password sebelum di update agar bisa digunakan untuk login
        $validatedData['password'] = Hash::make($validatedData['password']);

        // 3. Update berdasarkan slug (sesuai gambar)
        User::where('slug', $user->slug)->update($validatedData);

        // 4. Redirect dengan pesan (sesuai gambar)
        return redirect('/dashboard/user')->with('success', 'Data berhasil diubah!!');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/user')->with('success', 'User has been deleted!');
    }
}