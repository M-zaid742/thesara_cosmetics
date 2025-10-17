<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();
        if ($request->search) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $products->where('category', $request->category);
        }
        $products = $products->paginate(10);

        return view('products.index', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity ?? 1,
        ]);

        return redirect()->back()->with('success', 'Added to cart.');
    }

    public function addToWishlist(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        Wishlist::firstOrCreate([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Added to wishlist.');
    }
}