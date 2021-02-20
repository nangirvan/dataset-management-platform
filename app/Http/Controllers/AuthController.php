<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login()
    {
        return 0;
    }

    public function logout()
    {
        return 0;
    }
}
