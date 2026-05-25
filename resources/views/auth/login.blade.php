@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#0A0A0A] text-white flex items-center justify-center relative overflow-hidden">

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-orange-500/20 blur-[150px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-600/10 blur-[150px] rounded-full"></div>

    <div class="w-full max-w-md relative z-10">

        <div class="bg-black/40 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-xl">

            <!-- TITLE -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-black">
                    <span class="text-white">JOHEN</span>
                    <span class="text-orange-500">LOGIN</span>
                </h1>
                <p class="text-gray-400 text-sm mt-2">Masuk ke akun kamu</p>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-sm text-gray-300">Email</label>
                    <input type="email" name="email"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-orange-500 outline-none"
                        placeholder="you@email.com" required>
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm text-gray-300">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-orange-500 outline-none"
                        placeholder="••••••••" required>
                </div>

                <!-- REMEMBER -->
                <div class="flex items-center justify-between text-sm text-gray-400">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="accent-orange-500">
                        Remember me
                    </label>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-orange-500 hover:bg-orange-400 transition font-bold shadow-lg shadow-orange-500/30">
                    Login
                </button>
            </form>

            <!-- LINK -->
            <p class="text-center text-gray-400 text-sm mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-orange-500 font-semibold hover:underline">
                    Daftar
                </a>
            </p>

        </div>
    </div>
</div>

@endsection