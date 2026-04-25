<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{

    // Logged-in user's order history
    public function index()
    {
        $orders = auth()->user()->orders()->with('orderItems.product')->latest()->paginate(10);
        return view('orders.view_order', compact('orders')); // fixed view name
    }

    // Place order (from cart OR buy now)
    public function store(Request $request)
    {
        $rules = [
            'name'           => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'city'           => 'required|string|max:100',
            'payment_method' => 'required|in:cod,card',
        ];

        if ($request->payment_method === 'card') {
            $rules['card_number'] = 'required|string|min:16';
            $rules['card_expiry'] = 'required|string';
            $rules['card_cvv']    = 'required|string|min:3|max:4';
        }

        $request->validate($rules);

        $isBuyNow = $request->is_buy_now == 1;

        if ($isBuyNow) {
            $buyNowItem = session('buy_now');

            if (!$buyNowItem) {
                return redirect()->route('shop')
                                 ->with('error', 'Buy Now session expired. Please try again.');
            }

            $product = Product::findOrFail($buyNowItem['product_id']);

            $items = collect([(object)[
                'product'  => $product,
                'quantity' => $buyNowItem['quantity'],
                'price'    => $buyNowItem['price'],
            ]]);

        } else {
            $items = Auth::user()->carts()->with('product')->get();

            if ($items->isEmpty()) {
                return redirect()->route('cart.index')
                                 ->with('error', 'Your cart is empty.');
            }
        }

        $subtotal = $items->sum(fn($item) => $item->quantity * $item->product->price);
        $shipping = $subtotal >= 3000 ? 0 : 500;
        $total    = $subtotal + $shipping;

        $order = Order::create([
            'user_id'        => Auth::id(),
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'payment_method' => $request->payment_method,
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'total'          => $total,
            'status'         => 'pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product->id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        if ($isBuyNow) {
            session()->forget('buy_now');
        } else {
            Auth::user()->carts()->delete();
        }

        return redirect()->route('orders.confirmation', $order->id)
                         ->with('success', 'Order placed successfully!');
    }

    // Order confirmation page
    public function confirmation($id)
    {
        $order = Order::with('orderItems.product')
                      ->where('user_id', Auth::id())
                      ->findOrFail($id);

        return view('orders.confirmation', compact('order'));
    }

}