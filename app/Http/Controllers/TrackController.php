<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TrackController extends Controller
{
    public function showForm()
    {
        return view('orders.track');
    }

   public function search(Request $request)
{
    $request->validate(['order_id' => 'required|numeric']);
    
    $order = Order::with('orderItems.product')->find($request->order_id);

    if (!$order) {
        return redirect()->route('track.order')
                         ->with('error', 'Order not found! Please check your Order ID.');
    }

    return view('orders.track-result', compact('order'));
}}
