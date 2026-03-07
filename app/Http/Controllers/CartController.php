<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $isGuest = !Auth::check();

        if (Auth::check()) {
            $carts = Auth::user()->carts()->with('product')->get();
        } else {
            $carts = collect(session('cart', []))->map(function ($item, $key) {
                $product = Product::find($item['product_id']);
                return (object) [
                    'id'         => $key,
                    'product'    => $product,
                    'quantity'   => $item['quantity'],
                    'product_id' => $item['product_id'],
                ];
            })->filter(fn($item) => $item->product !== null);
        }

        $subtotal = $carts->sum(fn($item) => $item->quantity * $item->product->price);
        $shipping = $subtotal >= 3000 ? 0 : 500;
        $total    = $subtotal + $shipping;

        return view('shop.shopping_cart_page', compact(
            'carts', 'subtotal', 'shipping', 'total', 'isGuest'
        ));
    }

    // Add to cart
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'integer|min:1',
        ]);

        $quantity = $request->quantity ?? 1;

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
            } else {
                Cart::create([
                    'user_id'    => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity'   => $quantity,
                ]);
            }
        } else {
            $cart = session('cart', []);
            $key  = $request->product_id;

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += $quantity;
            } else {
                $cart[$key] = [
                    'product_id' => $request->product_id,
                    'quantity'   => $quantity,
                ];
            }

            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Update quantity
    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if (Auth::check()) {
            Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->update(['quantity' => $request->quantity]);
        } else {
            $cart = session('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $request->quantity;
                session(['cart' => $cart]);
            }
        }

        return redirect()->back()->with('success', '');
    }

    // Remove item
    public function destroy($id)
    {
        if (Auth::check()) {
            Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            $cart = session('cart', []);
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', '');
    }
}