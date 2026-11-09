<x-guest-layout>
    <!-- Top Brand & Language Bar (Matching Reference Image) -->
    <div class="flex items-center justify-between">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-base sm:text-lg font-black tracking-tight text-slate-900 uppercase hover:text-[#eb4634] transition">
            <img src="{{ asset('logo_perusahaan.png') }}" alt="Logo" class="w-9 h-9 object-contain">
            <span>JAYA ABADI</span>
        </a>
    </div>

    <!-- Center Login Form Container -->
    <div class="w-full max-w-[330px] mx-auto my-auto py-5" x-data="{
        fillDemo(email) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = 'password123';
        }
    }">
        <!-- Heading & Subtitle -->
        <div class="text-center mb-7">
            <h1 class="text-3xl sm:text-[38px] font-extrabold text-slate-900 tracking-tight leading-tight">
                Hi State official
            </h1>
            <p class="text-xs font-medium text-slate-500 mt-2">
                Welcome to Jaya Abadi CTMS
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-3.5">
            @csrf

            <!-- Email -->
            <div>
                <input
                    id="email"
                    type="text"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="Email"
                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-[#eb4634] focus:border-[#eb4634] transition"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs" />
            </div>

            <!-- Password -->
            <div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Password"
                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-[#eb4634] focus:border-[#eb4634] transition"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs" />
            </div>

            <!-- Divider: — or — -->
            <div class="flex items-center justify-center gap-3 py-1">
            </div>

            <!-- Primary Coral-Red Pill Submit Button -->
            <div class="pt-1.5">
                <button
                    type="submit"
                    class="w-full bg-[#eb4634] hover:bg-[#d63a29] text-white font-semibold text-xs sm:text-sm py-3.5 px-6 rounded-full shadow-[0_10px_22px_-6px_rgba(235,70,52,0.55)] transition duration-150 active:scale-[0.99] cursor-pointer"
                >
                    Login
                </button>
            </div>

            <!-- Quick Demo Role Auto-Fill Bar -->
            <div class="pt-3 mt-2 border-t border-slate-100">
                <div class="text-[10px] font-semibold text-slate-400 text-center uppercase tracking-wider mb-2">
                    Quick Fill Akun Demo (Password: password123)
                </div>
                <div class="flex flex-wrap items-center justify-center gap-1.5">
                    <button type="button" @click="fillDemo('user@gmail.com')" class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-[#eb4634]/10 hover:text-[#eb4634] text-[10px] font-semibold text-slate-600 transition cursor-pointer">
                        Karyawan
                    </button>
                    <button type="button" @click="fillDemo('atasan@gmail.com')" class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-[#eb4634]/10 hover:text-[#eb4634] text-[10px] font-semibold text-slate-600 transition cursor-pointer">
                        Atasan
                    </button>
                    <button type="button" @click="fillDemo('travel@gmail.com')" class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-[#eb4634]/10 hover:text-[#eb4634] text-[10px] font-semibold text-slate-600 transition cursor-pointer">
                        Travel
                    </button>
                    <button type="button" @click="fillDemo('finance@gmail.com')" class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-[#eb4634]/10 hover:text-[#eb4634] text-[10px] font-semibold text-slate-600 transition cursor-pointer">
                        Finance
                    </button>
                    <button type="button" @click="fillDemo('admin@gmail.com')" class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-[#eb4634]/10 hover:text-[#eb4634] text-[10px] font-semibold text-slate-600 transition cursor-pointer">
                        Admin
                    </button>
                </div>
            </div>
        </form>
    </div>

</x-guest-layout>
