<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalSales = Order::where('status', 'completed')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $messagesCount = Contact::count();

        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $latestOrders = Order::latest()->limit(5)->get();
        $latestUsers = User::latest()->limit(5)->get();
        $latestProducts = Product::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'totalSales', 'totalRevenue', 'totalUsers', 
            'totalProducts', 'messagesCount', 'monthlySales',
            'latestOrders', 'latestUsers', 'latestProducts'
        ));
    }
}
