<header class="h-16 bg-white border-b border-slate-200/80 px-8 flex items-center justify-between sticky top-0 z-30">
    <!-- Search Bar (Optional or fallback) -->
    <div class="relative w-80 max-w-md">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
            </svg>
        </span>
        <input 
            type="text" 
            placeholder="Search requests..." 
            class="w-full pl-9 pr-4 py-1.5 text-sm bg-slate-50/60 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder-slate-400 transition"
        />
    </div>

    <!-- Header Actions & Profile -->
    <div class="flex items-center gap-4">
        <!-- Notification -->
        <button type="button" class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-full transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- User Profile Avatar & Name (Heni Supami) -->
        <a href="{{ route('settings.index') }}" class="flex items-center gap-3 pl-2 group">
            <div class="text-right hidden sm:block">
                <div class="font-bold text-slate-800 text-xs group-hover:text-sky-700 transition">Heni Supami</div>
                <div class="text-[11px] text-slate-400 font-medium">Senior Account Exec</div>
            </div>
            <div class="w-9 h-9 rounded-xl overflow-hidden border border-slate-200 bg-slate-200 cursor-pointer shadow-2xs group-hover:ring-2 group-hover:ring-sky-500 transition">
                <img 
                    src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=150" 
                    alt="Heni Supami" 
                    class="w-full h-full object-cover"
                />
            </div>
        </a>
    </div>
</header>
