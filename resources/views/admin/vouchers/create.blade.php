@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-black mb-6">Create Voucher</h2>

<form action="{{ route('admin.vouchers.store') }}" method="POST"
      class="bg-[#121212] p-8 rounded-3xl space-y-5">

    @csrf

    <input type="text" name="code" placeholder="Voucher Code"
           class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">

    <input type="number" name="discount" placeholder="Discount %"
           class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">

    <input type="number" name="limit" placeholder="Usage Limit"
           class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">

    <button class="px-6 py-3 bg-orange-500 rounded-xl font-bold">
        Save Voucher
    </button>

</form>

@endsection