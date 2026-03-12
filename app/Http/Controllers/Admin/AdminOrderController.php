<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; 
class AdminOrderController extends Controller
{
    //public function index()
public function index()
{
$orders = Order::with(['items','user'])
->latest()
->paginate(20);

return view('admin.orders.index',compact('orders'));
}

public function show($id)
{
$order = Order::with(['items.product','user'])->findOrFail($id);

return view('admin.orders.show',compact('order'));
}

public function invoice($id)
{
$order = Order::with(['items.product','user'])->findOrFail($id);

return view('admin.orders.invoice',compact('order'));
}

public function status(Request $request,$id)
{
$order = Order::findOrFail($id);

$order->status = $request->status;

$order->save();

return back();
}
public function pending()
{
$orders = Order::where('status','pending')->get();
return view('admin.orders.index',compact('orders'));
}

public function completed()
{
$orders = Order::where('status','completed')->get();
return view('admin.orders.index',compact('orders'));
}

public function cancelled()
{
$orders = Order::where('status','cancelled')->get();
return view('admin.orders.index',compact('orders'));
}
}
