<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('posts');
        }
        return redirect('login')->with('message', 'Incorrect email or password');
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
    public function register_view()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // validate input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // input new user
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('login')->with('message', 'Registration was successful!');
    }
}
