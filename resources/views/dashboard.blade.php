<x-app-travel-layout>
    <!-- Welcome Greeting Header with Quick CTA -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Halo, Budi Santoso</h1>
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

    <!-- Highlight Card: Perjalanan Terdekat / Agenda Aktif -->
    <div class="bg-gradient-to-r from-[#0A2558] to-[#123b87] rounded-2xl p-6 md:p-7 text-white shadow-md mb-8 relative overflow-hidden">
        <!-- Background subtle decorative circle -->
        <div class="absolute -right-12 -bottom-12 w-64 h-64 rounded-full bg-white/5 pointer-events-none"></div>
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Perjalanan Dinas Terdekat &bull; Siap Berangkat
                </div>
                <div>
                    <h2 class="text-xl md:text-2xl font-bold tracking-tight text-white flex items-center gap-2.5">
                        <span>Jakarta (CGK)</span>
                        <svg class="w-5 h-5 text-sky-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                        <span>Surabaya (SUB)</span>
                    </h2>
                    <p class="text-sm text-sky-100/90 font-medium mt-1">Client Meeting &mdash; TechCorp Infra &bull; Garuda Indonesia GA-312</p>
                </div>
                <div class="flex flex-wrap items-center gap-4 text-xs text-sky-200">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-sky-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" x2="16" y1="2" y2="6"/>
                            <line x1="8" x2="8" y1="2" y2="6"/>
                            <line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                        26 Okt - 28 Okt 2023 (3 Hari)
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-sky-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        Boarding: 08:30 WIB
                    </span>
                    <span class="inline-flex items-center gap-1.5 font-semibold text-emerald-300">
                        No. SPPD: TRQ-2023-0891
                    </span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row lg:flex-col gap-2.5 shrink-0">
                <a href="{{ route('requests.show') }}" class="inline-flex items-center justify-center gap-2 bg-white text-[#0A2558] hover:bg-slate-100 font-bold text-xs py-2.5 px-4 rounded-xl transition shadow-xs">
                    <span>Lihat Tiket & Detail Perjalanan</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
                <a href="{{ route('settlements.index') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-medium text-xs py-2 px-4 rounded-xl transition border border-white/20">
                    <span>Klaim / Settlement Biaya</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 3 Metrics Top Cards Grid (Employee Centric) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1: Active Trips -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs flex flex-col justify-between hover:border-sky-300 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#E0F2FE] text-[#0284C7] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                    </svg>
                </div>
                <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100">Siap Jalan</span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-500">Perjalanan Terjadwal</span>
                <div class="text-3xl font-extrabold text-slate-900 mt-1">1</div>
                <p class="text-[11px] text-slate-400 mt-1">Surabaya &bull; 26 Okt 2023</p>
            </div>
        </div>

        <!-- Card 2: Pending Approvals -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs flex flex-col justify-between hover:border-amber-300 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#FEF3C7] text-[#D97706] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-[11px] font-semibold text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-100">Dalam Review</span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-500">Menunggu Persetujuan</span>
                <div class="text-3xl font-extrabold text-slate-900 mt-1">1</div>
                <p class="text-[11px] text-slate-400 mt-1">TRQ-8905 (Jakarta Workshop)</p>
            </div>
        </div>

        <!-- Card 3: Total Budget Used (YTD) -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs flex flex-col justify-between hover:border-emerald-300 transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#16A34A] flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                        <circle cx="12" cy="15" r="2" />
                    </svg>
                </div>
                <span class="text-[11px] font-semibold text-slate-600 bg-slate-100 px-2.5 py-0.5 rounded-full">Tahun 2023</span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-500">Realisasi Plafon Dinas Saya</span>
                <div class="flex items-baseline gap-1.5 mt-1">
                    <span class="text-xl md:text-2xl font-extrabold text-slate-900">Rp 14.500.000</span>
                    <span class="text-[11px] font-medium text-slate-400">/ 40 Jt</span>
                </div>
                <!-- Progress Bar -->
                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-3 overflow-hidden">
                    <div class="bg-[#0A2558] h-1.5 rounded-full" style="width: 36%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Travel Requests Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-xs mb-8">
        <!-- Table Header Title with View All Link -->
        <div class="px-6 py-5 flex items-center justify-between border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900">Perjalanan Dinas Saya Terbaru</h2>
                <p class="text-xs text-slate-400 mt-0.5">Daftar pengajuan dan riwayat tugas dinas yang Anda buat.</p>
            </div>
            <a href="{{ route('requests.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#0A2558] hover:text-sky-700 transition">
                <span>Lihat Semua</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-100 bg-slate-50/40">
                    <tr>
                        <th class="px-6 py-3.5 font-medium">NO. SPPD / TRIP ID</th>
                        <th class="px-6 py-3.5 font-medium">TUJUAN & KEPERLUAN</th>
                        <th class="px-6 py-3.5 font-medium">TANGGAL</th>
                        <th class="px-6 py-3.5 font-medium">STATUS</th>
                        <th class="px-6 py-3.5 font-medium text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- Row 1: TRQ-2023-0891 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-2023-0891</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            Surabaya (Client Meeting - TechCorp)
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-normal">
                            26 Okt - 28 Okt 2023
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#DCFCE7] text-[#15803D] border border-[#BBF7D0]">
                                Disetujui
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.show') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#0A2558] hover:text-sky-700">
                                <span>Lihat Tiket</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 2: TRQ-8905 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8905</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            Jakarta (Workshop Infrastruktur AI)
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-normal">
                            02 Nov - 04 Nov 2023
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FEF9C3] text-[#A16207] border border-[#FEF08A]">
                                Menunggu Review
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.show') }}" class="inline-flex items-center gap-1 text-xs font-medium text-slate-600 hover:text-slate-900">
                                <span>Lacak Status</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 3: TRQ-8891 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8891</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            Kuala Lumpur (Southeast Tech Conf)
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-normal">
                            20 Sep - 22 Sep 2023
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FEE2E2] text-[#B91C1C] border border-[#FECACA]">
                                Perlu Revisi
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.show') }}" class="inline-flex items-center gap-1 text-xs font-medium text-slate-600 hover:text-slate-900">
                                <span>Lihat Catatan</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 4: TRQ-8870 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8870</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            Tokyo (Annual Engineering Summit)
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-normal">
                            10 Agu - 16 Agu 2023
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                Selesai
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.show') }}" class="inline-flex items-center gap-1 text-xs font-medium text-slate-600 hover:text-slate-900">
                                <span>Lihat SPPD</span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Help & Action Banner -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-5 rounded-2xl bg-white border border-slate-200/90 shadow-2xs">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-slate-800">Ada pertanyaan seputar batas biaya hotel atau tiket pesawat?</h3>
                <p class="text-xs text-slate-500">Pelajari aturan SOP perjalanan dinas atau hubungi tim Travel Desk kami.</p>
            </div>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('support.index') }}" class="px-4 py-2 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200/80 rounded-xl transition">
                Buka SOP & FAQ
            </a>
            <a href="{{ route('requests.create') }}" class="px-4 py-2 text-xs font-semibold text-white bg-[#0A2558] hover:bg-[#071d47] rounded-xl shadow-2xs transition">
                + Ajukan SPPD
            </a>
        </div>
    </div>
</x-app-travel-layout>
