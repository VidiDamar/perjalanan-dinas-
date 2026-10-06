<aside class="w-64 bg-[#F8FAFC] border-r border-slate-200/80 flex flex-col justify-between shrink-0 min-h-screen p-5 select-none">
    <div class="flex flex-col gap-6">
        <!-- Logo & Brand Header -->
        <div class="flex items-center gap-3 px-1 py-1">
            <div class="w-10 h-10 rounded-full border border-sky-200 bg-sky-50 flex items-center justify-center p-1.5 shadow-sm">
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
                <span class="font-bold text-[17px] text-[#0F2851] tracking-tight leading-snug">Jaya Abadi</span>
                <span class="text-[12px] text-slate-500 font-medium leading-none">Travel Management</span>
            </div>
        </div>

        <!-- Action Button -->
        <div>
            <a href="{{ route('requests.create') }}" class="w-full flex items-center justify-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-medium text-sm py-2.5 px-4 rounded-xl shadow-sm transition-all duration-150 active:scale-[0.99]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>New Request</span>
            </a>
        </div>

        <!-- Main Navigation Links -->
        <nav class="flex flex-col gap-1.5 pt-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-lg {{ request()->routeIs('dashboard') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="7" height="9" x="3" y="3" rx="1" />
                    <rect width="7" height="5" x="14" y="3" rx="1" />
                    <rect width="7" height="9" x="14" y="12" rx="1" />
                    <rect width="7" height="5" x="3" y="16" rx="1" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Requests -->
            <a href="{{ route('requests.index') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-lg {{ request()->routeIs('requests.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                <svg class="w-5 h-5 {{ request()->routeIs('requests.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                </svg>
                <span>Requests</span>
            </a>

            <!-- Approvals with Red Badge -->
            <a href="{{ route('approvals.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-lg {{ request()->routeIs('approvals.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5 {{ request()->routeIs('approvals.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 11l3 3L22 4" />
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                    </svg>
                    <span>Approvals</span>
                </div>
                <span class="inline-flex items-center justify-center w-5 h-5 text-[11px] font-bold text-white bg-red-500 rounded-full shadow-2xs">
                    3
                </span>
            </a>

            <!-- Settlements -->
            <a href="{{ route('settlements.index') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-lg {{ request()->routeIs('settlements.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                <svg class="w-5 h-5 {{ request()->routeIs('settlements.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="14" x="2" y="5" rx="2" />
                    <line x1="2" x2="22" y1="10" y2="10" />
                    <circle cx="12" cy="15" r="2" />
                </svg>
                <span>Settlements</span>
            </a>
        </nav>
    </div>

    <!-- Bottom Navigation Links -->
    <div class="flex flex-col gap-1 pt-6 border-t border-slate-200/70">
        <!-- Settings -->
        <a href="{{ route('settings.index') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-lg {{ request()->routeIs('settings.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
            <svg class="w-5 h-5 {{ request()->routeIs('settings.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
            </svg>
            <span>Settings</span>
        </a>

        <!-- Support -->
        <a href="{{ route('support.index') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-lg {{ request()->routeIs('support.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
            <svg class="w-5 h-5 {{ request()->routeIs('support.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                <path d="M12 17h.01" />
            </svg>
            <span>Support</span>
        </a>
    </div>
</aside>
