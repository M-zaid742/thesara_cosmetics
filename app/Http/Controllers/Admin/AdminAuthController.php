<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.adminlogin'); // Make sure this view exists
    }

    // Handle login attempt
 public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
}


    // Admin dashboard (protected route)
    // public function dashboard()
    // {
    //     return view('admin.dashboard'); // Make sure this view exists
    // }

    // Optional: handle logout
   public function logout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:6|confirmed',
    ]);

    $admin = Auth::guard('admin')->user();

    // Check current password
    if (!\Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    // Update password
    $admin->password = $request->new_password; // auto-hash via Admin model
    $admin->save();

    return back()->with('success', 'Password updated successfully!');
}

 public function profile()
    {
        return view('admin.profile');
    }

    // Update profile
    public function updateProfile(Request $request)
{
    $admin = auth('admin')->user();

    // Update name & bio
    $admin->name = $request->name;
    $admin->bio = $request->bio;

    // Upload profile image if exists
    if($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('admin_profiles', 'public');
        $admin->profile_image = $path;
    }

    $admin->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}
}