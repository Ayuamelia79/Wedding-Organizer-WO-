<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengantinAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.pengantin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard-pengantin');
        }

        return back()->withErrors([
            'login' => 'Email atau password salah!'
        ]);
    }

    public function dashboard()
    {
        return view('pengantin.dashboard');
    }
}
