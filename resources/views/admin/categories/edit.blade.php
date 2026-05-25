@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-black mb-6">Edit Category</h2>

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
      class="bg-[#121212] p-8 rounded-3xl space-y-5">

    @csrf
    @method('PUT')

    <input type="text" name="name"
           value="{{ $category->name }}"
           class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">

    <textarea name="description"
              class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">{{ $category->description }}</textarea>

    <button class="px-6 py-3 bg-blue-500 rounded-xl font-bold">
        Update Category
    </button>

</form>

@endsection