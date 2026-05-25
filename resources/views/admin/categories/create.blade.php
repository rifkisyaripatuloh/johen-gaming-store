@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-black mb-6">Create Category</h2>

<form action="{{ route('admin.categories.store') }}" method="POST"
      class="bg-[#121212] p-8 rounded-3xl space-y-5">

    @csrf

    <input type="text" name="name" placeholder="Category Name"
           class="w-full p-3 bg-black/40 border border-white/10 rounded-xl">

    <textarea name="description" placeholder="Description"
              class="w-full p-3 bg-black/40 border border-white/10 rounded-xl"></textarea>

    <button class="px-6 py-3 bg-orange-500 rounded-xl font-bold">
        Save Category
    </button>

</form>

@endsection