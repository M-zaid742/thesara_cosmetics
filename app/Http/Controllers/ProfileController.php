<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Profile;

class ProfileController extends Controller {
    public function edit() {
        $profile = Auth::user()->profile ?? new Profile();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request) {
        $request->validate([
            'skin_type' => 'required',
            'concerns' => 'required',
            'age' => 'required|integer',
        ]);

        $user = Auth::user();
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);
        $profile->fill($request->all())->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated.');
    }
}