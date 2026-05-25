@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-black mb-6">Edit Product</h2>

<form action="{{ route('admin.products.update', $product->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-[#121212] p-8 rounded-3xl space-y-5">

    @csrf
    @method('PUT')

    <input type="text" name="name"
           value="{{ $product->name }}"
           class="w-full p-3 bg-black/40 rounded-xl border border-white/10">

    <input type="number" name="price"
           value="{{ $product->price }}"
           class="w-full p-3 bg-black/40 rounded-xl border border-white/10">

    <input type="number" name="stock"
           value="{{ $product->stock }}"
           class="w-full p-3 bg-black/40 rounded-xl border border-white/10">

    <select name="category_id"
            class="w-full p-3 bg-black/40 rounded-xl border border-white/10">

        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach

    </select>

    <input type="file" name="thumbnail"
           class="w-full p-3 bg-black/40 rounded-xl border border-white/10">

    <textarea name="description"
              class="w-full p-3 bg-black/40 rounded-xl border border-white/10">
        {{ $product->description }}
    </textarea>

    <button class="px-6 py-3 bg-blue-500 rounded-xl font-bold">
        Update Product
    </button>

</form>

@endsection