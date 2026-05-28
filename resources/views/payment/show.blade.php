@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-20">

    <div class="bg-[#121212] p-10 rounded-3xl">

        <h1 class="text-4xl font-black mb-8">

            Complete Payment

        </h1>

        <div class="space-y-4">

            <div>

                <p class="text-gray-400">
                    Invoice
                </p>

                <h3 class="text-xl">
                    {{ $order->invoice }}
                </h3>

            </div>

            <div>

                <p class="text-gray-400">
                    Total
                </p>

                <h3 class="text-3xl text-orange-500 font-black">
                    Rp {{ number_format($order->final_price) }}
                </h3>

            </div>

        </div>

        <div class="mt-8">
<form action="{{ route('payment.paid', $order->id) }}" method="POST"> @csrf <button type="submit" class="px-8 py-4 bg-green-500 rounded-2xl"> I Have Paid </button> </form>

        </div>

    </div>

</div>

@endsection