@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto">

    <h2 class="text-3xl font-black mb-8">
        Create Product
    </h2>

    <form action="{{ route('admin.products.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-[#121212] rounded-3xl p-8 space-y-6">

        @csrf

        <!-- NAME -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Product Name
            </label>

            <input type="text"
                   name="name"
                   class="w-full p-4 rounded-xl bg-black/30 border border-white/10">
        </div>

        <!-- CATEGORY -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Category
            </label>

            <select name="category_id"
                    class="w-full p-4 rounded-xl bg-black/30 border border-white/10">

                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <!-- TYPE -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Product Type
            </label>

            <select id="productType"
                    name="type"
                    class="w-full p-4 rounded-xl bg-black/30 border border-white/10">

                <option value="">Choose Type</option>
                <option value="topup">Top Up Game</option>
                <option value="sell_account">Game Account</option>

            </select>
        </div>

        <!-- IMAGE -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Thumbnail
            </label>

            <input type="file"
                   name="thumbnail"
                   class="w-full p-4 rounded-xl bg-black/30 border border-white/10">
        </div>

        <!-- DESCRIPTION -->
        <div>
            <label class="block mb-2 text-sm text-gray-400">
                Description
            </label>

            <textarea
                name="description"
                rows="5"
                class="w-full p-4 rounded-xl bg-black/30 border border-white/10"></textarea>
        </div>

        <!-- ================================================= -->
        <!-- TOPUP -->
        <!-- ================================================= -->

        <div id="topupSection" class="hidden">

            <div class="border-t border-white/10 pt-6">

                <h3 class="text-2xl font-bold mb-4">
                    Top Up Packages
                </h3>

                <div id="package-wrapper">

                </div>

                <button type="button"
                        onclick="addPackage()"
                        class="mt-4 px-5 py-3 bg-orange-500 rounded-xl font-bold">

                    + Add Package

                </button>

            </div>

        </div>

        <!-- ================================================= -->
        <!-- ACCOUNT -->
        <!-- ================================================= -->

     <div id="accountSection" class="hidden">

    <div class="border-t border-white/10 pt-6">

        <h3 class="text-2xl font-bold mb-2">
            Account Information
        </h3>

        <p class="text-gray-400 mb-6">
            Tambahkan detail akun yang akan dijual
        </p>

        <div id="attribute-wrapper"></div>

        <button
            type="button"
            onclick="addAttribute()"
            class="mt-4 px-5 py-3 bg-blue-500 hover:bg-blue-400 rounded-xl font-bold">

            + Add Information

        </button>

    </div>

</div>

    <!-- ACCOUNT PRICE -->
<div id="accountPriceSection" class="hidden">

    <label class="block mb-2 text-sm text-gray-400">
        Account Price
    </label>

    <input
        type="number"
        name="price"
        placeholder="Masukkan harga akun"
        class="w-full p-4 rounded-xl bg-black/30 border border-white/10">

</div>
        <button
            class="px-8 py-4 bg-orange-500 rounded-xl font-bold">

            Save Product

        </button>

    </form>

</div>

<script>

const productType =
document.getElementById('productType');

const topupSection =
document.getElementById('topupSection');

const accountSection =
document.getElementById('accountSection');
const accountPriceSection =
document.getElementById('accountPriceSection');

productType.addEventListener('change', function() 
{

    if(this.value === 'topup') {

        topupSection.classList.remove('hidden');
        accountSection.classList.add('hidden');
        accountPriceSection.classList.add('hidden');

    }
    else if(this.value === 'sell_account') {

        accountSection.classList.remove('hidden');
        topupSection.classList.add('hidden');
        accountPriceSection.classList.remove('hidden');

    }
    else {

        topupSection.classList.add('hidden');
        accountSection.classList.add('hidden');
        accountPriceSection.classList.add('hidden');

    }

});

let packageIndex = 0;

function addPackage()
{
    const html = `
        <div class="grid md:grid-cols-3 gap-3 mb-3">

            <input
                type="text"
                name="packages[${packageIndex}][name]"
                placeholder="86 Diamond"
                class="p-3 rounded-xl bg-black/30 border border-white/10">

            <input
                type="number"
                name="packages[${packageIndex}][price]"
                placeholder="Price"
                class="p-3 rounded-xl bg-black/30 border border-white/10">

            <input
                type="number"
                name="packages[${packageIndex}][stock]"
                placeholder="Stock"
                class="p-3 rounded-xl bg-black/30 border border-white/10">

                 <input
        type="number"
        name="price"
        placeholder="Harga akun"
        class="w-full p-4 rounded-xl bg-black/30 border border-white/10">

        </div>
    `;

    document
        .getElementById('package-wrapper')
        .insertAdjacentHTML('beforeend', html);

    packageIndex++;
}

addPackage();

let attributeIndex = 0;

function addAttribute()
{
    const html = `
        <div class="grid md:grid-cols-2 gap-3 mb-3">

            <input
                type="text"
                name="attributes[${attributeIndex}][field_name]"
                placeholder="Contoh : Rank"
                class="p-3 rounded-xl bg-black/30 border border-white/10">

            <input
                type="text"
                name="attributes[${attributeIndex}][value]"
                placeholder="Contoh : Mythic Immortal"
                class="p-3 rounded-xl bg-black/30 border border-white/10">

        </div>
    `;

    document
        .getElementById('attribute-wrapper')
        .insertAdjacentHTML('beforeend', html);

    attributeIndex++;
}


</script>

@endsection