@extends('layouts.app')

@section('content')

<div class="relative min-h-screen overflow-hidden">

    <!-- BACKGROUND -->
    <div class="absolute top-20 left-0 w-[400px] h-[400px] bg-orange-500/10 blur-[120px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-orange-600/10 blur-[120px] rounded-full"></div>

    <!-- HEADER -->
    <section class="relative py-24">

        <div class="max-w-7xl mx-auto px-4">

            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <div>

                    <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-semibold">
                        🎮 JOHEN GAMING STORE
                    </span>

                    <h1 class="mt-8 text-5xl md:text-7xl font-black leading-tight">

                        Power Up Your
                        <span class="text-orange-500">
                            Gaming Journey
                        </span>

                    </h1>

                    <p class="mt-6 text-lg text-gray-400 max-w-2xl leading-relaxed">

                        Top up game favoritmu dalam hitungan detik atau dapatkan akun premium dengan rank tinggi,
                        skin langka, dan koleksi eksklusif dari marketplace terpercaya.

                    </p>

                    <div class="flex flex-wrap gap-4 mt-10">

                        <div class="px-5 py-3 rounded-2xl bg-[#121212] border border-white/10">
                            ⚡ Instant Delivery
                        </div>

                        <div class="px-5 py-3 rounded-2xl bg-[#121212] border border-white/10">
                            🔒 Secure Transaction
                        </div>

                        <div class="px-5 py-3 rounded-2xl bg-[#121212] border border-white/10">
                            👑 Premium Accounts
                        </div>

                    </div>

                </div>

                <div>

                    <div class="relative">

                        <input
                            type="text"
                            placeholder="Search game, top up, account..."
                            class="w-full h-16 bg-[#121212] border border-white/10 rounded-3xl pl-16 pr-5 outline-none focus:border-orange-500 transition">

                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-xl">
                            🔍
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CATEGORY -->
    <section class="relative pb-12">

        <div class="max-w-7xl mx-auto px-4">

            <div class="flex gap-4 overflow-x-auto scrollbar-hide pb-2">

                @foreach($categories ?? [] as $category)

                <button
                    class="whitespace-nowrap px-6 py-3 rounded-2xl bg-[#121212] border border-white/5 hover:border-orange-500/30 hover:bg-orange-500/10 transition font-semibold text-sm">

                    {{ $category->name }}

                </button>

                @endforeach

            </div>

        </div>

    </section>

    <!-- PRODUCTS -->
    <section class="relative pb-24">

        <div class="max-w-7xl mx-auto px-4">

            <!-- TITLE -->
            <div class="flex items-center justify-between mb-10">

                <div>
                    <h2 class="text-3xl font-black">Popular Games</h2>

                    <p class="text-gray-400 mt-2">
                        Choose your favorite game and top up instantly
                    </p>
                </div>

            </div>

            <!-- GRID -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

                @foreach($products as $product)

                @php

                    $stock = 0;

                    if($product->type === 'sell_account') {

                        $stock = \App\Models\AccountDelivery::where(
                            'product_id',
                            $product->id
                        )
                        ->where('is_sent', false)
                        ->count();
                    }

                @endphp

                <a href="{{ $product->type === 'sell_account' && $stock <= 0 ? '#' : route('products.show', $product->slug) }}"
                   class="group relative overflow-hidden rounded-[32px] border border-white/10 bg-[#121212]
                   {{ $product->type === 'sell_account' && $stock <= 0
                        ? 'opacity-60 cursor-not-allowed'
                        : 'hover:border-orange-500/40 hover:-translate-y-3'
                   }}
                   transition-all duration-500">

                    <!-- GLOW -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">

                        <div class="absolute -top-20 right-0 w-40 h-40 bg-orange-500/20 blur-[80px] rounded-full"></div>

                    </div>

                    <!-- IMAGE -->
                    <div class="relative overflow-hidden">

                        <img
                            src="{{ asset('storage/' . $product->thumbnail) }}"
                            class="h-64 w-full object-cover group-hover:scale-110 transition duration-700">

                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/10 to-transparent"></div>

                        <!-- BADGE -->
                        <div class="absolute top-4 left-4">

                            @if($product->type === 'topup')

                                <span class="px-3 py-1 rounded-full bg-green-500 text-black text-xs font-black">
                                    ⚡ TOP UP
                                </span>

                            @else

                                @if($stock > 0)

                                    <span class="px-3 py-1 rounded-full bg-orange-500 text-black text-xs font-black">
                                        👑 STOCK {{ $stock }}
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full bg-red-500 text-white text-xs font-black">
                                        ❌ STOCK HABIS
                                    </span>

                                @endif

                            @endif

                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="relative p-5">

                        <div class="flex items-center justify-between">

                            <span class="text-xs text-orange-400 font-semibold">
                                {{ $product->category->name ?? '-' }}
                            </span>

                            <span class="text-yellow-400 text-xs">
                                ⭐ 4.9
                            </span>

                        </div>

                        <h3 class="mt-3 text-xl font-black line-clamp-1">
                            {{ $product->name }}
                        </h3>

                        <p class="mt-3 text-sm text-gray-400 line-clamp-2">
                            {{ $product->description }}
                        </p>

                        <div class="mt-6 flex items-center justify-between">

                            <div>

                                @if($product->type === 'sell_account')

                                    <p class="text-xs text-gray-500">
                                        Account Price
                                    </p>

                                    <h4 class="text-2xl font-black text-orange-500">
                                        Rp {{ number_format($product->price) }}
                                    </h4>

                                @else

                                    <span class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-green-500/10 text-green-400 text-sm font-bold">

                                        ⚡ Instant Top Up

                                    </span>

                                @endif

                            </div>

                            <div
                                class="w-12 h-12 rounded-2xl
                                {{ $product->type === 'sell_account' && $stock <= 0
                                    ? 'bg-gray-500'
                                    : 'bg-orange-500'
                                }}
                                flex items-center justify-center text-black font-black group-hover:rotate-45 transition duration-500">

                                →

                            </div>

                        </div>

                    </div>

                </a>

                @endforeach

            </div>

        </div>

    </section>

</div>

@endsection