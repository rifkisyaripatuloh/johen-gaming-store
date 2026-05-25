@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>
        <h2 class="text-3xl font-black">Products</h2>
        <p class="text-gray-400">Manage all game products</p>
    </div>

    <a href="{{ route('admin.products.create') }}"
   class="px-5 py-3 bg-orange-500 hover:bg-orange-400 rounded-xl font-bold">
    + Add Product
</a>

</div>

<!-- TABLE -->
<div class="bg-[#121212] border border-white/5 rounded-3xl overflow-hidden">

    <table class="w-full text-left">

        <thead class="bg-white/5 text-gray-300">
            <tr>
                <th class="p-4">Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th class="text-right p-4">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($products as $product)
            <tr class="border-t border-white/5 hover:bg-white/5 transition">

                <td class="p-4 flex items-center gap-3">
                    <img src="{{ asset('storage/'.$product->thumbnail) }}"
                         class="w-10 h-10 rounded-lg object-cover">
                    {{ $product->name }}
                </td>

                <td>{{ $product->category->name ?? '-' }}</td>

                <td class="text-orange-400 font-bold">
                    Rp {{ number_format($product->price) }}
                </td>

                <td>{{ $product->stock }}</td>

                <td class="text-right p-4 space-x-2">

                    <a href="{{ route('admin.products.edit', $product->id) }}"
   class="px-3 py-2 bg-blue-500/20 text-blue-400 rounded-lg">
    Edit
</a>
<form action="{{ route('admin.products.destroy', $product->id) }}"
      method="POST"
      class="inline">
    @csrf
    @method('DELETE')

    <button class="px-3 py-2 bg-red-500/20 text-red-400 rounded-lg">
        Delete
    </button>
</form>

                </td>

            </tr>
            @endforeach

        </tbody>

    </table>

</div>

<div class="mt-6">
    {{ $products->links() }}
</div>

@endsection