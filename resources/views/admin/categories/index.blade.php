@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h2 class="text-3xl font-black">Categories</h2>
        <p class="text-gray-400">Manage product categories</p>
    </div>

    <a href="{{ route('admin.categories.create') }}"
       class="px-5 py-3 bg-orange-500 rounded-xl font-bold">
        + Add Category
    </a>

</div>

<div class="bg-[#121212] rounded-3xl border border-white/5 overflow-hidden">

    <table class="w-full">

        <thead class="bg-white/5 text-gray-300">
            <tr>
                <th class="p-4">Name</th>
                <th>Description</th>
                <th class="text-right p-4">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($categories as $category)
            <tr class="border-t border-white/5 hover:bg-white/5">

                <td class="p-4 font-bold">{{ $category->name }}</td>

                <td class="text-gray-400">
                    {{ $category->description ?? '-' }}
                </td>

                <td class="text-right p-4 space-x-2">

                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                       class="px-3 py-2 bg-blue-500/20 text-blue-400 rounded-lg">
                        Edit
                    </a>

                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
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

@endsection