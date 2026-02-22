<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Profile;

class ProfileController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user()->load(['profile', 'orders.orderItems.product']);
        return view('profile.show', compact('user'));
    }

    public function edit() {
        $profile = Auth::user()->profile ?? new Profile();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request) {
        $request->validate([
            'skin_type' => 'required',
            'concerns' => 'required',
            'age' => 'required|integer',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('user_profiles', 'public');
            $user->profile_image = $path;
            $user->save();
        }

        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);
        $profile->fill($request->only(['skin_type', 'concerns', 'age']))->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}