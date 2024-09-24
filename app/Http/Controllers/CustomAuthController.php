<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login'); // Customize the login view
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')->withSuccess('Signed in');
        }
        return redirect()->route('login')->with('error', 'Invalid login credentials');
    }
}
