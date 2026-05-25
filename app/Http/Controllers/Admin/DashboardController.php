<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    $totalUsers = User::count();
    $totalProducts = Product::count();
    $totalOrders = Order::count();
    $totalRevenue = Order::sum('final_price');

    return view('admin.dashboard.index', compact(
        'totalUsers',
        'totalProducts',
        'totalOrders',
        'totalRevenue'
    ));
}
}