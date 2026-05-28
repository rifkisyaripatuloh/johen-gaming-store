<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = Order::where(
            'user_id',
            $user->id
        )->latest()->get();

        $cartCount = Cart::where(
            'user_id',
            $user->id
        )->count();

        $totalOrders = Order::where(
            'user_id',
            $user->id
        )->count();

        $totalSuccess = Order::where(
            'user_id',
            $user->id
        )->where('status', 'success')
         ->count();

        $totalPending = Order::where(
            'user_id',
            $user->id
        )->where('status', 'pending')
         ->count();

        $totalSpent = Order::where(
            'user_id',
            $user->id
        )->where('status', 'success')
         ->sum('final_price');

        return view('users.dashboard', compact(
            'user',
            'orders',
            'cartCount',
            'totalOrders',
            'totalSuccess',
            'totalPending',
            'totalSpent'
        ));
    }
}