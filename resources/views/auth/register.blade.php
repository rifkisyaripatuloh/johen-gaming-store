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
                    <span class="text-orange-500">REGISTER</span>
                </h1>
                <p class="text-gray-400 text-sm mt-2">Buat akun baru</p>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- NAME -->
                <div>
                    <label class="text-sm text-gray-300">Nama</label>
                    <input type="text" name="name"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-orange-500 outline-none"
                        placeholder="Nama lengkap" required>
                </div>


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

                <!-- CONFIRM PASSWORD -->
                <div>
                    <label class="text-sm text-gray-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full mt-2 px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-orange-500 outline-none"
                        placeholder="••••••••" required>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-orange-500 hover:bg-orange-400 transition font-bold shadow-lg shadow-orange-500/30">
                    Register
                </button>
            </form>

            <!-- LINK -->
            <p class="text-center text-gray-400 text-sm mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:underline">
                    Login
                </a>
            </p>

        </div>
    </div>
</div>

@endsection
