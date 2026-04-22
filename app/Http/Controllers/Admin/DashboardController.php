<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders   = Order::count();
        $totalProducts = Product::count();
        $totalUsers    = User::where('role', 'customer')->count();
        $revenue       = Order::where('status', '!=', 'cancelled')->sum('total');
        $recentOrders  = Order::with('user')->latest()->take(8)->get();
        $lowStock      = Product::where('stock', '<=', 5)->where('is_active', true)->count();
        $categories    = Category::withCount('products')->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'totalProducts', 'totalUsers',
            'revenue', 'recentOrders', 'lowStock', 'categories'
        ));
    }
}
