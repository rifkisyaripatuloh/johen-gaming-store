@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0B0B0F] text-white relative overflow-hidden">

    <!-- BACKGROUND GLOW -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/10 blur-[180px] rounded-full animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[180px] rounded-full animate-pulse"></div>

    <div class="relative max-w-7xl mx-auto px-4 py-14">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-12">

            <div>

                <span class="px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-semibold">
                    MY ORDERS
                </span>

                <h1 class="mt-5 text-4xl md:text-5xl font-black leading-tight">
                    Purchase
                    <span class="text-orange-500">
                        History
                    </span>
                </h1>

                <p class="text-gray-400 mt-3 max-w-xl">
                    Lihat status transaksi, detail pembayaran, dan riwayat pembelian game kamu.
                </p>

            </div>

            <div class="bg-[#121212] border border-white/5 rounded-3xl px-6 py-5">

                <p class="text-gray-400 text-sm">
                    Total Orders
                </p>

                <h2 class="text-4xl font-black text-orange-500 mt-1">
                    {{ $orders->total() }}
                </h2>

            </div>

        </div>

        @forelse($orders as $order)

        <div
            class="group bg-[#121212]/90 backdrop-blur-xl border border-white/5 hover:border-orange-500/30 rounded-[32px] p-6 mb-7 transition duration-300 hover:-translate-y-1 hover:shadow-[0_0_50px_rgba(249,115,22,0.08)]">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <!-- LEFT -->
                <div class="flex gap-5">

                    <!-- ICON -->
                    <div class="w-16 h-16 rounded-2xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-3xl shrink-0">
                        🎮
                    </div>

                    <!-- INFO -->
                    <div>

                        <div class="flex flex-wrap items-center gap-3">

                            <h2 class="text-2xl font-black">
                                {{ $order->invoice }}
                            </h2>

                            {{-- STATUS --}}
                            @if($order->status == 'pending')

                                <span class="px-4 py-1 rounded-full bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 text-sm font-semibold">
                                    Pending
                                </span>

                            @elseif($order->status == 'paid')

                                <span class="px-4 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 text-sm font-semibold">
                                    Paid
                                </span>

                            @elseif($order->status == 'failed')

                                <span class="px-4 py-1 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 text-sm font-semibold">
                                    Failed
                                </span>

                            @else

                                <span class="px-4 py-1 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 text-sm font-semibold">
                                    {{ ucfirst($order->status) }}
                                </span>

                            @endif

                        </div>

                        <div class="mt-4 space-y-2">

                            <div class="flex items-center gap-2 text-gray-400">

                                <span>📅</span>

                                <span>
                                    {{ $order->created_at->format('d M Y - H:i') }}
                                </span>

                            </div>

                            <div class="flex items-center gap-2 text-gray-400">

                                <span>💳</span>

                                <span>
                                    {{ $order->payment->payment_method ?? 'No Payment Method' }}
                                </span>

                            </div>

                            <div class="flex items-center gap-2 text-gray-400">

                                <span>📱</span>

                                <span>
                                    {{ $order->customer_phone ?? '-' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="flex flex-col items-start lg:items-end gap-5">

                    <div>

                        <p class="text-gray-400 text-sm mb-1">
                            Total Payment
                        </p>

                        <h2 class="text-3xl font-black text-orange-500">
                            Rp {{ number_format($order->final_price) }}
                        </h2>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        {{-- DETAIL --}}
                        <a
                            href="{{ route('checkout.view', $order->id) }}"
                            class="px-6 py-3 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/10 transition">

                            Detail Order

                        </a>

                        {{-- PAYMENT --}}
                        @if($order->status == 'pending')

                        <a
                            href="{{ route('payment.show', $order->id) }}"
                            class="px-6 py-3 rounded-2xl bg-orange-500 hover:bg-orange-400 transition font-bold">

                            ⚡ Pay Now

                        </a>

                        @endif

                    </div>

                </div>

            </div>

            <!-- ITEMS -->
            <div class="mt-8 border-t border-white/5 pt-6">

                <h3 class="text-lg font-bold mb-5">
                    Purchased Items
                </h3>

                <div class="space-y-4">

                    @foreach($order->items as $item)

                    <div class="flex items-center justify-between bg-black/20 border border-white/5 rounded-2xl p-4">

                        <div class="flex items-center gap-4">

                            <img
                                src="{{ asset('storage/'.$item->product->thumbnail) }}"
                                class="w-16 h-16 rounded-2xl object-cover">

                            <div>

                                <h4 class="font-bold text-lg">
                                    {{ $item->product->name }}
                                </h4>

                                <p class="text-gray-400 text-sm">
                                    Qty : {{ $item->quantity }}
                                </p>

                            </div>

                        </div>

                        <div class="text-right">

                            <p class="text-orange-500 font-black text-lg">
                                Rp {{ number_format($item->subtotal) }}
                            </p>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

        @empty

        <!-- EMPTY -->
        <div class="bg-[#121212] border border-white/5 rounded-[40px] p-16 text-center">

            <div class="text-7xl mb-6">
                🛒
            </div>

            <h2 class="text-4xl font-black mb-4">
                No Orders Yet
            </h2>

            <p class="text-gray-400 max-w-md mx-auto leading-relaxed">
                Kamu belum memiliki riwayat pembelian.
                Mulai top up atau beli akun game favoritmu sekarang.
            </p>

            <a
                href="{{ route('products.index') }}"
                class="inline-block mt-8 px-8 py-4 rounded-2xl bg-orange-500 hover:bg-orange-400 transition font-bold">

                Browse Products

            </a>

        </div>

        @endforelse

        <!-- PAGINATION -->
        @if($orders->hasPages())

        <div class="mt-12 flex justify-center">

            <div class="bg-[#121212] border border-white/5 rounded-2xl px-4 py-3">
                {{ $orders->links() }}
            </div>

        </div>

        @endif

    </div>

</div>

@endsection