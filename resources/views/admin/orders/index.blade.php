@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-black mb-6">Orders</h2>

<div class="bg-[#121212] rounded-3xl overflow-hidden border border-white/5">

    <table class="w-full">

        <thead class="bg-white/5 text-gray-300">
            <tr>
                <th class="p-4">Order ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
                <th class="text-right p-4">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($orders as $order)
            <tr class="border-t border-white/5 hover:bg-white/5">

                <td class="p-4">#{{ $order->id }}</td>

                <td>{{ $order->user->name ?? '-' }}</td>

                <td class="text-orange-400 font-bold">
                    Rp {{ number_format($order->final_price) }}
                </td>

                <td>
                    <span class="px-3 py-1 rounded-xl bg-green-500/20 text-green-400 text-sm">
                        Paid
                    </span>
                </td>

                <td class="text-right p-4">
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                       class="px-3 py-2 bg-blue-500/20 text-blue-400 rounded-lg">
                        Detail
                    </a>
                </td>

            </tr>
            @endforeach

        </tbody>

    </table>

</div>

@endsection