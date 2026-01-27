<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Remove the constructor completely OR use this:
    public function __construct()
    {
        // Only protect specific methods
        $this->middleware('auth')->except(['showTrackForm', 'trackSearch']);
    }

    // This page is for logged-in users only
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    // These two are PUBLIC - NO LOGIN
    public function showTrackForm()
    {
        return view('order.track');
    }

    public function trackSearch(Request $request)
    {
        $request->validate(['order_id' => 'required|numeric']);

        $order = Order::with('orderItems.product')->find($request->order_id);

        if (!$order) {
            return back()->with('error', 'Order not found!');
        }

        return view('order.track-result', compact('order'));
    }
}