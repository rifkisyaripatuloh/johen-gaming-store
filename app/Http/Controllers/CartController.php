<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        Cart::create([

            'user_id' => auth()->id(),

            'product_id' => $product->id,

            'quantity' => 1,

        ]);

        return back()->with('success', 'Product added to cart');
    }

    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();

        return back()->with('success', 'Cart removed');
    }
}