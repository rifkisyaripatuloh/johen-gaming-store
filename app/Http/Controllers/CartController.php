<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $request->validate([
            'product_id' => 'required'
        ]);

        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => 1,
        ]);

        return back()->with('success', 'Product added to cart');
    }

    public function destroy($id)
    {
        Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return back()->with('success', 'Cart removed');
    }

     // ✅ CHECKOUT MULTI SELECTED
    public function checkoutSelected(Request $request)
    {
        $request->validate([
            'cart_ids' => 'required|array',
            'payment_method' => 'required',
        ]);

        $carts = Cart::with('product')
            ->whereIn('id', $request->cart_ids)
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'No items selected');
        }

        $total = 0;

       $order = Order::create([
    'user_id' => auth()->id(),
    'invoice' => 'INV-' . strtoupper(Str::random(10)),

    'customer_name' => auth()->user()->name,
    'customer_phone' => '-',

    'game_user_id' => null,
    'server_id' => null,

    'total_price' => 0,
    'final_price' => 0,
    'status' => 'pending',
]);

        foreach ($carts as $cart) {

            $subtotal = $cart->product->price * $cart->quantity;
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
                'subtotal' => $subtotal,
            ]);
        }

        $order->update([
            'total_price' => $total,
            'final_price' => $total,
        ]);

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount' => $total,
            'status' => 'pending',
        ]);

        Cart::whereIn('id', $request->cart_ids)->delete();

        return redirect()->route('checkout.view', $order->id);
    }
}