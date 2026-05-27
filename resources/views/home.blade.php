@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0A0A0A] text-white overflow-hidden relative">

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/20 blur-[150px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[150px] rounded-full"></div>

    <!-- HERO -->
<section class="relative">

    <div class="max-w-7xl mx-auto px-4 py-10">

        <div class="relative rounded-[40px] overflow-hidden border border-white/10">

            <!-- BACKGROUND -->
            <img
                src="https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=1600&auto=format&fit=crop"
                class="absolute inset-0 w-full h-full object-cover"
            >

            <!-- OVERLAY -->
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/90 to-black/60"></div>

            <!-- GLOW -->
            <div class="absolute -top-20 left-20 w-72 h-72 bg-orange-500/20 blur-[120px] rounded-full"></div>

            <div class="absolute bottom-0 right-0 w-80 h-80 bg-orange-600/10 blur-[120px] rounded-full"></div>

            <!-- CONTENT -->
            <div class="relative z-10 px-6 md:px-16 py-24 md:py-32">

                <div class="max-w-3xl">

                    <!-- BADGE -->
                    <span
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-semibold">

                        🔥 Trusted Gaming Marketplace

                    </span>

                    <!-- TITLE -->
                    <h1 class="mt-8 text-5xl md:text-7xl font-black leading-tight">

                        Top Up &
                        <span class="text-orange-500">
                            Buy Game Accounts
                        </span>

                        Instantly

                    </h1>

                    <!-- DESC -->
                    <p class="mt-6 text-lg text-gray-300 leading-relaxed max-w-2xl">

                        Platform terpercaya untuk top up game favorit dan jual beli akun game premium.
                        Proses cepat, aman, otomatis, dan didukung berbagai metode pembayaran.

                    </p>

                    <!-- BUTTON -->
                    <div class="mt-10 flex flex-wrap gap-4">

                        <a href="#games"
                           class="px-8 py-4 rounded-2xl bg-orange-500 hover:bg-orange-400 transition font-bold shadow-lg shadow-orange-500/30">

                            🎮 Top Up Sekarang

                        </a>

                        <a href="#accounts"
                           class="px-8 py-4 rounded-2xl border border-white/20 hover:border-orange-500 hover:bg-orange-500/10 transition font-bold">

                            👑 Lihat Akun Premium

                        </a>

                    </div>

                    <!-- STATS -->
                    <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4">

                        <div
                            class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 hover:border-orange-500/30 transition">

                            <h3 class="text-3xl font-black text-orange-500">
                                50K+
                            </h3>

                            <p class="text-sm text-gray-400 mt-1">
                                Transaksi
                            </p>

                        </div>

                        <div
                            class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 hover:border-orange-500/30 transition">

                            <h3 class="text-3xl font-black text-orange-500">
                                10K+
                            </h3>

                            <p class="text-sm text-gray-400 mt-1">
                                Top Up Selesai
                            </p>

                        </div>

                        <div
                            class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 hover:border-orange-500/30 transition">

                            <h3 class="text-3xl font-black text-orange-500">
                                5K+
                            </h3>

                            <p class="text-sm text-gray-400 mt-1">
                                Akun Dijual
                            </p>

                        </div>

                        <div
                            class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 hover:border-orange-500/30 transition">

                            <h3 class="text-3xl font-black text-orange-500">
                                24/7
                            </h3>

                            <p class="text-sm text-gray-400 mt-1">
                                Support
                            </p>

                        </div>

                    </div>

                    <!-- FEATURES -->
                    <div class="mt-12 flex flex-wrap gap-3">

                        <span
                            class="px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-300">
                            ⚡ Instant Top Up
                        </span>

                        <span
                            class="px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-300">
                            🔒 Secure Marketplace
                        </span>

                        <span
                            class="px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-300">
                            💎 Premium Accounts
                        </span>

                        <span
                            class="px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-300">
                            💳 Multiple Payments
                        </span>

                    </div>

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
<!-- ===================================== -->
<!-- PREMIUM ACCOUNT MARKETPLACE -->
<!-- ===================================== -->
<section class="max-w-7xl mx-auto px-4 py-20 relative">

    <div class="flex items-center justify-between mb-10">

        <div>
            <span class="text-orange-500 font-semibold uppercase tracking-widest text-sm">
                Marketplace
            </span>

            <h2 class="text-4xl md:text-5xl font-black mt-3">
                Premium Game Accounts
            </h2>

            <p class="text-gray-400 mt-3">
                Akun pilihan dengan skin langka, rank tinggi, dan koleksi eksklusif.
            </p>
        </div>

        <a href="#"
           class="hidden md:flex items-center gap-2 px-6 py-3 rounded-2xl bg-orange-500/10 border border-orange-500/20 hover:bg-orange-500 hover:text-black transition">
            View All Accounts →
        </a>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        @foreach($products->where('type','account')->take(3) as $account)

        <a href="{{ route('products.show',$account->slug) }}"
           class="group relative overflow-hidden rounded-[32px] border border-white/10 bg-gradient-to-b from-[#171717] to-[#0F0F0F] hover:border-orange-500/40 transition duration-500 hover:-translate-y-3">

            <!-- GLOW -->
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500">

                <div class="absolute -top-20 right-0 w-52 h-52 bg-orange-500/20 blur-[100px] rounded-full"></div>

            </div>

            <div class="relative">

                <img
                    src="{{ asset('storage/'.$account->thumbnail) }}"
                    class="w-full h-72 object-cover group-hover:scale-110 transition duration-700"
                >

                <div class="absolute top-5 left-5">

                    <span class="px-3 py-1 rounded-full bg-orange-500 text-black text-xs font-black">
                        HOT ACCOUNT
                    </span>

                </div>

            </div>

            <div class="p-6 relative">

                <h3 class="text-2xl font-black group-hover:text-orange-400 transition">
                    {{ $account->name }}
                </h3>

                <p class="text-gray-400 mt-3 line-clamp-2">
                    {{ \Illuminate\Support\Str::limit($account->description,100) }}
                </p>

                <div class="grid grid-cols-3 gap-3 mt-6">

                    <div class="bg-black/40 rounded-xl p-3 text-center">
                        <p class="text-xs text-gray-400">Rank</p>
                        <p class="font-bold">Mythic</p>
                    </div>

                    <div class="bg-black/40 rounded-xl p-3 text-center">
                        <p class="text-xs text-gray-400">Skins</p>
                        <p class="font-bold">200+</p>
                    </div>

                    <div class="bg-black/40 rounded-xl p-3 text-center">
                        <p class="text-xs text-gray-400">Hero</p>
                        <p class="font-bold">120+</p>
                    </div>

                </div>

                <div class="mt-8 flex justify-between items-center">

                    <div>

                        <p class="text-sm text-gray-500">
                            Starting From
                        </p>

                        <h4 class="text-3xl font-black text-orange-500">
                            Rp {{ number_format($account->price) }}
                        </h4>

                    </div>

                    <div
                        class="w-12 h-12 rounded-full bg-orange-500 flex items-center justify-center text-black font-black group-hover:rotate-45 transition">
                        →
                    </div>

                </div>

            </div>

        </a>

        @endforeach

    </div>

</section>
</div>

@endsection