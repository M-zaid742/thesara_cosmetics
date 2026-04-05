<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Review;

class ProductController extends Controller
{
    /**
     * Display all products (with search + category filter)
     */
    public function index(Request $request, ?string $category = null)
    {
        $products = Product::query();

        // Search
        if ($request->search) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        $selectedCategory = $category ?: $request->category;
        if ($selectedCategory) {
            $products->where('category', $selectedCategory);
        }

        $products = $products->latest()->paginate(10);

        return view('products.BROWSE_SCREEN', compact('products'));
    }

    /**
     * Featured products (for homepage)
     */
    public function featured()
    {
        $products = Product::where('is_featured', 1)->latest()->get();
        return view('products.featured', compact('products'));
    }

    /**
     * Product detail page
     */
    public function show($id)
    {
        $product = Product::with(['images', 'reviews.user'])->findOrFail($id);
        return view('products.product_detail_page', compact('product'));
    }

    /**
     * Add to cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity ?? 1,
        ]);

        return back()->with('success', 'Added to cart');
    }

    /**
     * Wishlist
     */
    public function addToWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Added to wishlist');
    }

    /**
     * Shop page (featured products)
     */
    public function shop()
    {
        $featuredProducts = Product::where('is_featured', 1)->latest()->get();
        return view('shop.products_page', compact('featuredProducts'));
    }

    /**
     * Category page
     */
    public function category($category)
    {
        $products = Product::where('category', $category)->latest()->get();
        return view('products.category', compact('products', 'category'));
    }

    /**
     * Admin - Show Add Product Form
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Admin - Store Product
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        // Upload image
        $imageName = time() . '.' . $request->image->extension();
        // $request->image->move(public_path('uploads/products'), $imageName);
        $imagePath = $request->file('image')->store('products', 'public');
        // Save product
        Product::create([
            'name' => $request->name,
            'subtitle' => $request->subtitle,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
            'old_price' => $request->old_price,
            'is_featured' => $request->has('is_featured'),
            'stock' => $request->stock,
            'category' => $request->category,
            'badge' => $request->badge,
            'image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Product Added Successfully');
    }

    /**
     * Buy Now
     */
    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        session([
            'buy_now' => [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'name' => $product->name,
                'image' => $product->image,
            ]
        ]);

        return redirect()->route('checkout');
    }
}