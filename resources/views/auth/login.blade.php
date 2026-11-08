<x-guest-layout>
    <!-- Top Brand & Language Bar (Matching Reference Image) -->
    <div class="flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-base sm:text-lg font-black tracking-tight text-slate-900 uppercase hover:text-[#eb4634] transition">
            JAYA ABADI
        </a>

        <!-- Language Selector Pill -->
        <div class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 px-3.5 py-1.5 text-[11px] font-bold text-slate-700 bg-white shadow-2xs select-none">
            <!-- Mini Flag SVG Icon -->
            <svg class="w-4 h-3 rounded-[2px] overflow-hidden shrink-0" viewBox="0 0 24 16" fill="none">
                <rect width="24" height="16" fill="#012169"/>
                <path d="M0 0L24 16M24 0L0 16" stroke="#ffffff" stroke-width="3"/>
                <path d="M0 0L24 16M24 0L0 16" stroke="#C8102E" stroke-width="1.5"/>
                <path d="M12 0V16M0 8H24" stroke="#ffffff" stroke-width="5"/>
                <path d="M12 0V16M0 8H24" stroke="#C8102E" stroke-width="3"/>
            </svg>
            <span>EN</span>
            <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
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
                Hi Traveler
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

            <!-- Forgot Password Link -->
            <div class="flex justify-end pt-0.5">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[11px] font-medium text-[#eb4634] hover:underline">
                        Forgot password ?
                    </a>
                @endif
            </div>

            <!-- Divider: — or — -->
            <div class="flex items-center justify-center gap-3 py-1">
                <span class="w-6 h-px bg-slate-200"></span>
                <span class="text-[11px] font-medium text-slate-400">or</span>
                <span class="w-6 h-px bg-slate-200"></span>
            </div>

            <!-- Secondary Button: Login with Google -->
            <div>
                <button
                    type="button"
                    @click="fillDemo('user@gmail.com')"
                    class="w-full bg-white hover:bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-4 text-xs font-semibold text-slate-700 flex items-center justify-center gap-2 transition cursor-pointer"
                >
                    <span>Login with Google</span>
                    <!-- Authentic 4-Color Google G SVG -->
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.11-6.72-4.96H1.29v3.14C3.26 21.3 7.31 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.24c-.24-.72-.38-1.49-.38-2.24s.14-1.52.38-2.24V6.62H1.29C.47 8.24 0 10.06 0 12s.47 3.76 1.29 5.38l3.99-3.14z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.31 0 3.26 2.7 1.29 6.62l3.99 3.14c.95-2.85 3.6-4.96 6.72-4.96z"/>
                    </svg>
                </button>
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

            <!-- Sign Up Prompt -->
            <div class="text-center pt-1">
                <p class="text-[11px] font-medium text-slate-500">
                    Don't have an account?
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-[#eb4634] font-semibold hover:underline ml-0.5">Sign up</a>
                    @else
                        <a href="{{ url('/') }}" class="text-[#eb4634] font-semibold hover:underline ml-0.5">Sign up</a>
                    @endif
                </p>
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

    <!-- Bottom Social Icons Row (Matching Reference Image) -->
    <div class="flex items-center justify-center gap-5 pt-2">
        <!-- Facebook -->
        <a href="{{ url('/') }}" aria-label="Facebook" class="text-slate-700 hover:text-[#eb4634] transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
            </svg>
        </a>
        <!-- Twitter -->
        <a href="{{ url('/') }}" aria-label="Twitter" class="text-slate-700 hover:text-[#eb4634] transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
            </svg>
        </a>
        <!-- LinkedIn -->
        <a href="{{ url('/') }}" aria-label="LinkedIn" class="text-slate-700 hover:text-[#eb4634] transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
            </svg>
        </a>
        <!-- Instagram -->
        <a href="{{ url('/') }}" aria-label="Instagram" class="text-slate-700 hover:text-[#eb4634] transition">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"/>
            </svg>
        </a>
    </div>
</x-guest-layout>
