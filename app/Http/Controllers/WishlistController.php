<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store(Request $request)
{
    // Your logic to add the product to the wishlist goes here
    // For example:
    // Wishlist::create(['product_id' => $request->product_id, 'user_id' => auth()->id()]);

    return back()->with('success', 'Item added to wishlist!');
}
    //
}
