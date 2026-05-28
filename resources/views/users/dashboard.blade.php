@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0B0B0F] text-white overflow-hidden relative">

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/10 blur-[180px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[180px] rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4 py-10">

        <!-- HERO -->
        <div
            class="bg-gradient-to-r from-[#141414] to-[#1B1B1B]
                   border border-white/10
                   rounded-[40px]
                   p-8 md:p-12
                   overflow-hidden
                   relative">

            <div class="absolute right-0 top-0 w-96 h-96 bg-orange-500/10 blur-[120px] rounded-full"></div>

            <div class="relative z-10">

                <span class="px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-semibold">
                    JOHEN GAMING MEMBER
                </span>

                <h1 class="mt-6 text-4xl md:text-6xl font-black">
                    Welcome Back,
                    <span class="text-orange-500">
                        {{ auth()->user()->name }}
                    </span>
                </h1>

                <p class="mt-4 text-gray-400 max-w-2xl">
                    Kelola pembelian akun game, top up favorit,
                    dan pantau status transaksi Anda secara realtime.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">

                    <a href="{{ route('products.index') }}"
                       class="px-8 py-4 rounded-2xl bg-orange-500 hover:bg-orange-400 transition font-bold shadow-lg shadow-orange-500/20">

                        🎮 Shop Now

                    </a>

                    <a href="{{ route('orders.index') }}"
                       class="px-8 py-4 rounded-2xl border border-white/10 hover:border-orange-500 hover:bg-orange-500/10 transition">

                        📦 My Orders

                    </a>

                </div>

            </div>

        </div>

        <!-- STATS -->
        <div class="grid md:grid-cols-4 gap-6 mt-10">

            <div class="group bg-[#121212] border border-white/5 rounded-3xl p-6 hover:border-orange-500/30 transition hover:-translate-y-2">

                <div class="text-4xl mb-3">
                    📦
                </div>

                <p class="text-gray-400 text-sm">
                    Total Orders
                </p>

                <h2 class="text-4xl font-black mt-2 text-orange-500">
                    {{ $totalOrders }}
                </h2>

            </div>

            <div class="group bg-[#121212] border border-white/5 rounded-3xl p-6 hover:border-orange-500/30 transition hover:-translate-y-2">

                <div class="text-4xl mb-3">
                    ⚡
                </div>

                <p class="text-gray-400 text-sm">
                    Top Up Success
                </p>

                <h2 class="text-4xl font-black mt-2 text-green-400">
                {{ $totalSuccess }}
                </h2>

            </div>

            <div class="group bg-[#121212] border border-white/5 rounded-3xl p-6 hover:border-orange-500/30 transition hover:-translate-y-2">

                <div class="text-4xl mb-3">
                    👑
                </div>

                <p class="text-gray-400 text-sm">
                    Account Purchased
                </p>

                <h2 class="text-4xl font-black mt-2 text-purple-400">
                   0
                </h2>

            </div>

            <div class="group bg-[#121212] border border-white/5 rounded-3xl p-6 hover:border-orange-500/30 transition hover:-translate-y-2">

                <div class="text-4xl mb-3">
                    💎
                </div>

                <p class="text-gray-400 text-sm">
                    Success Orders
                </p>

             <h2 class="text-4xl font-black mt-2 text-blue-400">
    {{ $totalSuccess }}
</h2>

            </div>

        </div>

        <!-- QUICK MENU -->
        <div class="grid md:grid-cols-3 gap-6 mt-10">

            <a href="{{ route('products.index') }}"
               class="bg-[#121212] border border-white/5 rounded-3xl p-8 hover:border-orange-500/30 transition hover:-translate-y-2">

                <div class="text-5xl mb-4">
                    🎮
                </div>

                <h3 class="text-2xl font-black">
                    Top Up Games
                </h3>

                <p class="text-gray-400 mt-2">
                    Isi diamond, UC, Genesis Crystal dan lainnya.
                </p>

            </a>

            <a href="{{ route('cart.index') }}"
               class="bg-[#121212] border border-white/5 rounded-3xl p-8 hover:border-orange-500/30 transition hover:-translate-y-2">

                <div class="text-5xl mb-4">
                    🛒
                </div>

                <h3 class="text-2xl font-black">
                    My Cart
                </h3>

                <p class="text-gray-400 mt-2">
                    Lanjutkan checkout produk favoritmu.
                </p>

            </a>

            <a href="{{ route('orders.index') }}"
               class="bg-[#121212] border border-white/5 rounded-3xl p-8 hover:border-orange-500/30 transition hover:-translate-y-2">

                <div class="text-5xl mb-4">
                    📦
                </div>

                <h3 class="text-2xl font-black">
                    Transaction
                </h3>

                <p class="text-gray-400 mt-2">
                    Pantau semua status transaksi Anda.
                </p>

            </a>

        </div>

        <!-- RECENT ORDERS -->
        <div class="mt-12">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-3xl font-black">
                    Recent Orders
                </h2>

            </div>

            <div class="bg-[#121212] border border-white/5 rounded-3xl overflow-hidden">

                <table class="w-full">

                    <thead class="bg-black/30">

                        <tr>

                            <th class="text-left px-6 py-4">
                                Invoice
                            </th>

                            <th class="text-left px-6 py-4">
                                Total
                            </th>

                            <th class="text-left px-6 py-4">
                                Status
                            </th>

                            <th class="text-left px-6 py-4">
                                Date
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                        <tr class="border-t border-white/5 hover:bg-white/[0.02]">

                            <td class="px-6 py-4">
                                {{ $order->invoice }}
                            </td>

                            <td class="px-6 py-4 text-orange-400 font-bold">
                                Rp {{ number_format($order->final_price) }}
                            </td>

                            <td class="px-6 py-4">

                                @if($order->status == 'success')
                                    <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400 text-xs">
                                        SUCCESS
                                    </span>
                                @elseif($order->status == 'paid')
                                    <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs">
                                        PAID
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400 text-xs">
                                        PENDING
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4 text-gray-400">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4"
                                class="text-center py-12 text-gray-500">

                                No transactions yet

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection