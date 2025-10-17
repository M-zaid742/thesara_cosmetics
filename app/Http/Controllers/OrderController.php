<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function track($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        if ($order->user_id != Auth::user()->id) {
            abort(403);
        }
        return view('orders.track', compact('order'));
    }
}