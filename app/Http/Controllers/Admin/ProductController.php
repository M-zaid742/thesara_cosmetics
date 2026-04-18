<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * List all products.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show add product form.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name'        => $request->name,
            'subtitle'    => $request->subtitle,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'cost_price'  => $request->cost_price,
            'old_price'   => $request->old_price,
            'is_featured' => $request->has('is_featured'),
            'stock'       => $request->stock ?? 0,
            'category'    => $request->category,
            'badge'       => $request->badge,
            'brand'       => 'Thesara',
            'image_url'   => 'storage/' . $imagePath,
            'ingredients' => $request->ingredients,
        ]);

        return redirect()->route('admin.products.index')
                         ->with('product_success', 'Product added successfully!');
    }

    /**
     * Show edit product form.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = [
            'name'        => $request->name,
            'subtitle'    => $request->subtitle,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'cost_price'  => $request->cost_price,
            'old_price'   => $request->old_price,
            'is_featured' => $request->has('is_featured'),
            'stock'       => $request->stock ?? 0,
            'category'    => $request->category,
            'badge'       => $request->badge,
            'ingredients' => $request->ingredients,
        ];

        if ($request->hasFile('image')) {
            $imagePath       = $request->file('image')->store('products', 'public');
            $data['image_url'] = 'storage/' . $imagePath;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
                         ->with('product_success', 'Product updated successfully!');
    }

    /**
     * Delete product.
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('admin.products.index')
                         ->with('product_success', 'Product deleted successfully!');
    }
}
