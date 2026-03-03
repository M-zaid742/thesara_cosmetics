<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Review;

class ProductController extends Controller
{
    /**
     * Display all products with optional search and category filter
     */
    public function index(Request $request)
    {
        $products = Product::query();

        // Optional search
        if ($request->search) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        // Optional category filter
        if ($request->category) {
            $products->where('category', $request->category);
        }

        $products = $products->paginate(10);

        return view('products.index', compact('products'));
    }
public function buyNow(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'integer|min:1',
    ]);

    $product  = Product::findOrFail($request->product_id);
    $quantity = $request->quantity ?? 1;

    // Store buy now item in session (separate from cart)
    session([
        'buy_now' => [
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $product->price,
            'name'       => $product->name,
            'image'      => $product->image_url,
            'brand'      => $product->brand,
        ]
    ]);

    // Redirect to checkout
    return redirect()->route('checkout');
}
    /**
     * Display a single product by ID (Product Detail Page)
     */
    public function show($id)
    {
        $product = Product::with(['images', 'reviews.user'])->findOrFail($id);
        return view('products.product_detail_page', compact('product'));
    }

    /**
     * Add product to user's cart
     */
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

    /**
     * Add product to user's wishlist
     */
    public function addToWishlist(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        Wishlist::firstOrCreate([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Added to wishlist.');
    }

    /**
     * Display shop page with featured products
     */
    public function shop()
    {
        $featuredProducts = Product::where('is_featured', true)->get();
        return view('shop.products_page', compact('featuredProducts'));
    }

    /**
     * Category filter page
     */
    public function category($category)
    {
        $products = Product::where('category', $category)->get();
        return view('products.category', compact('products', 'category'));
    }
}