@extends('layouts.app')

@section('content')

<div class="relative min-h-screen overflow-hidden">

    <!-- BACKGROUND -->
    <div class="absolute top-20 left-0 w-[400px] h-[400px] bg-orange-500/10 blur-[120px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-orange-600/10 blur-[120px] rounded-full"></div>

    <!-- HEADER -->
    <section class="relative py-20">

        <div class="max-w-7xl mx-auto px-4">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">

                <!-- LEFT -->
                <div class="max-w-2xl">

                    <span class="px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm font-semibold">
                        JOHEN GAMING STORE
                    </span>

                    <h1 class="mt-6 text-5xl md:text-6xl font-black leading-tight">
                        Top Up Your
                        <span class="text-orange-500">Favorite Games</span>
                    </h1>

                    <p class="mt-6 text-gray-400 text-lg leading-relaxed">
                        Fast, secure, and instant top up for the most popular games.
                        Trusted by thousands of gamers across Indonesia.
                    </p>

                </div>

                <!-- SEARCH -->
                <div class="w-full lg:w-[400px]">

                    <div class="relative">

                        <input
                            type="text"
                            placeholder="Search games..."
                            class="w-full bg-[#121212] border border-white/10 focus:border-orange-500 rounded-2xl pl-14 pr-5 py-4 outline-none text-white placeholder:text-gray-500"
                        >

                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-500">
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

                <a href="{{ route('products.show', $product->slug) }}"
                   class="group relative bg-[#121212] border border-white/5 rounded-[28px] overflow-hidden hover:border-orange-500/30 transition duration-300 hover:-translate-y-2 block">

                    <!-- IMAGE -->
                    <div class="relative overflow-hidden">

                        <img
                            src="{{ asset('storage/' . $product->thumbnail) }}"
                            class="h-64 w-full object-cover group-hover:scale-110 transition duration-500"
                        >

                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

                        <!-- BADGE -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-orange-500 text-xs font-bold">
                                {{ strtoupper($product->type) }}
                            </span>
                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="p-5">

                        <div class="flex items-center justify-between mb-3">

                            <span class="text-xs text-orange-400 font-semibold">
                                {{ $product->category->name ?? '-' }}
                            </span>

                            <div class="flex items-center gap-1 text-yellow-400 text-xs">
                                ⭐ 4.9
                            </div>

                        </div>

                        <h3 class="text-lg font-black line-clamp-1">
                            {{ $product->name }}
                        </h3>

                        <p class="text-sm text-gray-400 mt-2 leading-relaxed line-clamp-2">
                            {{ $product->description }}
                        </p>

                        <div class="mt-5 flex items-center justify-between">

                            <div>
                                <p class="text-xs text-gray-500">Starting From</p>
                                <div>
    @if($product->type === 'sell_account')

        <p class="text-xs text-gray-500">Price</p>

        <h4 class="text-xl font-black text-orange-500">
            Rp {{ number_format($product->price) }}
        </h4>

    @else

        <p class="text-xs text-gray-500">Packages</p>

        <h4 class="text-lg font-black text-green-400">
            Multiple Top Up Options
        </h4>

    @endif
</div>
                            </div>

                            <div class="w-12 h-12 rounded-2xl bg-orange-500 hover:bg-orange-400 transition flex items-center justify-center text-lg font-bold shadow-lg shadow-orange-500/20">
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