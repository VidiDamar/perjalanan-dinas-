<x-app-travel-layout>
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 border border-sky-200 mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                Travel Desk & Corporate Fulfillment Portal
            </div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Operasional Travel Desk</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Kelola pemesanan tiket pesawat/kereta, reservasi hotel korporat, dan terbitkan e-voucher untuk karyawan.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('travel-admin.vendors') }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-semibold text-sm py-2.5 px-4 rounded-xl shadow-xs transition duration-150">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5" />
                </svg>
                <span>Rekapitulasi Vendor Bulanan</span>
            </a>
        </div>
    </div>

    <!-- 4 KPI Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl border border-sky-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-800">Siap Booking Tiket</span>
                <span class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight">3 <span class="text-sm font-semibold text-sky-600 ml-1">SPPD</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5">Telah disetujui penuh oleh Atasan</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Tiket Terbit Hari Ini</span>
                <span class="p-2 bg-emerald-50 rounded-xl text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight">5 <span class="text-sm font-semibold text-emerald-600 ml-1">E-Tiket</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5">Garuda (3), KAI (2)</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl border border-rose-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-rose-700">Mendesak (H-1 & H-2)</span>
                <span class="p-2 bg-rose-50 rounded-xl text-rose-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight">1 <span class="text-sm font-semibold text-rose-600 ml-1">Perjalanan</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5">Keberangkatan CGK-SUB (Ahmad Pegawai)</p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Booking Bulan Ini</span>
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 tracking-tight mt-1">Rp 48.7 Jt</div>
            <p class="text-xs text-slate-500 font-medium mt-1">16 Transaksi tiket & hotel</p>
        </div>
    </div>

    <!-- Table Antrean Pemrosesan Tiket & Hotel -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-bold text-slate-900">Antrean Penerbitan Tiket & Voucher Hotel</h2>
                <p class="text-xs text-slate-500 mt-0.5">Daftar perjalanan yang telah disetujui pejabat dan siap dipesan melalui portal agen corporate.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200">
                    3 Perlu Diproses
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Pemohon</th>
                        <th class="py-3.5 px-4">No. SPPD & Rute</th>
                        <th class="py-3.5 px-4">Jadwal Tugas</th>
                        <th class="py-3.5 px-4">Kebutuhan Tiket & Hotel</th>
                        <th class="py-3.5 px-4">Status Pemesanan</th>
                        <th class="py-3.5 px-5 text-right">Aksi Travel Desk</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- Row 1: Priority H-2 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-sky-100 text-[#0A2558] font-bold text-xs flex items-center justify-center shrink-0">
                                    AP
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">Ahmad Pegawai</div>
                                    <div class="text-[11px] text-slate-400">NIK: EMP-0921 &bull; KTP & HP Lengkap</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="font-mono font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                TRQ-2023-0891
                            </span>
                            <div class="font-semibold text-slate-800 mt-1">Jakarta (CGK) &rarr; Surabaya (SUB)</div>
                            <div class="text-[11px] text-slate-400">Telah disetujui: Budi Santoso (Head)</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-900">26 Okt - 28 Okt 2023</div>
                            <span class="inline-flex items-center gap-1 text-[10px] font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded border border-rose-200 mt-1">
                                ⚠️ H-2 Berangkat
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                    <span>✈️ Garuda Indonesia (PP)</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-slate-500">
                                    <span>🏨 Hotel Santika Gubeng (2 Malam)</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Belum Dibooking
                            </span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <a href="{{ route('travel-admin.bookings.show', 'TRQ-2023-0891') }}" class="inline-flex items-center gap-1.5 bg-[#0A2558] hover:bg-[#081c42] text-white text-xs font-semibold py-2 px-3.5 rounded-xl shadow-xs transition">
                                <span>Proses Tiket & Voucher</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-purple-100 text-purple-800 font-bold text-xs flex items-center justify-center shrink-0">
                                    RM
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">Rina Melati</div>
                                    <div class="text-[11px] text-slate-400">NIK: EMP-0810 &bull; Network Engineer</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="font-mono font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                TRQ-2023-0870
                            </span>
                            <div class="font-semibold text-slate-800 mt-1">Jakarta (GMR) &rarr; Bandung (BDG)</div>
                            <div class="text-[11px] text-slate-400">Instalasi Server IDC</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-900">30 Okt - 31 Okt 2023</div>
                            <span class="text-[10px] text-slate-500">H-6 Berangkat</span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="space-y-1">
                                <div class="font-medium text-slate-800">🚆 Kereta Whoosh / Argo Parahyangan</div>
                                <div class="text-slate-500">🏨 Ibis Styles Bandung (1 Malam)</div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                Belum Dibooking
                            </span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <a href="{{ route('travel-admin.bookings.show', 'TRQ-2023-0870') }}" class="inline-flex items-center gap-1.5 bg-[#0A2558] hover:bg-[#081c42] text-white text-xs font-semibold py-2 px-3.5 rounded-xl shadow-xs transition">
                                <span>Proses Tiket & Voucher</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-travel-layout>
