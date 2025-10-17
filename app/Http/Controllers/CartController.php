<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;

class CartController extends Controller {
    public function index() {
        $carts = Auth::user()->carts()->with('product')->get();
        $total = $carts->sum(fn($item) => $item->quantity * $item->product->price);
        return view('cart.index', compact('carts', 'total'));
    }

    public function checkout(Request $request) {
        $request->validate(['address' => 'required', 'payment_method' => 'required']);

        $carts = Auth::user()->carts;
        if ($carts->isEmpty()) return redirect()->back()->with('error', 'Cart empty.');

        $total = $carts->sum(fn($item) => $item->quantity * $item->product->price);
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total' => $total,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'tracking_id' => 'TRK' . rand(1000,9999), // Fake tracking
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
            $cart->product->decrement('stock', $cart->quantity);
            $cart->delete();
        }

        // Send notification (FR-12)
        Notification::create([
            'user_id' => Auth::user()->id,
            'type' => 'order_update',
            'message' => 'Order #' . $order->id . ' placed.',
        ]);

        return redirect()->route('orders.track', $order->id)->with('success', 'Order placed.');
    }
}