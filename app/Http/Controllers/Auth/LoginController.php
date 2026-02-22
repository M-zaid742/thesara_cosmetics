<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // user login view
    }

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Redirect straight to main homepage after login
        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'Invalid login credentials.',
    ]);
}

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login'); // go to user login
    }
    
}
