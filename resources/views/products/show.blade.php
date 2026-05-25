@extends('layouts.app')

@section('content')

<div class="relative min-h-screen py-16 overflow-hidden bg-[#0B0B0F] text-white">

    <!-- GLOW -->
    <div class="absolute top-20 left-0 w-[400px] h-[400px] bg-orange-500/10 blur-[120px] rounded-full"></div>

    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-orange-600/10 blur-[120px] rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4">

        <!-- BREADCRUMB -->
        <div class="flex items-center gap-3 text-sm text-gray-400 mb-10">

            <a href="/" class="hover:text-orange-400 transition">
                Home
            </a>

            <span>/</span>

            <a href="{{ route('products.index') }}" class="hover:text-orange-400 transition">
                Products
            </a>

            <span>/</span>

            <span class="text-orange-400">
           {{ $product['name'] }}
            </span>

        </div>

        <!-- PRODUCT DETAIL -->
        <div class="grid lg:grid-cols-2 gap-10 items-start">

            <!-- IMAGE -->
            <div class="relative">

                <div class="bg-[#121212] border border-white/5 rounded-[35px] overflow-hidden shadow-2xl">

                  <img
    src="{{ $product['image'] }}"
    class="w-full h-[600px] object-cover"
>

                </div>

            </div>

            <!-- CONTENT -->
            <div>

                <!-- CATEGORY -->
                <span class="px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-semibold">

                    {{ $product['category'] ?? 'Gaming' }}

                </span>

                <!-- TITLE -->
                <h1 class="mt-6 text-4xl md:text-5xl font-black leading-tight">

                    {{ $product['name'] }}

                </h1>
<!-- TOP UP LIST -->
<div class="mt-10">

    <div class="flex items-center justify-between mb-5">

        <h3 class="text-2xl font-black">
            Choose Top Up
        </h3>

        <span class="text-sm text-gray-400">
            Available Package
        </span>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <!-- ITEM -->
        @foreach([
            ['diamond' => '86 Diamonds', 'price' => 20000, 'stock' => 120],
            ['diamond' => '172 Diamonds', 'price' => 40000, 'stock' => 90],
            ['diamond' => '257 Diamonds', 'price' => 60000, 'stock' => 75],
            ['diamond' => '344 Diamonds', 'price' => 80000, 'stock' => 50],
            ['diamond' => '514 Diamonds', 'price' => 120000, 'stock' => 40],
            ['diamond' => '706 Diamonds', 'price' => 150000, 'stock' => 25],
        ] as $topup)

        <label
            class="group cursor-pointer relative overflow-hidden rounded-3xl border border-white/10 bg-[#121212] hover:border-orange-500/40 transition duration-300 p-5 flex items-center justify-between">

            <!-- RADIO -->
            <input
                type="radio"
                name="topup"
                class="hidden peer"
            >

            <!-- ACTIVE -->
            <div class="absolute inset-0 border-2 border-orange-500 opacity-0 peer-checked:opacity-100 rounded-3xl transition"></div>

            <!-- LEFT -->
            <div>

                <h4 class="text-lg font-black">
                    {{ $topup['diamond'] }}
                </h4>

                <p class="text-gray-400 text-sm mt-1">
                    Stock : {{ $topup['stock'] }}
                </p>

            </div>

            <!-- RIGHT -->
            <div class="text-right">

                <p class="text-xs text-gray-500">
                    Price
                </p>

                <h5 class="text-2xl font-black text-orange-500">
                    Rp {{ number_format($topup['price']) }}
                </h5>

            </div>

        </label>

        @endforeach

    </div>

</div>

                <!-- DESCRIPTION -->
                <div class="mt-10">

                    <h3 class="text-xl font-bold mb-4">
                        Description
                    </h3>

                    <p class="text-gray-400 leading-relaxed text-lg">

                        {{ $product['description']   }}

                    </p>

                </div>

                <!-- FEATURES -->
                <div class="grid grid-cols-3 gap-4 mt-10">

                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-5 text-center hover:border-orange-500/30 transition">

                        <div class="text-3xl mb-3">
                            ⚡
                        </div>

                        <h4 class="font-bold">
                            Instant
                        </h4>

                    </div>

                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-5 text-center hover:border-orange-500/30 transition">

                        <div class="text-3xl mb-3">
                            🔒
                        </div>

                        <h4 class="font-bold">
                            Secure
                        </h4>

                    </div>

                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-5 text-center hover:border-orange-500/30 transition">

                        <div class="text-3xl mb-3">
                            💬
                        </div>

                        <h4 class="font-bold">
                            Support
                        </h4>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-12 flex flex-wrap gap-4">

                    <a
                        href="#"
                        class="px-10 py-5 rounded-2xl bg-orange-500 hover:bg-orange-400 transition font-bold text-lg shadow-lg shadow-orange-500/20"
                    >

                        Buy Now

                    </a>

                    <button
                        class="px-10 py-5 rounded-2xl border border-white/10 hover:border-orange-500 hover:bg-orange-500/10 transition font-bold text-lg"
                    >

                        Add To Cart

                    </button>

                </div>

            </div>

        </div>

        <!-- RELATED PRODUCTS -->
        <div class="mt-28">

            <div class="flex items-center justify-between mb-10">

                <div>

                    <h2 class="text-4xl font-black">
                        Related Games
                    </h2>

                    <p class="text-gray-400 mt-2">
                        Other popular games you may like
                    </p>

                </div>

            </div>

            <!-- GRID -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                @foreach($relatedProducts as $item)

                <a
                    href="{{ route('products.show', $item['slug']) }}"
                    class="group bg-[#121212] border border-white/5 rounded-[28px] overflow-hidden hover:border-orange-500/30 transition hover:-translate-y-2"
                >

                    <div class="overflow-hidden">

                        <img
                            src="{{ $item['image'] }}"
                            class="h-56 w-full object-cover group-hover:scale-110 transition duration-500"
                        >

                    </div>

                    <div class="p-5">

                        <h3 class="font-bold text-lg line-clamp-1">
                            {{ $item['name'] }}
                        </h3>

                        <p class="text-orange-500 font-black mt-3">
                            Rp {{ number_format($item['price']) }}
                        </p>

                    </div>

                </a>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection