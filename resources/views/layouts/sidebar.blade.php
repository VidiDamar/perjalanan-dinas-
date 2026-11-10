@php
    $pendingApprovalCount = \App\Models\TravelRequest::where('status', 'pending_approval')->count();
    $readyBookingCount = \App\Models\TravelRequest::where('status', 'approved')->whereNull('pnr_code')->count();
    $pendingCaCount = \App\Models\TravelRequest::whereIn('status', ['approved', 'ticket_issued'])->where('cash_advance_requested', '>', 0)->where('cash_advance_status', '!=', 'disbursed')->count();
    $pendingSettlementCount = \App\Models\Settlement::whereIn('status', ['submitted', 'pending_audit'])->count();
    $activeFieldCount = \App\Models\TravelRequest::where(function ($q) {
        $q->where('checked_in', true)->orWhereNotNull('checkin_at');
    })->count();
@endphp
<aside class="w-64 bg-[#F8FAFC] border-r border-slate-200 flex flex-col justify-between shrink-0 min-h-screen p-5 select-none">
    <div class="flex flex-col gap-5">
        <!-- Logo & Brand Header -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-1 py-1 group">
            <img src="{{ asset('logo_perusahaan.png') }}" alt="Logo PT Jaya Abadi" class="w-12 h-12 object-contain shrink-0 group-hover:scale-105 transition-transform duration-200">
            <div class="flex flex-col">
                <span class="font-bold text-[16px] text-[#0F2851] tracking-tight leading-snug group-hover:text-blue-900 transition-colors">PT Jaya Abadi</span>
                <span class="text-[11px] text-slate-500 font-medium leading-none mt-0.5">Enterprise Travel System</span>
            </div>
        </a>

        @if(request()->is('approver*'))
            <!-- Enterprise Status Summary: Atasan -->
            <div class="bg-[#0A2558] rounded-xl p-3.5 text-white border border-slate-800 shadow-2xs">
                <div class="flex items-center justify-between text-xs font-semibold mb-1">
                    <span class="text-slate-200">Antrean Otorisasi</span>
                    <span class="px-2 py-0.5 rounded-md bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[11px] font-bold tabular-nums">{{ $pendingApprovalCount }} SPPD</span>
                </div>
                <p class="text-[11px] text-slate-300 leading-relaxed">Verifikasi kepatuhan plafon dan rab dinas anggota tim.</p>
            </div>
        @elseif(request()->is('travel-admin*'))
            <!-- Enterprise Status Summary: Admin Travel -->
            <div class="bg-[#0A2558] rounded-xl p-3.5 text-white border border-slate-800 shadow-2xs">
                <div class="flex items-center justify-between text-xs font-semibold mb-1">
                    <span class="text-slate-200">Fulfillment Tiket</span>
                    <span class="px-2 py-0.5 rounded-md bg-sky-500/20 text-sky-300 border border-sky-400/30 text-[11px] font-bold tabular-nums">{{ $readyBookingCount }} Siap</span>
                </div>
                <p class="text-[11px] text-slate-300 leading-relaxed">Penerbitan kode PNR maskapai & voucher hotel korporat.</p>
            </div>
        @elseif(request()->is('finance*'))
            <!-- Enterprise Status Summary: Finance -->
            <div class="bg-[#0A2558] rounded-xl p-3.5 text-white border border-slate-800 shadow-2xs">
                <div class="flex items-center justify-between text-xs font-semibold mb-1">
                    <span class="text-slate-200">Antrean Treasury</span>
                    <span class="px-2 py-0.5 rounded-md bg-amber-500/20 text-amber-300 border border-amber-400/30 text-[11px] font-bold tabular-nums">{{ $pendingCaCount + $pendingSettlementCount }} Tugas</span>
                </div>
                <p class="text-[11px] text-slate-300 leading-relaxed">Pencairan uang muka (CA) & rekonsiliasi nota settlement.</p>
            </div>
        @elseif(request()->is('admin*'))
            <!-- Enterprise Status Summary: Super Admin -->
            <div class="bg-[#0A2558] rounded-xl p-3.5 text-white border border-slate-800 shadow-2xs">
                <div class="flex items-center justify-between text-xs font-semibold mb-1">
                    <span class="text-slate-200">Radar Duty of Care</span>
                    <span class="px-2 py-0.5 rounded-md bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[11px] font-bold tabular-nums">{{ $activeFieldCount }} Aktif</span>
                </div>
                <p class="text-[11px] text-slate-300 leading-relaxed">Kontrol matriks plafon biaya & log audit kepatuhan.</p>
            </div>
        @else
            <!-- Action Button Pegawai -->
            <div>
                <a href="{{ route('requests.create') }}" class="w-full flex items-center justify-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-2xs transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Ajukan Perjalanan</span>
                </a>
            </div>
        @endif

        <!-- Main Navigation Links Based on Module Context -->
        <nav class="flex flex-col gap-1 pt-1">
            @if(request()->is('approver*'))
                <!-- ATASAN / APPROVER NAV -->
                <div class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Menu Approver</div>

                <!-- Dashboard Persetujuan -->
                <a href="{{ route('approver.dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('approver.dashboard') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('approver.dashboard') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    <span>Dashboard Approval</span>
                </a>

                <!-- Antrean SPPD Menunggu -->
                <a href="{{ route('approver.requests') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl {{ request()->routeIs('approver.requests*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 {{ request()->routeIs('approver.requests*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 11l3 3L22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                        <span>Antrean Pengajuan</span>
                    </div>
                    <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-[11px] font-bold text-emerald-800 bg-emerald-100 rounded-full tabular-nums">
                        {{ $pendingApprovalCount }} 
                    </span>
                </a>

                <!-- Delegasi Wewenang -->
                <a href="{{ route('approver.delegation') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('approver.delegation') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('approver.delegation') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <polyline points="16 11 18 13 22 9"/>
                    </svg>
                    <span>Delegasi Wewenang</span>
                </a>

            @elseif(request()->is('travel-admin*'))
                <!-- ADMIN TRAVEL DESK NAV -->
                <div class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Menu Travel Desk</div>

                <!-- Dashboard Fulfillment -->
                <a href="{{ route('travel-admin.dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('travel-admin.dashboard') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('travel-admin.dashboard') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    <span>Dashboard Travel Desk</span>
                </a>

                <!-- Antrean Booking Tiket -->
                <a href="{{ route('travel-admin.bookings') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl {{ request()->routeIs('travel-admin.bookings*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 {{ request()->routeIs('travel-admin.bookings*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                        </svg>
                        <span>Antrean Booking Tiket</span>
                    </div>
                    <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-[11px] font-bold text-sky-800 bg-sky-100 rounded-full tabular-nums">
                        {{ $readyBookingCount }} 
                    </span>
                </a>

                <!-- Rekapitulasi Vendor -->
                <a href="{{ route('travel-admin.vendors') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('travel-admin.vendors') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('travel-admin.vendors') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    <span>Rekap Vendor Mitra</span>
                </a>

            @elseif(request()->is('finance*'))
                <!-- FINANCE NAV -->
                <div class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Menu Keuangan</div>

                <!-- Dashboard Finance -->
                <a href="{{ route('finance.dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('finance.dashboard') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('finance.dashboard') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    <span>Dashboard Keuangan</span>
                </a>

                <!-- Pencairan Uang Muka -->
                <a href="{{ route('finance.cash-advances') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl {{ request()->routeIs('finance.cash-advances') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 {{ request()->routeIs('finance.cash-advances') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="5" rx="2" />
                            <line x1="2" x2="22" y1="10" y2="10" />
                            <circle cx="12" cy="15" r="2" />
                        </svg>
                        <span>Pencairan Uang Muka</span>
                    </div>
                    <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-[11px] font-bold text-amber-800 bg-amber-100 rounded-full tabular-nums">
                        {{ $pendingCaCount }} 
                    </span>
                </a>

                <!-- Verifikasi Settlement -->
                <a href="{{ route('finance.settlements') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl {{ request()->routeIs('finance.settlements*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 {{ request()->routeIs('finance.settlements*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" x2="8" y1="13" y2="13"/>
                            <line x1="16" x2="8" y1="17" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                        <span>Audit Settlement Nota</span>
                    </div>
                    <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-[11px] font-bold text-indigo-800 bg-indigo-100 rounded-full tabular-nums">
                        {{ $pendingSettlementCount }} 
                    </span>
                </a>

                <!-- Laporan Akuntansi -->
                <a href="{{ route('finance.reports') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('finance.reports') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('finance.reports') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" x2="18" y1="20" y2="10"/>
                        <line x1="12" x2="12" y1="20" y2="4"/>
                        <line x1="6" x2="6" y1="20" y2="14"/>
                    </svg>
                    <span>Laporan & Export Data</span>
                </a>

            @elseif(request()->is('admin*'))
                <!-- SUPER ADMIN NAV -->
                <div class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Menu Super Admin</div>

                <!-- Executive Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                        <polyline points="2 17 12 22 22 17"/>
                        <polyline points="2 12 12 17 22 12"/>
                    </svg>
                    <span>Executive & Radar Dinas</span>
                </a>

                <!-- Master Karyawan & Organisasi -->
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.users') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.users') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span>Master Karyawan</span>
                </a>

                <!-- Travel Policy Engine -->
                <a href="{{ route('admin.policies') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.policies') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.policies') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    <span>Kebijakan & Plafon Biaya</span>
                </a>

                <!-- Audit Logs -->
                <a href="{{ route('admin.audit-logs') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.audit-logs') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.audit-logs') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 14 14"/>
                    </svg>
                    <span>Audit Trail Log</span>
                </a>

            @else
                <!-- KARYAWAN / TRAVELER NAV (DEFAULT) -->
                <div class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Menu Utama</div>

                <!-- Beranda -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('dashboard') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    <span>Beranda</span>
                </a>

                <!-- Requests -->
                <a href="{{ route('requests.index') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('requests.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('requests.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                    </svg>
                    <span>Perjalanan Saya</span>
                </a>

                <!-- Approvals with Friendly Badge -->
                <a href="{{ route('approvals.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl {{ request()->routeIs('approvals.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 {{ request()->routeIs('approvals.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 11l3 3L22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                        <span>Status Persetujuan</span>
                    </div>
                    <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-[11px] font-bold text-sky-800 bg-sky-100 rounded-full">
                        1
                    </span>
                </a>

                <!-- Settlements -->
                <a href="{{ route('settlements.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl {{ request()->routeIs('settlements.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 {{ request()->routeIs('settlements.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="5" rx="2" />
                            <line x1="2" x2="22" y1="10" y2="10" />
                            <circle cx="12" cy="15" r="2" />
                        </svg>
                        <span>Klaim & Settlement</span>
                    </div>
                    <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-[11px] font-bold text-amber-800 bg-amber-100 rounded-full">
                        1
                    </span>
                </a>
            @endif
        </nav>
    </div>

    <!-- Bottom Navigation Links -->
    <div class="flex flex-col gap-1 pt-4 border-t border-slate-200/70">
        <!-- Settings -->
        <a href="{{ route('settings.index') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('settings.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
            <svg class="w-5 h-5 {{ request()->routeIs('settings.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
            </svg>
            <span>Profil Pengguna</span>
        </a>

        <!-- Support -->
        <a href="{{ route('support.index') }}" class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('support.*') ? 'text-[#0A2558] font-semibold bg-[#E2E8F0]/70' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium' }} text-[14px] transition-colors">
            <svg class="w-5 h-5 {{ request()->routeIs('support.*') ? 'text-[#0A2558]' : 'text-slate-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                <path d="M12 17h.01" />
            </svg>
            <span>Bantuan & SOP Dinas</span>
        </a>
    </div>
</aside>
