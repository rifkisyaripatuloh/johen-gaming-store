@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

        <div>

            <span class="text-orange-500 text-sm font-semibold uppercase tracking-widest">
                Product Management
            </span>

            <h1 class="text-4xl font-black mt-2">
                Game Products
            </h1>

            <p class="text-gray-400 mt-2">
                Manage Top Up Packages and Game Accounts
            </p>

        </div>

        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center gap-2 px-6 py-4 rounded-2xl bg-orange-500 hover:bg-orange-400 transition font-bold shadow-lg shadow-orange-500/20">

            <span>+</span>
            Add Product

        </a>

    </div>

  

    <!-- TABLE -->
    <div class="bg-[#121212] border border-white/5 rounded-[30px] overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-white/5 text-gray-300">

                        <th class="text-left p-5">
                            Product
                        </th>

                        <th class="text-left">
                            Type
                        </th>

                        <th class="text-left">
                            Category
                        </th>

                        <th class="text-left">
                            Price
                        </th>

                        <th class="text-left">
                            Stock
                        </th>

                        <th class="text-left">
                            Status
                        </th>

                        <th class="text-left">
                            Packages
                        </th>

                        <th class="text-right p-5">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($products as $product)

                    <tr class="border-t border-white/5 hover:bg-white/[0.03] transition">

                        <!-- PRODUCT -->
                        <td class="p-5">

                            <div class="flex items-center gap-4">

                                <img
                                    src="{{ asset('storage/'.$product->thumbnail) }}"
                                    class="w-16 h-16 rounded-2xl object-cover border border-white/10"
                                >

                                <div>

                                    <h4 class="font-bold">
                                        {{ $product->name }}
                                    </h4>

                                    <p class="text-sm text-gray-500">
                                        {{ $product->slug }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- TYPE -->
                        <td>

                            @if($product->type == 'topup')

                                <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-bold">

                                    TOP UP

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-bold">

                                    ACCOUNT

                                </span>

                            @endif

                        </td>

                        <!-- CATEGORY -->
                        <td>

                            <span class="text-gray-300">
                                {{ $product->category->name ?? '-' }}
                            </span>

                        </td>

                        <!-- PRICE -->
                        <td>

                            <span class="font-black text-orange-500">

                                Rp {{ number_format($product->price) }}

                            </span>

                        </td>

                        <!-- STOCK -->
                        <td>

                            <span class="font-semibold">

                                {{ $product->stock }}

                            </span>

                        </td>

                        <!-- STATUS -->
                        <td>

                            @if($product->status == 'available')

                                <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs">

                                    Available

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-red-500/10 text-red-400 text-xs">

                                    Sold

                                </span>

                            @endif

                        </td>

                        <!-- PACKAGE -->
                        <td>

                            @if($product->type == 'topup')

                                <span class="text-orange-400 font-bold">

                                    {{ $product->packages->count() }}

                                </span>

                            @else

                                <span class="text-gray-500">

                                    -

                                </span>

                            @endif

                        </td>

                        <!-- ACTION -->
                        <td class="p-5">

                            <div class="flex justify-end gap-2">

                                <a
                                    href="{{ route('admin.products.edit',$product->id) }}"
                                    class="px-4 py-2 rounded-xl bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('admin.products.destroy',$product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this product?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-4 py-2 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500/20 transition">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center py-20 text-gray-500">

                            No products found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->
    <div>

        {{ $products->links() }}

    </div>

</div>

@endsection