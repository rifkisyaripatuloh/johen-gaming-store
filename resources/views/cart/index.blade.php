@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0B0B0F] relative overflow-hidden text-white">

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/10 blur-[180px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[180px] rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4 py-12">

        <!-- HEADER -->
        <div class="mb-10">

            <span class="px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm">
                JOHEN GAMING CART
            </span>

            <h1 class="mt-5 text-4xl md:text-5xl font-black">
                My <span class="text-orange-500">Cart</span>
            </h1>

        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div class="lg:col-span-2 space-y-5">

                <!-- SELECT ALL -->
                <div class="bg-[#121212] border border-white/5 rounded-3xl p-5">

                    <label class="flex items-center gap-3">

                        <input type="checkbox"
                               id="checkAll"
                               class="w-5 h-5 accent-orange-500">

                        <span class="font-semibold">
                            Select All Products
                        </span>

                    </label>

                </div>

                @forelse($carts as $cart)

                <div class="group bg-[#121212] border border-white/5 hover:border-orange-500/30 rounded-3xl p-5 transition">

                    <div class="flex flex-col md:flex-row gap-5">

                        <!-- CHECKBOX -->
                        <div class="flex items-center">

                            <input type="checkbox"
                                   value="{{ $cart->id }}"
                                   class="cart-check w-5 h-5 accent-orange-500">

                        </div>

                        <!-- IMAGE -->
                        <img src="{{ asset('storage/'.$cart->product->thumbnail) }}"
                             class="w-full md:w-32 h-32 rounded-2xl object-cover">

                        <!-- CONTENT -->
                        <div class="flex-1">

                            <h3 class="text-xl font-black">
                                {{ $cart->product->name }}
                            </h3>

                            <p class="text-orange-500 font-bold mt-2">
                                Rp {{ number_format($cart->product->price) }}
                            </p>

                            <div class="mt-4 flex items-center gap-3">

                                <button type="button"
                                        class="minus w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 transition">
                                    -
                                </button>

                                <input type="number"
                                       value="{{ $cart->quantity ?? 1 }}"
                                       min="1"
                                       class="qty w-20 text-center bg-black/30 rounded-xl border border-white/10 py-2">

                                <button type="button"
                                        class="plus w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 transition">
                                    +
                                </button>

                            </div>

                        </div>

                        <!-- DELETE -->
                        <div class="flex items-start">

                            <form action="{{ route('cart.destroy',$cart->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-5 py-3 rounded-xl bg-red-500 hover:bg-red-400 transition">
                                    Remove
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                @empty

                <div class="bg-[#121212] border border-white/5 rounded-3xl p-10 text-center">

                    <h2 class="text-2xl font-bold text-gray-300">
                        Cart is Empty
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Add product to your cart first.
                    </p>

                </div>

                @endforelse

            </div>

            <!-- RIGHT -->
            <div>

                <div class="sticky top-24 bg-[#121212] border border-white/5 rounded-3xl p-6">

                    <h2 class="text-2xl font-black mb-6">
                        Order Summary
                    </h2>

                    <div class="space-y-4">

                        <div class="flex justify-between">
                            <span class="text-gray-400">Selected Items</span>
                            <span id="selectedCount">0</span>
                        </div>

                    </div>

                    <!-- CHECKOUT FORM -->
                    <form action="{{ route('cart.checkout.selected') }}"
                          method="POST"
                          id="checkoutForm">

                        @csrf

                        <!-- HIDDEN INPUTS -->
                        <div id="selectedInputs"></div>

                        <!-- PAYMENT -->
                        <div class="mt-6">

                            <label class="text-sm text-gray-400 block mb-2">
                                Payment Method
                            </label>

                            <select name="payment_method"
                                    class="w-full bg-black/30 border border-white/10 rounded-xl p-3 focus:outline-none focus:border-orange-500">

                                <option value="">
                                    Select Payment
                                </option>

                                <option value="Dana">
                                    Dana
                                </option>

                                <option value="OVO">
                                    OVO
                                </option>

                                <option value="Bank Transfer">
                                    Bank Transfer
                                </option>

                            </select>

                        </div>

                        <button type="submit"
                                class="mt-8 w-full py-4 rounded-2xl bg-orange-500 hover:bg-orange-400 transition font-black">

                            ⚡ Checkout Selected

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- JS --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const checkAll = document.getElementById('checkAll');
    const checks = document.querySelectorAll('.cart-check');
    const selectedCount = document.getElementById('selectedCount');
    const selectedInputs = document.getElementById('selectedInputs');

    function updateSummary() {

        let count = 0;

        selectedInputs.innerHTML = '';

        checks.forEach(c => {

            if (c.checked) {

                count++;

                const input = document.createElement('input');

                input.type = 'hidden';
                input.name = 'cart_ids[]';
                input.value = c.value;

                selectedInputs.appendChild(input);
            }
        });

        selectedCount.innerText = count;
    }

    // CHECK ALL
    checkAll.addEventListener('change', function () {

        checks.forEach(c => {
            c.checked = this.checked;
        });

        updateSummary();
    });

    // SINGLE CHECK
    checks.forEach(c => {

        c.addEventListener('change', function () {

            const allChecked =
                Array.from(checks).every(i => i.checked);

            checkAll.checked = allChecked;

            updateSummary();
        });
    });

});
</script>

@endsection