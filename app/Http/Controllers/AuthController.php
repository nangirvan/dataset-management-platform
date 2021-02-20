<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return (auth()->check()) ? redirect()->route('home') : view('auth.login');
    }

    public function login(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah',
        ]);
    }

    public function logout(Request $request)
    {
        if (auth()->check()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
     
        return redirect()->route('auth.login.view');
    }
}
