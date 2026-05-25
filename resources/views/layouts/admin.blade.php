<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0B0B0F] text-white overflow-hidden">

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-orange-500/10 blur-[120px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-orange-600/10 blur-[120px] rounded-full"></div>

    <div class="relative flex">

        <!-- SIDEBAR -->
<aside class="w-[280px] min-h-screen border-r border-white/5 bg-[#121212]/80 backdrop-blur-xl p-6 hidden lg:block">

    <!-- LOGO -->
    <h1 class="text-3xl font-black tracking-widest mb-10">
        <span class="text-white">JOHEN</span>
        <span class="text-orange-500">ADMIN</span>
    </h1>

    <nav class="space-y-3">

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-4 px-5 py-4 rounded-2xl
           {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 text-white font-semibold' : 'hover:bg-white/5 text-gray-300' }}">
            📊 Dashboard
        </a>

        <!-- PRODUCTS -->
        <a href="{{ route('admin.products.index') }}"
           class="flex items-center gap-4 px-5 py-4 rounded-2xl
           {{ request()->routeIs('admin.products.*') ? 'bg-orange-500 text-white font-semibold' : 'hover:bg-white/5 text-gray-300' }}">
            🎮 Products
        </a>

        <!-- CATEGORIES -->
        <a href="{{ route('admin.categories.index') }}"
           class="flex items-center gap-4 px-5 py-4 rounded-2xl
           {{ request()->routeIs('admin.categories.*') ? 'bg-orange-500 text-white font-semibold' : 'hover:bg-white/5 text-gray-300' }}">
            🗂️ Categories
        </a>

        <!-- ORDERS -->
        <a href="{{ route('admin.orders.index') }}"
           class="flex items-center gap-4 px-5 py-4 rounded-2xl
           {{ request()->routeIs('admin.orders.*') ? 'bg-orange-500 text-white font-semibold' : 'hover:bg-white/5 text-gray-300' }}">
            🛒 Orders
        </a>

        <!-- VOUCHERS -->
        <a href="{{ route('admin.vouchers.index') }}"
           class="flex items-center gap-4 px-5 py-4 rounded-2xl
           {{ request()->routeIs('admin.vouchers.*') ? 'bg-orange-500 text-white font-semibold' : 'hover:bg-white/5 text-gray-300' }}">
            🎁 Vouchers
        </a>

        <!-- USERS (optional tapi bagus untuk admin system) -->
        <a href="#"
           class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-white/5 text-gray-300">
            👥 Users
        </a>

        <!-- SETTINGS -->
        <a href="#"
           class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-white/5 text-gray-300">
            ⚙️ Settings
        </a>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}" class="mt-10">
            @csrf
            <button class="w-full text-left px-5 py-4 rounded-2xl hover:bg-red-500/20 text-red-400">
                🚪 Logout
            </button>
        </form>

    </nav>

</aside>

        <!-- MAIN -->
        <main class="flex-1 p-6 md:p-10">

            @yield('content')

        </main>

    </div>

</body>
</html>