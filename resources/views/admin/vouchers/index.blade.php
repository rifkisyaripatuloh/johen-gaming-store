@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h2 class="text-3xl font-black">Vouchers</h2>
        <p class="text-gray-400">Manage discount vouchers</p>
    </div>

    <a href="{{ route('admin.vouchers.create') }}"
       class="px-5 py-3 bg-orange-500 rounded-xl font-bold">
        + Add Voucher
    </a>

</div>

<div class="bg-[#121212] border border-white/5 rounded-3xl overflow-hidden">

    <table class="w-full">

        <thead class="bg-white/5 text-gray-300">
            <tr>
                <th class="p-4">Code</th>
                <th>Discount</th>
                <th>Limit</th>
                <th>Status</th>
                <th class="text-right p-4">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($vouchers as $voucher)
            <tr class="border-t border-white/5 hover:bg-white/5">

                <td class="p-4 font-bold text-orange-400">
                    {{ $voucher->code }}
                </td>

                <td>
                    {{ $voucher->discount }}%
                </td>

                <td>
                    {{ $voucher->limit }}
                </td>

                <td>
                    @if($voucher->is_active)
                        <span class="text-green-400">Active</span>
                    @else
                        <span class="text-red-400">Inactive</span>
                    @endif
                </td>

                <td class="text-right p-4 space-x-2">

                    <a href="{{ route('admin.vouchers.edit', $voucher->id) }}"
                       class="px-3 py-2 bg-blue-500/20 text-blue-400 rounded-lg">
                        Edit
                    </a>

                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}"
                          method="POST" class="inline">
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