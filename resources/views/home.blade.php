@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0A0A0A] text-white overflow-hidden relative">

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/20 blur-[150px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[150px] rounded-full"></div>

    <!-- HERO -->
    <section class="relative">

        <div class="max-w-7xl mx-auto px-4 py-10">

            <div class="relative rounded-[35px] overflow-hidden border border-white/10">

                <img
                    src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=1600&auto=format&fit=crop"
                    class="absolute inset-0 w-full h-full object-cover"
                >

                <div class="absolute inset-0 bg-black/75"></div>

                <div class="relative z-10 px-6 md:px-16 py-24">

                    <!-- HERO CONTENT -->
                    <div class="max-w-2xl">

                        <span class="px-4 py-2 rounded-full bg-orange-500/20 text-orange-400 text-sm font-semibold">
                            Top Up Marketplace
                        </span>

                        <h2 class="mt-6 text-4xl md:text-7xl font-black leading-tight">
                            Top Up
                            <span class="text-orange-500">Game Instan</span>
                        </h2>

                        <p class="mt-6 text-gray-300 text-lg leading-relaxed max-w-xl">
                            Top up game cepat, aman, dan terpercaya langsung dari sistem admin panel.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- POPULAR GAMES (FROM DB) -->
    <section class="max-w-7xl mx-auto px-4 py-16">

        <div class="flex items-center justify-between mb-8">

            <div>
                <h2 class="text-3xl font-black">Popular Games</h2>
                <p class="text-gray-400 mt-2">Produk terbaru dari sistem</p>
            </div>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">

            @foreach($products as $product)

            <a href="{{ route('products.show', $product->slug) }}"
               class="group bg-[#121212] border border-white/5 rounded-3xl overflow-hidden hover:border-orange-500/40 transition duration-300 hover:-translate-y-2">

                <div class="overflow-hidden">

                    <img
                        src="{{ asset('storage/' . $product->thumbnail) }}"
                        class="h-40 w-full object-cover group-hover:scale-110 transition duration-500"
                    >

                </div>

                <div class="p-4">

                    <h3 class="font-bold">
                        {{ $product->name }}
                    </h3>

                    <p class="text-sm text-gray-400 mt-1">
                        {{ $product->category->name ?? '-' }}
                    </p>

                    <p class="text-orange-500 font-bold mt-2">
                        Rp {{ number_format($product->price) }}
                    </p>

                    <span class="inline-block mt-2 text-xs px-2 py-1 rounded bg-orange-500/20 text-orange-400">
                        {{ strtoupper($product->type) }}
                    </span>

                </div>

            </a>

            @endforeach

        </div>

    </section>

    <!-- POPULAR PACKAGES -->
    <section class="max-w-7xl mx-auto px-4 py-10">

        <div class="flex items-center justify-between mb-8">

            <div>
                <h2 class="text-3xl font-black">Popular Packages</h2>
                <p class="text-gray-400 mt-2">Produk rekomendasi</p>
            </div>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($products->take(4) as $product)

            <div class="group bg-[#121212] rounded-3xl overflow-hidden border border-white/5 hover:border-orange-500/40 transition hover:-translate-y-2 duration-300">

                <div class="overflow-hidden">

                    <img
                        src="{{ asset('storage/' . $product->thumbnail) }}"
                        class="h-52 w-full object-cover group-hover:scale-110 transition duration-500"
                    >

                </div>

                <div class="p-5">

                    <div class="flex items-center justify-between mb-3">

                        <span class="px-3 py-1 rounded-full bg-orange-500/20 text-orange-400 text-xs">
                            {{ $product->type }}
                        </span>

                        <span class="text-sm text-gray-400">
                            {{ $product->category->name ?? '-' }}
                        </span>

                    </div>

                    <h3 class="text-xl font-black">
                        {{ $product->name }}
                    </h3>

                    <p class="text-gray-400 mt-2 text-sm">
                        {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                    </p>

                    <div class="mt-6 flex items-center justify-between">

                        <h4 class="text-2xl font-black text-orange-500">
                            Rp {{ number_format($product->price) }}
                        </h4>

                        <a href="{{ route('products.show', $product->slug) }}"
                           class="px-5 py-2 rounded-xl bg-orange-500 hover:bg-orange-400 transition text-sm font-bold">
                            Buy
                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </section>

</div>

@endsection