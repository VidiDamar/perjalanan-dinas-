<x-guest-layout>
    <!-- Logo & Brand Header -->
    <div class="flex flex-col items-center mb-8">
        <div class="flex items-center gap-3.5 mb-5">
            <div class="w-12 h-12 rounded-full border border-sky-200 bg-sky-50 flex items-center justify-center p-2 shadow-xs">
                <svg class="w-full h-full text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m4.93 4.93 4.24 4.24" />
                    <path d="m14.83 9.17 4.24-4.24" />
                    <path d="m14.83 14.83 4.24 4.24" />
                    <path d="m9.17 14.83-4.24 4.24" />
                    <circle cx="12" cy="12" r="4" />
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-2xl text-[#0A2558] tracking-tight leading-tight">Jaya Abadi</span>
                <span class="text-xs text-slate-500 font-medium">Travel Management</span>
            </div>
        </div>

        <p class="text-sm font-semibold text-[#0A2558]">Masuk untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email / Nomor HP -->
        <div>
            <input 
                id="email" 
                type="text" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                placeholder="Email / Nomor Hp"
                class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Kata Sandi -->
        <div>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="current-password"
                placeholder="Kata sandi"
                class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Lupa Kata Sandi Link -->
        <div class="flex justify-end pt-1">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-[#0A2558] hover:underline">
                    Lupa kata sandi
                </a>
            @endif
        </div>

        <!-- Tombol Masuk Solid Navy -->
        <div class="pt-2">
            <button 
                type="submit" 
                class="w-full bg-[#0A2558] hover:bg-[#071d47] text-white font-bold text-base py-3 px-4 rounded-xl shadow-xs transition duration-150 active:scale-[0.99]"
            >
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>
