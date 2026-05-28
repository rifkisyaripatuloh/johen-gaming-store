@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0B0B0F] text-white relative overflow-hidden">

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/10 blur-[180px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[180px] rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4 py-12">

        <!-- HEADER -->
        <div class="mb-10">

            <span class="px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-semibold">
                SECURE CHECKOUT
            </span>

            <h1 class="mt-5 text-4xl md:text-5xl font-black">
                Complete Your
                <span class="text-orange-500">Purchase</span>
            </h1>

            <p class="text-gray-400 mt-3">
                Pastikan detail pembelian sudah benar sebelum melanjutkan pembayaran.
            </p>

        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div class="lg:col-span-2 space-y-6">

                <!-- PRODUCT LIST -->
                <div class="bg-[#121212] border border-white/5 rounded-3xl p-6">

                    <h2 class="text-2xl font-black mb-6">
                        Product Detail
                    </h2>

                    @foreach($order->items as $item)

                    <div class="flex flex-col md:flex-row gap-6 mb-6 border-b border-white/10 pb-6">

                        <img
                            src="{{ asset('storage/'.$item->product->thumbnail) }}"
                            class="w-full md:w-40 h-40 rounded-3xl object-cover">

                        <div class="flex-1">

                            <h3 class="text-2xl font-black">
                                {{ $item->product->name }}
                            </h3>

                            <p class="text-gray-400 mt-2">
                                Qty: {{ $item->quantity }}
                            </p>

                            <p class="text-orange-500 font-bold mt-3">
                                Rp {{ number_format($item->subtotal) }}
                            </p>

                        </div>

                    </div>

                    @endforeach

                </div>

                <!-- GAME INFO (SAFE CHECK) -->
                @php
                    $firstItem = $order->items->first();
                @endphp

                @if($firstItem && $firstItem->product->type == 'topup')

                <div class="bg-[#121212] border border-white/5 rounded-3xl p-6">

                    <h2 class="text-2xl font-black mb-6">
                        Game Information
                    </h2>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm text-gray-400">User ID</label>
                            <input type="text"
                                name="game_id"
                                class="w-full mt-2 px-4 py-4 rounded-2xl bg-black/30 border border-white/10 focus:border-orange-500 outline-none">
                        </div>

                        <div>
                            <label class="text-sm text-gray-400">Server ID</label>
                            <input type="text"
                                name="server_id"
                                class="w-full mt-2 px-4 py-4 rounded-2xl bg-black/30 border border-white/10 focus:border-orange-500 outline-none">
                        </div>

                    </div>

                </div>

                @endif

                <!-- PAYMENT -->
                <div class="bg-[#121212] border border-white/5 rounded-3xl p-6">

                    <h2 class="text-2xl font-black mb-6">
                        Payment Method
                    </h2>

                    <div class="grid md:grid-cols-2 gap-4">

                        <label class="cursor-pointer p-5 rounded-2xl border border-white/10 hover:border-orange-500">
                            <input type="radio" name="payment_method" value="bank" class="hidden">
                            <div class="font-bold">💳 Bank Transfer</div>
                        </label>

                        <label class="cursor-pointer p-5 rounded-2xl border border-white/10 hover:border-orange-500">
                            <input type="radio" name="payment_method" value="qris" class="hidden">
                            <div class="font-bold">⚡ QRIS</div>
                        </label>

                        <label class="cursor-pointer p-5 rounded-2xl border border-white/10 hover:border-orange-500">
                            <input type="radio" name="payment_method" value="dana" class="hidden">
                            <div class="font-bold">🟣 DANA</div>
                        </label>

                        <label class="cursor-pointer p-5 rounded-2xl border border-white/10 hover:border-orange-500">
                            <input type="radio" name="payment_method" value="ovo" class="hidden">
                            <div class="font-bold">🟢 OVO</div>
                        </label>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div>

                <div class="sticky top-24 bg-[#121212] border border-white/5 rounded-3xl p-6">

                    <h2 class="text-2xl font-black mb-6">
                        Order Summary
                    </h2>

                    @php $totalItems = 0; @endphp

                    @foreach($order->items as $item)
                        @php $totalItems += $item->quantity; @endphp

                        <div class="flex justify-between mb-2">
                            <span class="text-gray-400">
                                {{ $item->product->name }}
                            </span>
                            <span>
                                Rp {{ number_format($item->subtotal) }}
                            </span>
                        </div>

                    @endforeach

                    <div class="border-t border-white/10 my-4"></div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Total Item</span>
                        <span>{{ $totalItems }}</span>
                    </div>

                    <div class="flex justify-between mt-2">
                        <span class="text-gray-400">Total</span>
                        <span class="text-orange-500 font-black">
                            Rp {{ number_format($order->final_price) }}
                        </span>
                    </div>

                    <form action="{{ route('payment.show', $order->id) }}" method="GET" class="mt-8">

                        <button class="w-full py-4 rounded-2xl bg-orange-500 hover:bg-orange-400 font-black">
                            ⚡ Pay Now
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection