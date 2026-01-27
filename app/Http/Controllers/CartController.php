<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $carts = Auth::user()->carts()->with('product')->get();
        } else {
            $carts = collect(session('cart', []))->map(function ($item) {
                $product = \App\Models\Product::find($item['product_id']);
                return (object) [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $product?->price ?? $item['price'] ?? 0,
                ];
            });
        }

        $total = $carts->sum(fn($item) => $item->quantity * ($item->product->price ?? $item->price));

        // YEHI LINE CHANGE KI HAI — AB PERFECT HAI
        return view('shop.index', compact('carts', 'total'));
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout');
        }
        // baaki logic
    }
}