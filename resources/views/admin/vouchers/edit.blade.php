@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-black mb-6">Edit Voucher</h2>

<form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST"
      class="bg-[#121212] p-8 rounded-3xl space-y-5">

    @csrf
    @method('PUT')

    <input type="text" name="code"
           value="{{ $voucher->code }}"
           class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">

    <input type="number" name="discount"
           value="{{ $voucher->discount }}"
           class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">

    <input type="number" name="limit"
           value="{{ $voucher->limit }}"
           class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">

    <button class="px-6 py-3 bg-blue-500 rounded-xl font-bold">
        Update Voucher
    </button>

</form>

@endsection