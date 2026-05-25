@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-black mb-6">Create Product</h2>

<form action="{{ route('admin.products.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-[#121212] p-8 rounded-3xl space-y-6">

    @csrf

    <!-- PRODUCT NAME -->
    <input type="text" name="name" placeholder="Product Name"
           class="w-full p-3 bg-black/40 rounded-xl border border-white/10 text-white">

    <!-- PRICE -->
    <input type="number" name="price" placeholder="Base Price"
           class="w-full p-3 bg-black/40 rounded-xl border border-white/10 text-white">

    <!-- STOCK -->
    <input type="number" name="stock" placeholder="Stock"
           class="w-full p-3 bg-black/40 rounded-xl border border-white/10 text-white">

    <!-- CATEGORY -->
    <select name="category_id"
            class="w-full p-3 bg-black/40 rounded-xl border border-white/10 text-white">

        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach

    </select>

    <!-- TYPE -->
    <select name="type"
            class="w-full p-3 bg-black/40 rounded-xl border border-white/10 text-white">

        <option value="">-- Select Type --</option>
        <option value="topup">Top Up</option>
        <option value="account">Account Game</option>

    </select>

    <!-- IMAGE -->
    <input type="file" name="thumbnail"
           class="w-full p-3 bg-black/40 rounded-xl border border-white/10 text-white">

    <!-- DESCRIPTION -->
    <textarea name="description"
              class="w-full p-3 bg-black/40 rounded-xl border border-white/10 text-white"
              placeholder="Description"></textarea>

    <!-- ===================== -->
    <!-- PRODUCT PACKAGES -->
    <!-- ===================== -->
    <div class="mt-6">

        <h3 class="text-xl font-bold mb-4">Product Packages</h3>

        <div id="package-wrapper" class="space-y-3">

            <!-- PACKAGE ITEM (DEFAULT 1) -->
            <div class="grid grid-cols-3 gap-3">

                <input type="text"
                       name="packages[0][name]"
                       placeholder="Example: 86 Diamonds"
                       class="p-3 bg-black/40 rounded-xl border border-white/10 text-white">

                <input type="number"
                       name="packages[0][price]"
                       placeholder="Price"
                       class="p-3 bg-black/40 rounded-xl border border-white/10 text-white">

                <input type="number"
                       name="packages[0][stock]"
                       placeholder="Stock"
                       class="p-3 bg-black/40 rounded-xl border border-white/10 text-white">

            </div>

        </div>

        <!-- OPTIONAL ADD BUTTON (JS SIMPLE LATER) -->
        <button type="button"
                onclick="addPackage()"
                class="mt-4 px-4 py-2 bg-white/10 rounded-xl text-sm hover:bg-white/20">
            + Add Package
        </button>

    </div>

    <!-- SUBMIT -->
    <button class="px-6 py-3 bg-orange-500 rounded-xl font-bold mt-6">
        Save Product
    </button>

</form>

<!-- SIMPLE JS ADD PACKAGE -->
<script>
let index = 1;

function addPackage() {
    const wrapper = document.getElementById('package-wrapper');

    const html = `
        <div class="grid grid-cols-3 gap-3 mt-3">

            <input type="text"
                name="packages[${index}][name]"
                placeholder="Package Name"
                class="p-3 bg-black/40 rounded-xl border border-white/10 text-white">

            <input type="number"
                name="packages[${index}][price]"
                placeholder="Price"
                class="p-3 bg-black/40 rounded-xl border border-white/10 text-white">

            <input type="number"
                name="packages[${index}][stock]"
                placeholder="Stock"
                class="p-3 bg-black/40 rounded-xl border border-white/10 text-white">

        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);
    index++;
}
</script>

@endsection