<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->latest()->get();

        $categories = Category::latest()->get();

        $products = Product::with('category')
            ->where('status', 'available')
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact(
            'banners',
            'categories',
            'products'
        ));
    }
}