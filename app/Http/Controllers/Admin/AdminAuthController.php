<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('admin.adminlogin'); // make sure this view exists
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
    $request->session()->regenerate();
    return redirect()->intended(route('admin.dashboard'));
}


        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // Optional: Admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard'); // create this view
    }
}
