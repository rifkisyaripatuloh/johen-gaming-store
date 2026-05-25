<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('checkout.index', compact('product'));
    }

    public function process(Request $request)
    {
        $request->validate([

            'product_id' => 'required',

            'customer_name' => 'required',

            'customer_phone' => 'required',

        ]);

        $product = Product::findOrFail($request->product_id);

        $invoice = 'INV-' . strtoupper(Str::random(10));

        $order = Order::create([

            'user_id' => auth()->id(),

            'invoice' => $invoice,

            'total_price' => $product->price,

            'final_price' => $product->price,

            'customer_name' => $request->customer_name,

            'customer_phone' => $request->customer_phone,

            'game_user_id' => $request->game_user_id,

            'server_id' => $request->server_id,

            'status' => 'pending',

        ]);

        Payment::create([

            'order_id' => $order->id,

            'payment_method' => $request->payment_method,

            'amount' => $product->price,

            'status' => 'pending',

        ]);

        return redirect('/orders')
            ->with('success', 'Checkout success');
    }
}