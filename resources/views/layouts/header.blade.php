@php
    $currentRole = 'user';
    $roleName = 'Mode Pegawai (Traveler)';
    $roleBadgeClass = 'bg-slate-100 text-slate-700 border-slate-200';
    $pulseColor = 'bg-emerald-500';
    $userName = auth()->check() ? auth()->user()->name : 'Ahmad Pegawai';
    $userTitle = 'Senior Engineer';
    $userInitials = 'AP';

    if (request()->is('approver*')) {
        $currentRole = 'approver';
        $roleName = 'Mode Atasan / Approver';
        $roleBadgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
        $pulseColor = 'bg-emerald-500';
        $userName = auth()->check() && auth()->user()->role === 'atasan' ? auth()->user()->name : 'Budi Santoso';
        $userTitle = 'Division Head';
        $userInitials = 'BS';
    } elseif (request()->is('travel-admin*')) {
        $currentRole = 'travel_admin';
        $roleName = 'Mode Admin Travel Desk';
        $roleBadgeClass = 'bg-sky-50 text-sky-700 border-sky-200';
        $pulseColor = 'bg-sky-500';
        $userName = auth()->check() && auth()->user()->role === 'travel_admin' ? auth()->user()->name : 'Siti Rahma';
        $userTitle = 'Corporate Travel Desk';
        $userInitials = 'SR';
    } elseif (request()->is('finance*')) {
        $currentRole = 'finance';
        $roleName = 'Mode Tim Keuangan';
        $roleBadgeClass = 'bg-indigo-50 text-indigo-700 border-indigo-200';
        $pulseColor = 'bg-indigo-500';
        $userName = auth()->check() && auth()->user()->role === 'finance' ? auth()->user()->name : 'Hendra Wijaya';
        $userTitle = 'Finance & Cashier';
        $userInitials = 'HW';
    } elseif (request()->is('admin*')) {
        $currentRole = 'admin';
        $roleName = 'Mode Super Admin';
        $roleBadgeClass = 'bg-purple-50 text-purple-700 border-purple-200';
        $pulseColor = 'bg-purple-500';
        $userName = auth()->check() && auth()->user()->role === 'admin' ? auth()->user()->name : 'Super Administrator';
        $userTitle = 'System & Policy Admin';
        $userInitials = 'SA';
    }
@endphp

<header class="h-16 bg-white border-b border-slate-200/80 px-8 flex items-center justify-between sticky top-0 z-30">
    <!-- Search Bar -->
    <div class="relative w-80 max-w-md">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
            </svg>
        </span>
        <input 
            type="text" 
            placeholder="Cari nomor SPPD, rute dinas, nota..." 
            class="w-full pl-9 pr-4 py-1.5 text-sm bg-slate-50/60 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder-slate-400 transition"
        />
    </div>

    <!-- Header Actions & Profile -->
    <div class="flex items-center gap-4">
        <!-- Quick Employee Badge -->
        <span class="hidden md:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold border {{ $roleBadgeClass }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $pulseColor }} animate-pulse"></span>
            {{ $roleName }}
        </span>

        <!-- Notification -->
        <button type="button" class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-full transition" title="Notifikasi Sistem">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-sky-500 rounded-full"></span>
        </button>

        <!-- User Profile Avatar & Name -->
        <a href="{{ route('settings.index') }}" class="flex items-center gap-3 pl-2 group">
            <div class="text-right hidden sm:block">
                <div class="font-bold text-slate-800 text-xs group-hover:text-sky-700 transition">{{ $userName }}</div>
                <div class="text-[11px] text-slate-400 font-medium">{{ $userTitle }}</div>
            </div>
            <div class="w-9 h-9 rounded-xl overflow-hidden border border-slate-200 bg-sky-100 text-[#0A2558] flex items-center justify-center font-bold text-xs cursor-pointer shadow-2xs group-hover:ring-2 group-hover:ring-sky-500 transition">
                {{ $userInitials }}
            </div>
        </a>

        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}" class="inline-block ml-1">
            @csrf
            <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition border border-rose-200" title="Keluar Sistem">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <span class="hidden md:inline">Keluar</span>
            </button>
        </form>
    </div>
</header>
