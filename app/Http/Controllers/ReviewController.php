<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Auth;

class ReviewController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required',
        ]);

        // Check if user purchased the product (business rule)
        if (!OrderItem::where('product_id', $request->product_id)->whereHas('order', fn($q) => $q->where('user_id', Auth::user()->id))->exists()) {
            return redirect()->back()->with('error', 'Must purchase to review.');
        }

        Review::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review submitted.');
    }
}