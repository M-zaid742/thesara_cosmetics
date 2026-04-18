<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        if (!Auth::check()) {
            return back()->with('error', 'Please login to add items to your wishlist.');
        }

        // Prevent duplicates
        Wishlist::firstOrCreate([
            'user_id'    => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Item added to wishlist!');
    }
}
