<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        $validatedData['password'] = bcrypt($validatedData['password']);

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
        $rules = [
            "name" => "required|max:255",
            "username" => "required",
            "email" => "required|email",
            "role" => "required",
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        }

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8';
        }

        $validatedData = $request->validate($rules);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect('/dashboard/user')->with('success', 'User has been updated!');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/user')->with('success', 'User has been deleted!');
    }
}
