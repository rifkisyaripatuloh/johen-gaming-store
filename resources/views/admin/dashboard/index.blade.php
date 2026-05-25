@extends('layouts.admin')

@section('content')

<!-- TOPBAR -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-5 mb-10">

    <div>
        <h2 class="text-4xl font-black">Dashboard</h2>
        <p class="text-gray-400 mt-2">Welcome back admin 👋</p>
    </div>

</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

    <div class="bg-[#121212] border border-white/5 rounded-[28px] p-6">
        <p class="text-gray-400 text-sm">Users</p>
        <h3 class="text-4xl font-black mt-3">{{ $totalUsers }}</h3>
    </div>

    <div class="bg-[#121212] border border-white/5 rounded-[28px] p-6">
        <p class="text-gray-400 text-sm">Products</p>
        <h3 class="text-4xl font-black mt-3">{{ $totalProducts }}</h3>
    </div>

    <div class="bg-[#121212] border border-white/5 rounded-[28px] p-6">
        <p class="text-gray-400 text-sm">Orders</p>
        <h3 class="text-4xl font-black mt-3">{{ $totalOrders }}</h3>
    </div>

    <div class="bg-[#121212] border border-white/5 rounded-[28px] p-6">
        <p class="text-gray-400 text-sm">Revenue</p>
        <h3 class="text-4xl font-black mt-3">Rp {{ number_format($totalRevenue) }}</h3>
    </div>

</div>

@endsection