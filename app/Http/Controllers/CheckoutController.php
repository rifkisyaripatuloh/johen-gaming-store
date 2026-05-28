<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\ProductPackage;
use App\Mail\AccountDeliveryMail;
use App\Mail\TopupSuccessMail;
use App\Models\AccountDelivery;
use Illuminate\Support\Facades\Mail;
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
        'product_id'      => 'required',
        'customer_name'   => 'required',
        'customer_phone'  => 'required',
        'payment_method'  => 'required',
    ]);

    $product = Product::findOrFail(
        $request->product_id
    );

    $price = $product->price;
    $packageName = null;

    /*
    |--------------------------------------------------------------------------
    | TOPUP PACKAGE
    |--------------------------------------------------------------------------
    */

    if ($product->type == 'topup') {

        $package = ProductPackage::findOrFail(
            $request->package_id
        );

        $price = $package->price;
        $packageName = $package->name;
    }

    $invoice =
        'INV-' .
        strtoupper(Str::random(10));

    /*
    |--------------------------------------------------------------------------
    | CREATE ORDER
    |--------------------------------------------------------------------------
    */

    $order = Order::create([

        'user_id'        => auth()->id(),
        'invoice'        => $invoice,

        'total_price'    => $price,
        'final_price'    => $price,

        'customer_name'  => $request->customer_name,
        'customer_phone' => $request->customer_phone,

        'game_user_id'   => $request->game_user_id,
        'server_id'      => $request->server_id,

        'status'         => 'pending',
    ]);

    /*
    |--------------------------------------------------------------------------
    | ORDER ITEM
    |--------------------------------------------------------------------------
    */

    OrderItem::create([

        'order_id'   => $order->id,
        'product_id' => $product->id,

        'quantity'   => 1,

        'price'      => $price,
        'subtotal'   => $price,

        'package_name' => $packageName,
    ]);

    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    Payment::create([

        'order_id'       => $order->id,
        'payment_method' => $request->payment_method,
        'amount'         => $price,
        'status'         => 'pending',
    ]);

    return redirect()->route(
        'checkout.view',
        $order->id
    );
}
public function show(Order $order)
{
    return view(
        'payment.show',
        compact('order')
    );
}
 
public function checkoutView($order)
{
    $order = Order::with([
        'items.product',
        'payment'
    ])->findOrFail($order);

    
    return view('checkout.index', compact('order'));

}
public function confirmPayment(Order $order)
{
    // UPDATE PAYMENT
    $order->payment->update([

        'status'  => 'paid',
        'paid_at' => now()

    ]);

    // UPDATE ORDER
    $order->update([

        'status' => 'paid'

    ]);

    // LOOP ITEM
    foreach ($order->items as $item) {

        $product = $item->product;

        /*
        |--------------------------------------------------------------------------
        | SELL ACCOUNT
        |--------------------------------------------------------------------------
        */

      if ($product->type == 'sell_account') {

    $account = AccountDelivery::where('product_id', $product->id)
        ->where('is_sent', false)
        ->first();

   

    if ($account) {

        Mail::to(auth()->user()->email)
            ->send(new AccountDeliveryMail($order, $account));

        $account->update([
            'is_sent' => true
        ]);
    }
}

        /*
        |--------------------------------------------------------------------------
        | TOPUP
        |--------------------------------------------------------------------------
        */

        if ($product->type == 'topup') {

            Mail::to(auth()->user()->email)
                ->send(new TopupSuccessMail($order));
        }
    }

    return redirect()
        ->route('orders.index')
        ->with('success', 'Payment confirmed successfully');
}

public function paid(Order $order)
{
    $order->load([
        'items.product',
        'payment'
    ]);

    // UPDATE ORDER
    $order->update([
        'status' => 'paid'
    ]);

    // UPDATE PAYMENT
    if ($order->payment) {

        $order->payment->update([
            'status'  => 'paid',
            'paid_at' => now()
        ]);
    }

    foreach ($order->items as $item) {

        $product = $item->product;

        /*
        |--------------------------------------------------------------------------
        | TOPUP
        |--------------------------------------------------------------------------
        */

        if ($product->type == 'topup') {

            Mail::to(auth()->user()->email)
                ->send(new TopupSuccessMail($order));
        }

        /*
        |--------------------------------------------------------------------------
        | SELL ACCOUNT
        |--------------------------------------------------------------------------
        */

        if ($product->type == 'sell_account') {

            $account = AccountDelivery::where(
                'product_id',
                $product->id
            )
            ->where('is_sent', false)
            ->first();

            if (!$account) {

                return back()->with(
                    'error',
                    'Stock akun habis'
                );
            }

            // SEND EMAIL
            Mail::to(auth()->user()->email)
                ->send(
                    new AccountDeliveryMail(
                        $order,
                        $account
                    )
                );

            // UPDATE ACCOUNT
            $account->update([
                'is_sent' => true
            ]);
        }
    }

    return redirect()
        ->route('orders.index')
        ->with(
            'success',
            'Pembayaran berhasil dikonfirmasi'
        );
}
}
