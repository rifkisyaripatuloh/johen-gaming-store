<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // LIST ORDERS
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // DETAIL ORDER
    public function show(string $id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    // OPTIONAL (kalau nanti mau update status)
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Order updated');
    }

    public function destroy(string $id)
    {
        Order::findOrFail($id)->delete();

        return back()->with('success', 'Order deleted');
    }
}