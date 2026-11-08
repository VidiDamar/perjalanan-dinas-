@php
    $currentRole = 'user';
    $roleName = 'Workspace Pegawai';
    $roleBadgeClass = 'bg-slate-100 text-slate-700 border-slate-200';
    $pulseColor = 'bg-emerald-500';
    $userName = auth()->check() ? auth()->user()->name : 'Ahmad Pegawai';
    $userTitle = auth()->check() ? (auth()->user()->job_level ?? 'Staff / Officer') : 'Senior Engineer';
    $userInitials = collect(explode(' ', $userName))->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');

    if (request()->is('approver*')) {
        $currentRole = 'approver';
        $roleName = 'Workspace Atasan';
        $roleBadgeClass = 'bg-emerald-50 text-emerald-800 border-emerald-200';
        $pulseColor = 'bg-emerald-600';
        $userName = auth()->check() && in_array(auth()->user()->role, ['atasan', 'approver', 'admin']) ? auth()->user()->name : 'Budi Santoso';
        $userTitle = auth()->check() && in_array(auth()->user()->role, ['atasan', 'approver', 'admin']) ? (auth()->user()->job_level ?? 'Division Head') : 'Division Head';
        $userInitials = collect(explode(' ', $userName))->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
    } elseif (request()->is('travel-admin*')) {
        $currentRole = 'travel_admin';
        $roleName = 'Workspace Travel Desk';
        $roleBadgeClass = 'bg-sky-50 text-sky-800 border-sky-200';
        $pulseColor = 'bg-sky-600';
        $userName = auth()->check() && in_array(auth()->user()->role, ['travel_admin', 'admin']) ? auth()->user()->name : 'Siti Rahma';
        $userTitle = 'Corporate Travel Desk';
        $userInitials = collect(explode(' ', $userName))->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
    } elseif (request()->is('finance*')) {
        $currentRole = 'finance';
        $roleName = 'Workspace Finance';
        $roleBadgeClass = 'bg-indigo-50 text-indigo-800 border-indigo-200';
        $pulseColor = 'bg-indigo-600';
        $userName = auth()->check() && in_array(auth()->user()->role, ['finance', 'admin']) ? auth()->user()->name : 'Hendra Wijaya';
        $userTitle = 'Finance & Treasury';
        $userInitials = collect(explode(' ', $userName))->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
    } elseif (request()->is('admin*')) {
        $currentRole = 'admin';
        $roleName = 'Workspace Super Admin';
        $roleBadgeClass = 'bg-slate-900 text-white border-slate-800';
        $pulseColor = 'bg-sky-400';
        $userName = auth()->check() && auth()->user()->role === 'admin' ? auth()->user()->name : 'Super Administrator';
        $userTitle = 'System & Policy Governance';
        $userInitials = 'SA';
    }
@endphp

<header class="h-16 bg-white border-b border-slate-200 px-6 md:px-8 flex items-center justify-between sticky top-0 z-30">
    <!-- Left: Functional Global Search -->
    <form action="{{ route('requests.index') }}" method="GET" class="relative w-72 md:w-80">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
            </svg>
        </span>
        <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari No. SPPD, kota tujuan, keperluan..." 
            class="w-full pl-9 pr-4 py-1.5 text-xs md:text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#0A2558] focus:border-[#0A2558] placeholder-slate-400 transition"
        />
    </form>

    <!-- Right: Enterprise Workspace Switcher & User Actions -->
    <div class="flex items-center gap-3">
        <!-- Contextual Portal Switcher (Visible in Demo or Super Admin mode) -->
        @if(!auth()->check() || auth()->user()->role === 'admin')
            <div class="hidden xl:flex items-center bg-slate-100 p-1 rounded-lg border border-slate-200 text-[11px] font-semibold">
                <a href="{{ route('dashboard') }}" class="px-2.5 py-1 rounded-md transition {{ $currentRole === 'user' ? 'bg-white text-[#0A2558] shadow-2xs font-bold' : 'text-slate-600 hover:text-slate-900' }}">Pegawai</a>
                <a href="{{ route('approver.dashboard') }}" class="px-2.5 py-1 rounded-md transition {{ $currentRole === 'approver' ? 'bg-white text-[#0A2558] shadow-2xs font-bold' : 'text-slate-600 hover:text-slate-900' }}">Atasan</a>
                <a href="{{ route('travel-admin.dashboard') }}" class="px-2.5 py-1 rounded-md transition {{ $currentRole === 'travel_admin' ? 'bg-white text-[#0A2558] shadow-2xs font-bold' : 'text-slate-600 hover:text-slate-900' }}">Travel Desk</a>
                <a href="{{ route('finance.dashboard') }}" class="px-2.5 py-1 rounded-md transition {{ $currentRole === 'finance' ? 'bg-white text-[#0A2558] shadow-2xs font-bold' : 'text-slate-600 hover:text-slate-900' }}">Finance</a>
                <a href="{{ route('admin.dashboard') }}" class="px-2.5 py-1 rounded-md transition {{ $currentRole === 'admin' ? 'bg-white text-[#0A2558] shadow-2xs font-bold' : 'text-slate-600 hover:text-slate-900' }}">Admin</a>
            </div>
        @endif

        <!-- Active Workspace Badge -->
        <span class="hidden md:inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[11px] font-semibold border {{ $roleBadgeClass }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $pulseColor }}"></span>
            {{ $roleName }}
        </span>

        <!-- User Profile Avatar & Name -->
        <a href="{{ route('settings.index') }}" class="flex items-center gap-2.5 pl-2 border-l border-slate-200 group">
            <div class="text-right hidden sm:block">
                <div class="font-bold text-slate-800 text-xs group-hover:text-[#0A2558] transition leading-tight">{{ $userName }}</div>
                <div class="text-[11px] text-slate-500 font-medium leading-tight mt-0.5">{{ $userTitle }}</div>
            </div>
            <div class="w-8 h-8 rounded-lg border border-slate-200 bg-[#0A2558] text-white flex items-center justify-center font-bold text-xs cursor-pointer shadow-2xs group-hover:ring-2 group-hover:ring-slate-300 transition">
                {{ $userInitials }}
            </div>
        </a>

        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}" class="inline-block">
            @csrf
            <button type="submit" class="flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-semibold text-slate-600 hover:text-rose-700 bg-slate-50 hover:bg-rose-50 rounded-lg transition border border-slate-200 hover:border-rose-200" title="Keluar Sistem">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <span class="hidden md:inline">Keluar</span>
            </button>
        </form>
    </div>
</header>
