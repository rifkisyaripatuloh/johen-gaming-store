<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JOHEN GAMING</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- VITE -->
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-[#0A0A0A] text-white font-['Inter'] overflow-x-hidden">

    <!-- GLOBAL BACKGROUND -->
    <div class="fixed inset-0 -z-50">

        <!-- MAIN BG -->
        <div class="absolute inset-0 bg-[#0A0A0A]"></div>

        <!-- ORANGE GLOW -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/20 blur-[150px] rounded-full"></div>

        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[150px] rounded-full"></div>

        <!-- GRID -->
        <div
            class="absolute inset-0 opacity-[0.03]"
            style="
                background-image:
                linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
                background-size: 40px 40px;
            "
        ></div>

    </div>

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50">

        <div class="backdrop-blur-xl bg-black/30 border-b border-white/5">

            <div class="max-w-7xl mx-auto px-4">

                <div class="flex items-center justify-between h-20">
<div class="flex items-center gap-3">

    <a href="{{ route('lang.switch', 'id') }}"
       class="px-3 py-1 rounded-lg border border-white/10 hover:border-orange-500">
        ID
    </a>

    <a href="{{ route('lang.switch', 'en') }}"
       class="px-3 py-1 rounded-lg border border-white/10 hover:border-orange-500">
        EN
    </a>

</div>
                    <!-- LOGO -->
                    <a href="/" class="flex flex-col">

                        <h1 class="text-2xl md:text-3xl font-black tracking-widest font-['Orbitron']">

                            <span class="text-white">
                                JOHEN
                            </span>

                            <span class="text-orange-500">
                                GAMING
                            </span>

                        </h1>

                        <span class="text-[10px] tracking-[4px] uppercase text-gray-500">
                            Top Up Marketplace
                        </span>

                    </a>

                    <!-- MENU -->
                    <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold">

                        <a href="/"
                           class="hover:text-orange-400 transition duration-300">
                            Home
                        </a>


                        <a href="/products"
                           class="hover:text-orange-400 transition duration-300">
                            Top Up
                        </a>

                      

                    </nav>

                    <!-- RIGHT -->
                    <div class="flex items-center gap-3">

                        @guest

                            <a href="{{ route('login') }}"
   class="px-5 py-2.5 rounded-2xl border border-white/10 hover:border-orange-500 transition font-semibold text-sm">

    Login

</a>

<a href="{{ route('register') }}"
   class="px-5 py-2.5 rounded-2xl bg-orange-500 hover:bg-orange-400 transition font-semibold text-sm shadow-lg shadow-orange-500/20">

    Register

</a>

                        @endguest

                        @auth

                            <div class="hidden md:flex flex-col text-right">

                                <h4 class="font-semibold text-sm">
                                    {{ auth()->user()->name }}
                                </h4>

                                <p class="text-xs text-gray-400">
                                    {{ auth()->user()->role }}
                                </p>

                            </div>

                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button
                                    class="px-5 py-2.5 rounded-2xl bg-red-500 hover:bg-red-400 transition text-sm font-semibold">

                                    Logout

                                </button>

                            </form>

                        @endauth

                        <!-- MOBILE BUTTON -->
                        <button
                            id="menuButton"
                            class="lg:hidden w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">

                            ☰

                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- MOBILE MENU -->
        <div
            id="mobileMenu"
            class="hidden lg:hidden bg-[#111111]/95 backdrop-blur-xl border-b border-white/5">

            <div class="px-4 py-6 flex flex-col gap-5 text-sm font-medium">

                <a href="/" class="hover:text-orange-400 transition">
                    Home
                </a>


               <a href="{{ route('products.index') }}" class="hover:text-orange-400 transition">
    Top Up
</a>

            </div>

        </div>

    </header>

    <!-- CONTENT -->
    <main>

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer class="border-t border-white/5 mt-20">

        <div class="max-w-7xl mx-auto px-4 py-16">

            <div class="grid md:grid-cols-4 gap-10">

                <!-- BRAND -->
                <div>

                    <h2 class="text-2xl font-black font-['Orbitron']">

                        <span class="text-white">
                            JOHEN
                        </span>

                        <span class="text-orange-500">
                            GAMING
                        </span>

                    </h2>

                    <p class="text-gray-400 mt-5 leading-relaxed text-sm">
                        Trusted gaming marketplace platform for instant top up and digital gaming products.
                    </p>

                </div>

                <!-- MENU -->
                <div>

                    <h3 class="font-bold text-lg mb-5">
                        Navigation
                    </h3>

                    <div class="flex flex-col gap-3 text-sm text-gray-400">

                        <a href="/" class="hover:text-orange-400 transition">
                            Home
                        </a>

                        <a href="/products" class="hover:text-orange-400 transition">
                            Games
                        </a>

                        <a href="/products" class="hover:text-orange-400 transition">
                            Top Up
                        </a>

                    </div>

                </div>

                <!-- PAYMENT -->
                <div>

                    <h3 class="font-bold text-lg mb-5">
                        Payment
                    </h3>

                    <div class="grid grid-cols-2 gap-3 text-sm">

                        <div class="bg-[#151515] rounded-xl py-3 text-center border border-white/5">
                            DANA
                        </div>

                        <div class="bg-[#151515] rounded-xl py-3 text-center border border-white/5">
                            OVO
                        </div>

                        <div class="bg-[#151515] rounded-xl py-3 text-center border border-white/5">
                            QRIS
                        </div>

                        <div class="bg-[#151515] rounded-xl py-3 text-center border border-white/5">
                            BCA
                        </div>

                    </div>

                </div>

                <!-- CONTACT -->
                <div>

                    <h3 class="font-bold text-lg mb-5">
                        Contact
                    </h3>

                    <div class="flex flex-col gap-3 text-sm text-gray-400">

                        <p>
                            support@johengaming.com
                        </p>

                        <p>
                            +62 812 3456 7890
                        </p>

                        <p>
                            Indonesia Gaming Marketplace
                        </p>

                    </div>

                </div>

            </div>

            <!-- COPYRIGHT -->
            <div class="border-t border-white/5 mt-14 pt-8 text-center text-sm text-gray-500">

                © 2026 JOHEN GAMING. All Rights Reserved.

            </div>

        </div>

    </footer>

    <!-- MOBILE MENU SCRIPT -->
    <script>

        const menuButton = document.getElementById('menuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        menuButton.addEventListener('click', () => {

            mobileMenu.classList.toggle('hidden');

        });

    </script>

</body>
</html>