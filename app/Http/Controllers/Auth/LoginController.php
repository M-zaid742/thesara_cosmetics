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
         'name' => $request->name,
    'email' => $request->email,
    'password' => $request->password,
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard()->attempt($credentials)) {
        return redirect()->route('/');
    }

    return back()->withErrors(['email' => 'Invalid login details']);
}



    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login'); // go to user login
    }
    
}
