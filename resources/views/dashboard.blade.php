<x-app-travel-layout>
    <!-- Flash Notifications -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[11px]">✓</span>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold text-sm">&times;</button>
        </div>
    @endif

    <!-- Welcome Greeting Header with Quick CTA -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Halo, {{ $user->name ?? 'Ahmad Pegawai' }}</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Pantau agenda dinas, status persetujuan SPPD, dan pertanggungjawaban biaya Anda.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('requests.create') }}" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Ajukan Perjalanan Baru</span>
            </a>
        </div>
    </div>

    <!-- Highlight Card: Perjalanan Terdekat / Agenda Aktif (Real Data) -->
    @if($activeTrip)
        <div class="bg-gradient-to-r from-[#0A2558] to-[#123b87] rounded-2xl p-6 md:p-7 text-white shadow-md mb-8 relative overflow-hidden">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 rounded-full bg-white/5 pointer-events-none"></div>
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            {{ $activeTrip->status_label }}
                        </span>

                        @if($activeTrip->checked_in)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-white/20 text-emerald-200 border border-white/20">
                                ✓ Sudah Check-in di {{ $activeTrip->checkin_location }}
                            </span>
                        @endif
                    </div>

                    <div>
                        <h2 class="text-xl md:text-2xl font-bold tracking-tight text-white flex items-center gap-2.5">
                            <span>{{ $activeTrip->origin_city }}</span>
                            <svg class="w-5 h-5 text-sky-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                            <span>{{ $activeTrip->destination_city }}</span>
                        </h2>
                        <p class="text-sm text-sky-100/90 font-medium mt-1">
                            {{ $activeTrip->purpose }}
                            @if($activeTrip->flight_departure_info)
                                &bull; {{ $activeTrip->flight_departure_info }}
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-xs text-sky-200">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-sky-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                <line x1="16" x2="16" y1="2" y2="6"/>
                                <line x1="8" x2="8" y1="2" y2="6"/>
                                <line x1="3" x2="21" y1="10" y2="10"/>
                            </svg>
                            {{ $activeTrip->start_date->format('d M') }} - {{ $activeTrip->end_date->format('d M Y') }} ({{ $activeTrip->duration_days }} Hari)
                        </span>

                        <span class="inline-flex items-center gap-1.5 font-semibold text-emerald-300">
                            No. SPPD: {{ $activeTrip->request_number }}
                        </span>

                        @if($activeTrip->cash_advance_requested > 0)
                            <span class="inline-flex items-center gap-1 text-sky-100">
                                💰 Kasbon: Rp {{ number_format($activeTrip->cash_advance_requested, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row lg:flex-col gap-2.5 shrink-0">
                    <a href="{{ route('requests.show', $activeTrip->request_number) }}" class="inline-flex items-center justify-center gap-2 bg-white text-[#0A2558] hover:bg-slate-100 font-bold text-xs py-2.5 px-4 rounded-xl transition shadow-xs">
                        <span>Lihat Tiket & Detail Perjalanan</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>

                    @if(! $activeTrip->checked_in && in_array($activeTrip->status, ['approved', 'ticket_issued']))
                        <form action="{{ route('requests.checkin', $activeTrip->request_number) }}" method="POST">
                            @csrf
                            <input type="hidden" name="location" value="{{ $activeTrip->hotel_name ?? $activeTrip->destination_city }}">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs py-2 px-4 rounded-xl transition shadow-xs">
                                <span>📍 Check-in di Lokasi Tujuan</span>
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('settlements.index') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-medium text-xs py-2 px-4 rounded-xl transition border border-white/20">
                        <span>Klaim / Settlement Biaya</span>
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- State jika belum ada perjalanan -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-8 text-center shadow-xs mb-8">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mx-auto mb-3 text-xl">
                ✈️
            </div>
            <h2 class="text-base font-bold text-slate-800">Belum Ada Agenda Perjalanan Aktif</h2>
            <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 mb-4">Mulai perjalanan dinas Anda dengan mengajukan SPPD baru secara online tanpa berkas kertas.</p>
            <a href="{{ route('requests.create') }}" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition">
                <span>Ajukan Perjalanan Dinas Baru</span>
            </a>
        </div>
    @endif

    <!-- 4 Metrics Top Cards Grid (Real Data) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <!-- Card 1: Active Trips -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs flex flex-col justify-between hover:border-sky-300 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total SPPD Saya</span>
                <span class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                    </svg>
                </span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $stats['total_trips'] }}</div>
                <p class="text-xs text-slate-400 font-medium mt-1">Perjalanan terdata di sistem</p>
            </div>
        </div>

        <!-- Card 2: Pending Approvals -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs flex flex-col justify-between hover:border-amber-300 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Menunggu Approval</span>
                <span class="p-2 bg-amber-50 rounded-xl text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-amber-600">{{ $stats['pending_approval'] }}</div>
                <p class="text-xs text-slate-400 font-medium mt-1">Dalam antrean verifikasi atasan</p>
            </div>
        </div>

        <!-- Card 3: Disetujui -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs flex flex-col justify-between hover:border-emerald-300 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Disetujui & Siap</span>
                <span class="p-2 bg-emerald-50 rounded-xl text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-emerald-600">{{ $stats['approved_trips'] }}</div>
                <p class="text-xs text-slate-400 font-medium mt-1">Tiket & kasbon terproses</p>
            </div>
        </div>

        <!-- Card 4: Klaim Settlement -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs flex flex-col justify-between hover:border-indigo-300 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Klaim Settlement</span>
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                    </svg>
                </span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-indigo-600">{{ $stats['settlement_claims'] }}</div>
                <p class="text-xs text-slate-400 font-medium mt-1">Pertanggungjawaban diajukan</p>
            </div>
        </div>
    </div>

    <!-- Real Recent Travel Requests Table -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Riwayat Perjalanan Dinas Terakhir</h2>
                <p class="text-xs text-slate-500 mt-0.5">Daftar pengajuan terkini yang terdaftar pada akun Anda.</p>
            </div>
            <a href="{{ route('requests.index') }}" class="text-xs font-bold text-[#0A2558] hover:underline flex items-center gap-1">
                <span>Lihat Semua SPPD</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-5">No. SPPD & Keperluan</th>
                        <th class="py-3 px-4">Rute Perjalanan</th>
                        <th class="py-3 px-4">Jadwal Tugas</th>
                        <th class="py-3 px-4">Total Biaya</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($recentTrips as $trip)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3.5 px-5">
                                <span class="font-mono font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $trip->request_number }}
                                </span>
                                <div class="font-semibold text-slate-900 mt-1">{{ $trip->purpose }}</div>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-slate-800">
                                {{ $trip->origin_city }} &rarr; {{ $trip->destination_city }}
                                <div class="text-[11px] text-slate-400">{{ $trip->transport_mode }}</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-900">{{ $trip->start_date->format('d M') }} - {{ $trip->end_date->format('d M Y') }}</div>
                                <div class="text-[11px] text-slate-400">{{ $trip->duration_days }} Hari</div>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                Rp {{ number_format($trip->total_estimated_budget, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $trip->status_badge_class }}">
                                    {{ $trip->status_label }}
                                </span>
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <a href="{{ route('requests.show', $trip->request_number) }}" class="inline-flex items-center gap-1 bg-[#0A2558] hover:bg-[#081c42] text-white text-xs font-semibold py-1.5 px-3 rounded-lg shadow-xs transition">
                                    <span>Detail</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">
                                Belum ada riwayat perjalanan dinas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-travel-layout>
