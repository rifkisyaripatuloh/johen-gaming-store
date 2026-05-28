@extends('layouts.app')

@section('content')

<div class="relative min-h-screen bg-[#0B0B0F] text-white overflow-hidden py-16">

    <!-- Glow -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/10 blur-[150px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[150px] rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-3 text-sm text-gray-400 mb-10">

            <a href="/" class="hover:text-orange-400">
                Home
            </a>

            <span>/</span>

            <a href="{{ route('products.index') }}"
               class="hover:text-orange-400">
                Products
            </a>

            <span>/</span>

            <span class="text-orange-400">
                {{ $product->name }}
            </span>

        </div>

        <!-- PRODUCT DETAIL -->
        <div class="grid lg:grid-cols-2 gap-12 items-start">

            <!-- IMAGE -->
            <div>

                <div class="bg-[#121212] border border-white/5 rounded-[35px] overflow-hidden">

                    <img
                        src="{{ asset('storage/'.$product->thumbnail) }}"
                        class="w-full h-[600px] object-cover"
                    >

                </div>

            </div>

            <!-- CONTENT -->
            <div>

                <div class="flex flex-wrap gap-3">

                    <span class="px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm">
                        {{ $product->category->name }}
                    </span>

                    @if($product->type == 'topup')
                        <span class="px-4 py-2 rounded-full bg-blue-500/10 text-blue-400 text-sm">
                            TOP UP
                        </span>
                    @else
                        <span class="px-4 py-2 rounded-full bg-purple-500/10 text-purple-400 text-sm">
                            ACCOUNT GAME
                        </span>
                    @endif

                </div>

                <h1 class="mt-6 text-5xl font-black">
                    {{ $product->name }}
                </h1>

               @if($product->type == 'sell_account')

<div class="mt-8">

    <div class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-purple-500/10 border border-purple-500/20">

        <span class="text-purple-400 text-xl">
            👑
        </span>

        <span class="font-semibold text-purple-300">
            Premium Account Available
        </span>

    </div>

</div>

@endif

                <!-- TOPUP PACKAGE -->
                @if($product->type == 'topup')

                <div class="mt-10">

                    <div class="flex justify-between mb-5">

                        <h3 class="text-2xl font-black">
                            Choose Package
                        </h3>

                        <span class="text-gray-400">
                            {{ $product->packages->count() }} Packages
                        </span>

                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">

                        @foreach($product->packages as $package)

                        <label
                            class="relative cursor-pointer bg-[#121212] border border-white/10 rounded-3xl p-5 hover:border-orange-500 transition">

                           <input
    type="radio"
    name="package_select"
    value="{{ $package->id }}"
    class="package-radio peer hidden"
>

                            <div
                                class="absolute inset-0 border-2 border-orange-500 rounded-3xl opacity-0 peer-checked:opacity-100">
                            </div>

                            <div class="flex justify-between items-center">

                                <div>

                                    <h4 class="font-black">
                                        {{ $package->name }}
                                    </h4>

                                    <p class="text-gray-400 text-sm mt-1">
                                        Stock : {{ $package->stock }}
                                    </p>

                                </div>

                                <div class="text-right">

                                    <span class="text-xs text-gray-500">
                                        Price
                                    </span>

                                    <h5 class="text-2xl font-black text-orange-500">
                                        Rp {{ number_format($package->price) }}
                                    </h5>

                                </div>

                            </div>

                        </label>

                        @endforeach

                    </div>

                </div>

                @endif


                <!-- ACCOUNT DETAIL -->
                @if($product->type == 'sell_account')

                <div class="mt-10">

                    <h3 class="text-2xl font-black mb-5">
                        Account Information
                    </h3>

                <div class="bg-[#121212] border border-white/5 rounded-3xl overflow-hidden divide-y divide-white/5">

                        @foreach($product->attributes as $attribute)

                        <div class="flex justify-between px-6 py-4 border-b border-white/5">

                            <span class="text-gray-400">
                                {{ $attribute->field_name }}
                            </span>

                            <span class="font-semibold">
                                {{ is_array($attribute->options)
                                    ? implode(', ', $attribute->options)
                                    : $attribute->options }}
                            </span>

                        </div>

                        @endforeach

                    </div>

                </div>

                @endif


                <!-- DESCRIPTION -->
                <div class="mt-10">

                    <h3 class="text-xl font-bold mb-3">
                        Description
                    </h3>

                    <p class="text-gray-400 leading-relaxed">
                        {{ $product->description }}
                    </p>

                </div>


                <!-- FEATURES -->
                <div class="grid grid-cols-3 gap-4 mt-10">

                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-5 text-center">
                        <div class="text-3xl mb-3">⚡</div>
                        <h4 class="font-bold">Instant</h4>
                    </div>

                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-5 text-center">
                        <div class="text-3xl mb-3">🔒</div>
                        <h4 class="font-bold">Secure</h4>
                    </div>

                    <div class="bg-[#121212] border border-white/5 rounded-2xl p-5 text-center">
                        <div class="text-3xl mb-3">💬</div>
                        <h4 class="font-bold">Support</h4>
                    </div>

                </div>


                <!-- BUTTON -->
                <div class="mt-10 flex gap-4 flex-wrap">

   <form action="{{ route('checkout.process') }}"
      method="POST"
      id="buyNowForm">

    @csrf

    <input type="hidden"
           name="product_id"
           value="{{ $product->id }}">

    {{-- PACKAGE --}}
    <input type="hidden"
           name="package_id"
           id="selectedPackage">

    {{-- CUSTOMER --}}
    <input type="hidden"
           name="customer_name"
           value="{{ auth()->user()->name }}">

    <input type="hidden"
           name="customer_phone"
           value="0000000000">

    {{-- PAYMENT --}}
    <input type="hidden"
           name="payment_method"
           value="bank">

    <button type="submit"
        class="px-10 py-4 rounded-2xl bg-orange-500 hover:bg-orange-400 font-bold">

        ⚡ Buy Now

    </button>

</form>

                   <form action="{{ route('cart.store') }}"
      method="POST">

    @csrf

    <input
        type="hidden"
        name="product_id"
        value="{{ $product->id }}">

    <button
        type="submit"
        class="px-10 py-4 rounded-2xl border border-white/10 hover:border-orange-500 hover:bg-orange-500/10 transition">

        🛒 Add To Cart

    </button>

</form>

                </div>

            </div>

        </div>


        <!-- RELATED PRODUCTS -->
        <section class="mt-24">

            <h2 class="text-4xl font-black mb-8">
                Related Products
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                @foreach($relatedProducts as $item)

                <a
                    href="{{ route('products.show',$item->slug) }}"
                    class="group bg-[#121212] rounded-3xl overflow-hidden border border-white/5 hover:border-orange-500/30 transition hover:-translate-y-2">

                    <div class="overflow-hidden">

                        <img
                            src="{{ asset('storage/'.$item->thumbnail) }}"
                            class="h-56 w-full object-cover group-hover:scale-110 transition duration-500"
                        >

                    </div>

                    <div class="p-5">

                        <h3 class="font-bold line-clamp-1">
                            {{ $item->name }}
                        </h3>

                        <p class="text-orange-500 font-black mt-3">
                            Rp {{ number_format($item->price) }}
                        </p>

                    </div>

                </a>

                @endforeach

            </div>

        </section>

    </div>

</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const radios =
        document.querySelectorAll('.package-radio');

    const selectedPackage =
        document.getElementById('selectedPackage');

    radios.forEach(radio => {

        radio.addEventListener('change', function () {

            selectedPackage.value = this.value;

        });

    });

});
</script>
@endsection