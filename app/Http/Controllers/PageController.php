<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        $categoryRows = Product::query()
            ->selectRaw('MIN(id) as id, category, COUNT(*) as product_count')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        $productsById = Product::query()
            ->with(['images' => function ($query) {
                $query->select('id', 'product_id', 'image_path')->orderBy('id');
            }])
            ->whereIn('id', $categoryRows->pluck('id'))
            ->get()
            ->keyBy('id');

        $categories = $categoryRows->map(function ($row) use ($productsById) {
            $product = $productsById->get($row->id);

            $imagePath = null;
            if ($product) {
                $imagePath = $product->image_url ?: ($product->images->first()?->image_path);
            }

            return [
                'name' => $row->category,
                'count' => (int) $row->product_count,
                'image_path' => $imagePath,
            ];
        });

        return view('welcome', compact('categories'));
    }

    public function faq()
    {
        $faqs = [
            [
                'question' => 'Are your products cruelty-free?',
                'answer'   => 'Yes, all Thesara Cosmetics products are 100% cruelty-free.'
            ],
            [
                'question' => 'Do you offer international shipping?',
                'answer'   => 'Yes! We ship to most countries with fast delivery options.'
            ],
            [
                'question' => 'Are your products suitable for sensitive skin?',
                'answer'   => 'Our products are dermatologically tested and safe for most skin types.'
            ],
            [
                'question' => 'How can I track my order?',
                'answer'   => 'You\'ll receive a tracking link once your order is shipped.'
            ]
        ];

        return view('faq', compact('faqs'));
    }

    public function checkout()
    {
        // Must be logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                             ->with('error', 'Please login to checkout.');
        }

        $isBuyNow = false;

        // Check if coming from Buy Now
        if (session('buy_now')) {
            $buyNowItem = session('buy_now');
            $product    = Product::find($buyNowItem['product_id']);

            if (!$product) {
                session()->forget('buy_now');
                return redirect()->route('shop')
                                 ->with('error', 'Product not found.');
            }

            $items = collect([(object)[
                'product'  => $product,
                'quantity' => $buyNowItem['quantity'],
                'price'    => $buyNowItem['price'],
            ]]);

            $isBuyNow = true;

        } else {
            // Regular cart checkout
            $items = Auth::user()->carts()->with('product')->get();
        }

        // Redirect if nothing to checkout
        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                             ->with('error', 'Your cart is empty.');
        }

        $subtotal = $items->sum(fn($item) => $item->quantity * $item->product->price);
        $shipping = $subtotal >= 3000 ? 0 : 500;
        $total    = $subtotal + $shipping;

        return view('checkout', compact(
            'items', 'subtotal', 'shipping', 'total', 'isBuyNow'
        ));
    }
}