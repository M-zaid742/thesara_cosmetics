<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ===============================
        // TOTAL COUNTS
        // ===============================
        $totalOrders       = Order::count();
        $totalSales        = Order::where('status', 'completed')->count();
        $totalRevenue      = Order::where('status', 'completed')->sum('total');
        $totalUsers        = User::count();
        $totalProducts     = Product::count();
        $messagesCount     = Contact::count();
        $inventoryCount    = Product::count(); // Total products
        $mentionsCount     = Contact::count(); // Mentions table
        $downloadsCount    = 0; // No Download model, placeholder
        $directMessagesCount = 0; // No Message model, placeholder

        // ===============================
        // GOAL COMPLETION
        // ===============================
        $cartCount      = Order::where('status', 'cart')->count();
        $completedCount = Order::where('status', 'completed')->count();
        $pendingCount   = Order::where('status', 'pending')->count();

        $cartPercent      = $totalOrders > 0 ? ($cartCount / $totalOrders) * 100 : 0;
        $completedPercent = $totalOrders > 0 ? ($completedCount / $totalOrders) * 100 : 0;
        $pendingPercent   = $totalOrders > 0 ? ($pendingCount / $totalOrders) * 100 : 0;

        // ===============================
        // MONTHLY SALES (Last 12 Months)
        // ===============================
        $monthlySales = Order::select(
                DB::raw('DATE_FORMAT(created_at, "%b %Y") as month'),
                DB::raw('SUM(total) as total')
            )
            ->where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subMonths(11))
            ->groupBy('month')
            ->orderBy(DB::raw('MIN(created_at)'))
            ->pluck('total', 'month');

        // ===============================
        // CURRENT MONTH REPORT
        // ===============================
        $currentMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        $lastMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total');

        $totalCost   = 0;
        $totalProfit = $currentMonthRevenue - $totalCost;

        $growthPercentage = $lastMonthRevenue > 0
            ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;

        $GoalCompletions = $completedCount;

        // ===============================
        // LATEST DATA
        // ===============================
        $latestOrders   = Order::with('items')->latest()->limit(5)->get();
        $latestUsers    = User::latest()->take(8)->get();
        $latestProducts = Product::latest()->take(5)->get();
        $latestMessages = Contact::latest()->take(5)->get();

        // ===============================
        // VISITORS REPORT (Safe Version)
        // ===============================
        $visitsCount = $totalOrders;

        $referralPercent = $totalOrders > 0
            ? round(($completedCount / $totalOrders) * 100)
            : 0;

        $organicPercent = $totalOrders > 0
            ? round(($pendingCount / $totalOrders) * 100)
            : 0;

        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $last7Days[] = Order::whereDate(
                'created_at',
                now()->subDays($i)
            )->count();
        }

        // ===============================
        // RETURN VIEW
        // ===============================
        return view('admin.dashboard', compact(
            'totalOrders',
            'totalSales',
            'totalRevenue',
            'totalUsers',
            'totalProducts',
            'messagesCount',
            'monthlySales',
            'latestOrders',
            'latestUsers',
            'latestProducts',
            'latestMessages',
            'cartPercent',
            'completedPercent',
            'pendingPercent',
            'cartCount',
            'completedCount',
            'pendingCount',
            'currentMonthRevenue',
            'totalCost',
            'totalProfit',
            'growthPercentage',
            'GoalCompletions',
            'visitsCount',
            'referralPercent',
            'organicPercent',
            'last7Days',
            'inventoryCount',
            'mentionsCount',
            'downloadsCount',
            'directMessagesCount'
        ));
    }
}
