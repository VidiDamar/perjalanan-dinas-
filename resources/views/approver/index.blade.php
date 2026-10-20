<x-app-travel-layout>
    <!-- Header Page with Context Badges -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Portal Persetujuan Pejabat Berwenang
            </div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Persetujuan Perjalanan Dinas</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Tinjau urgensi tugas, kesesuaian anggaran, dan berikan persetujuan SPPD bawahan Anda.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('approver.delegation') }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-semibold text-sm py-2.5 px-4 rounded-xl shadow-xs transition duration-150">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <polyline points="16 11 18 13 22 9"/>
                </svg>
                <span>Atur Delegasi Wewenang</span>
            </a>
        </div>
    </div>

    <!-- 4 KPI Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1: Menunggu Tindakan -->
        <div class="bg-white rounded-2xl border border-amber-200/90 p-5 shadow-xs relative overflow-hidden">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Perlu Tindakan Segera</span>
                <span class="p-2 bg-amber-50 rounded-xl text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight">2 <span class="text-sm font-semibold text-amber-600 ml-1">SPPD</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                <span>1 pengajuan berangkat H-2</span>
            </p>
        </div>

        <!-- Card 2: Disetujui Bulan Ini -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Disetujui Bulan Ini</span>
                <span class="p-2 bg-emerald-50 rounded-xl text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight">8 <span class="text-sm font-semibold text-emerald-600 ml-1">SPPD</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5">Total komitmen Rp 34.250.000</p>
        </div>

        <!-- Card 3: Permintaan Revisi -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Dalam Revisi Pemohon</span>
                <span class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight">1 <span class="text-sm font-semibold text-sky-600 ml-1">SPPD</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5">Penyesuaian tiket & hotel dinas</p>
        </div>

        <!-- Card 4: Status Delegasi -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Status Delegasi Wewenang</span>
                <span class="p-2 bg-slate-100 rounded-xl text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </span>
            </div>
            <div class="text-lg font-bold text-slate-700 tracking-tight mt-1">Non-Aktif</div>
            <p class="text-xs text-slate-500 font-medium mt-1">Anda menangani approval secara langsung</p>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
            <!-- Filter Status -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Status Pengajuan</label>
                <div class="relative">
                    <select class="w-full appearance-none bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10">
                        <option>Semua Status</option>
                        <option selected>Menunggu Persetujuan Anda (2)</option>
                        <option>Perlu Revisi (1)</option>
                        <option>Disetujui (8)</option>
                        <option>Ditolak (0)</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Filter Departemen -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Divisi / Departemen</label>
                <div class="relative">
                    <select class="w-full appearance-none bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10">
                        <option>Semua Divisi Binaan</option>
                        <option>Engineering & IT</option>
                        <option>Project Operations</option>
                        <option>Quality Assurance</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Filter Prioritas / Urgensi -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Urgensi Keberangkatan</label>
                <div class="relative">
                    <select class="w-full appearance-none bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10">
                        <option>Semua Jadwal</option>
                        <option>Mendesak (< 48 Jam)</option>
                        <option>Minggu Ini</option>
                        <option>Bulan Ini</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Search Action -->
            <div>
                <button class="w-full flex items-center justify-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-xs transition duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <span>Terapkan Filter</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Table: Antrean Pengajuan SPPD Menunggu Tindakan -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Daftar Pengajuan Menunggu Tinjauan Anda</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pengajuan di bawah memerlukan persetujuan Manager sebelum diteruskan ke Travel Desk & Keuangan.</p>
            </div>
            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                2 Antrean Aktif
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Pemohon</th>
                        <th class="py-3.5 px-4">No. SPPD & Keperluan</th>
                        <th class="py-3.5 px-4">Rute & Jadwal</th>
                        <th class="py-3.5 px-4">Total Biaya & Kebijakan</th>
                        <th class="py-3.5 px-4">Tenggat Waktu</th>
                        <th class="py-3.5 px-5 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    <!-- Row 1: TRQ-2023-0891 (Mendesak) -->
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-sky-100 text-[#0A2558] font-bold text-xs flex items-center justify-center shrink-0">
                                    AP
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900">Ahmad Pegawai</div>
                                    <div class="text-xs text-slate-400">NIK: EMP-0921 &bull; Senior Engineer</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-block font-mono text-xs font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                TRQ-2023-0891
                            </span>
                            <div class="font-semibold text-slate-800 text-xs mt-1">Client Meeting &bull; TechCorp Infra</div>
                            <div class="text-[11px] text-slate-400">Surat Tugas terlampir (PDF)</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-900 flex items-center gap-1.5">
                                <span>Jakarta (CGK)</span>
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                                <span>Surabaya (SUB)</span>
                            </div>
                            <div class="text-xs text-slate-500 mt-0.5">26 Okt - 28 Okt 2023 (3 Hari)</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-900">Rp 4.750.000</div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 mt-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                In-Policy (Sesuai Plafon)
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                H-2 Berangkat
                            </span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('approver.requests.show', 'TRQ-2023-0891') }}" class="inline-flex items-center gap-1 bg-[#0A2558] hover:bg-[#081c42] text-white text-xs font-semibold py-1.5 px-3 rounded-lg shadow-xs transition">
                                    <span>Tinjau</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: TRQ-2023-0902 (Out of policy warning) -->
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 font-bold text-xs flex items-center justify-center shrink-0">
                                    DS
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900">Dimas Setiawan</div>
                                    <div class="text-xs text-slate-400">NIK: EMP-1044 &bull; Junior Developer</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-block font-mono text-xs font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                TRQ-2023-0902
                            </span>
                            <div class="font-semibold text-slate-800 text-xs mt-1">Workshop Cloud Architect</div>
                            <div class="text-[11px] text-slate-400">Undangan Partner AWS</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-900 flex items-center gap-1.5">
                                <span>Jakarta (CGK)</span>
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                                <span>Bali (DPS)</span>
                            </div>
                            <div class="text-xs text-slate-500 mt-0.5">02 Nov - 05 Nov 2023 (4 Hari)</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-900">Rp 6.850.000</div>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200 mt-1" title="Hotel yang diajukan di atas standar plafon junior">
                                <svg class="w-3 h-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Tarif Hotel &gt; Plafon
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                H-8 Berangkat
                            </span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('approver.requests.show', 'TRQ-2023-0902') }}" class="inline-flex items-center gap-1 bg-[#0A2558] hover:bg-[#081c42] text-white text-xs font-semibold py-1.5 px-3 rounded-lg shadow-xs transition">
                                    <span>Tinjau</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Riwayat Persetujuan Terakhir -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-6">
        <h3 class="text-sm font-bold text-slate-900 mb-4">Riwayat Persetujuan Terakhir oleh Anda</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-200/70 text-xs">
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="font-mono font-bold text-slate-800">TRQ-2023-0870</span>
                    <span class="font-medium text-slate-700">Rina Melati &bull; Instalasi Server Bandung</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-bold text-slate-800">Rp 2.900.000</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Disetujui</span>
                    <span class="text-slate-400">18 Okt 2023</span>
                </div>
            </div>

            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-200/70 text-xs">
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                    <span class="font-mono font-bold text-slate-800">TRQ-2023-0855</span>
                    <span class="font-medium text-slate-700">Bagus Pratama &bull; Training K3 Semarang</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-bold text-slate-800">Rp 3.100.000</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-sky-100 text-sky-800">Minta Revisi Hotel</span>
                    <span class="text-slate-400">15 Okt 2023</span>
                </div>
            </div>
        </div>
    </div>
</x-app-travel-layout>
