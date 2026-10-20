<!-- Floating Role Switcher for Seamless Multi-Role Testing -->
<div class="fixed bottom-5 right-5 z-50 select-none">
    <div class="bg-white/95 backdrop-blur-md border border-slate-300 shadow-xl rounded-2xl p-2 px-3 flex items-center gap-2">
        <div class="flex items-center gap-1.5 pr-2 border-r border-slate-200">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Role Preview:</span>
        </div>
        
        <div class="flex items-center gap-1">
            <!-- Karyawan / Traveler -->
            <a href="{{ route('switch-role', 'user') }}" 
               class="px-2.5 py-1 rounded-lg text-xs font-semibold transition {{ request()->is('dashboard', 'requests*', 'settlements*', 'approvals*') && !request()->is('approver*') ? 'bg-[#0A2558] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
               title="Masuk sebagai Karyawan (Traveler)">
                👤 Karyawan
            </a>

            <!-- Atasan / Approver -->
            <a href="{{ route('switch-role', 'atasan') }}" 
               class="px-2.5 py-1 rounded-lg text-xs font-semibold transition {{ request()->is('approver*') ? 'bg-[#0A2558] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
               title="Masuk sebagai Atasan (Approver)">
                👔 Atasan
            </a>

            <!-- Admin Travel Desk -->
            <a href="{{ route('switch-role', 'travel_admin') }}" 
               class="px-2.5 py-1 rounded-lg text-xs font-semibold transition {{ request()->is('travel-admin*') ? 'bg-[#0A2558] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
               title="Masuk sebagai Admin Travel Desk">
                ✈️ Admin Travel
            </a>

            <!-- Tim Keuangan -->
            <a href="{{ route('switch-role', 'finance') }}" 
               class="px-2.5 py-1 rounded-lg text-xs font-semibold transition {{ request()->is('finance*') ? 'bg-[#0A2558] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
               title="Masuk sebagai Tim Keuangan">
                💰 Keuangan
            </a>

            <!-- Super Admin -->
            <a href="{{ route('switch-role', 'admin') }}" 
               class="px-2.5 py-1 rounded-lg text-xs font-semibold transition {{ request()->is('admin*') ? 'bg-[#0A2558] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}"
               title="Masuk sebagai Super Administrator">
                🛡️ Super Admin
            </a>
        </div>
    </div>
</div>
