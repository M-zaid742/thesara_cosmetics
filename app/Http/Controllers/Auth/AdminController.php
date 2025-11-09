<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Auth;

class AdminController extends Controller {
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->is_admin) abort(403);
            return $next($request);
        });
    }

    public function dashboard() {
        $users = User::count();
        $products = Product::count();
        $orders = Order::count();
        return view('admin.dashboard', compact('users', 'products', 'orders'));
    }

    public function manageProducts() {
        $products = Product::paginate(10);
        return view('admin.products', compact('products'));
    }

    public function addProduct(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'brand' => 'required',
            'image_url' => 'nullable|url',
        ]);
        Product::create($request->all());
        return redirect()->back()->with('success', 'Product added.');
    }

    // Update a product
    public function updateProduct(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'brand' => 'required',
            'image_url' => 'nullable|url',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only([
            'name','description','price','stock','category','brand','image_url'
        ]));

        return redirect()->back()->with('success', 'Product updated.');
    }

    // Delete a product
    public function deleteProduct($id) {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted.');
    }

    // Manage users list
    public function manageUsers() {
        $users = User::paginate(15);
        return view('admin.users', compact('users'));
    }

    // Show edit user form
    public function editUser($id) {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    // Update a user
    public function updateUser(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}",
            'is_admin' => 'sometimes|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('is_admin')) {
            $user->is_admin = (bool)$request->is_admin;
        }
        $user->save();

        return redirect()->back()->with('success', 'User updated.');
    }

    // Delete a user (prevent self-delete)
    public function deleteUser($id) {
        if (Auth::id() == $id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted.');
    }

    // Manage orders
    public function manageOrders() {
        // eager load relations if present
        $orders = Order::with(['user'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    // View single order
    public function viewOrder($id) {
        $order = Order::with(['user'])->findOrFail($id);
        return view('admin.order', compact('order'));
    }

    // Update order status
    public function updateOrderStatus(Request $request, $id) {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated.');
    }
}