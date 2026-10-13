<x-app-travel-layout>
    <!-- Header Title, Subtitle & Action CTA -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Perjalanan Dinas Saya</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Kelola jadwal tugas dinas, pantau status SPPD, dan cetak dokumen perjalanan Anda.</p>
        </div>
        <div>
            <a href="{{ route('requests.create') }}" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Ajukan Perjalanan Baru</span>
            </a>
        </div>
    </div>

    <!-- Filter Card (User-Centric) -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
            <!-- Filter: Status -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Status Pengajuan</label>
                <div class="relative">
                    <select class="w-full appearance-none bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10">
                        <option>Semua Status</option>
                        <option>Disetujui</option>
                        <option>Menunggu Review</option>
                        <option>Perlu Revisi</option>
                        <option>Draf</option>
                        <option>Selesai</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Filter: Date Range -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Periode Waktu</label>
                <div class="relative">
                    <select class="w-full appearance-none bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10">
                        <option>Semua Waktu</option>
                        <option>Bulan Ini</option>
                        <option>3 Bulan Terakhir</option>
                        <option>Tahun 2023</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Filter: Travel Category / Purpose (Replacing Department) -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Jenis Perjalanan</label>
                <div class="relative">
                    <select class="w-full appearance-none bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10">
                        <option>Semua Jenis</option>
                        <option>Kunjungan Klien</option>
                        <option>Workshop & Konferensi</option>
                        <option>Audit & Inspeksi Teknis</option>
                        <option>Dinas Luar Negeri</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Button: Apply Filters -->
            <div>
                <button type="button" class="w-full inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200/80 text-slate-700 font-semibold text-sm py-2.5 px-4 rounded-xl border border-slate-200/80 transition shadow-2xs">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18m-14 5h10m-7 5h4" />
                    </svg>
                    <span>Terapkan Filter</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Table Card Container -->
    <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-xs mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="text-xs text-slate-400 font-medium border-b border-slate-100 bg-white">
                    <tr>
                        <th class="px-6 py-4 font-normal">No. SPPD / Trip ID</th>
                        <th class="px-6 py-4 font-normal">Kota Tujuan</th>
                        <th class="px-6 py-4 font-normal">Tanggal</th>
                        <th class="px-6 py-4 font-normal">Keperluan & Transportasi</th>
                        <th class="px-6 py-4 font-normal">Status</th>
                        <th class="px-6 py-4 font-normal text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- Row 1: TRQ-2023-0891 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-2023-0891</a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-800 font-medium">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Surabaya, ID</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 font-normal">26 Okt - 28 Okt 2023</td>
                        <td class="px-6 py-4 text-slate-600 font-normal">Client Meeting &bull; Garuda Indonesia</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#DCFCE7] text-[#15803D] border border-[#BBF7D0]">
                                Disetujui
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.show') }}" class="inline-flex items-center gap-1 font-semibold text-xs text-[#0A2558] hover:text-sky-700">
                                <span>Tiket & SPPD</span>
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
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-800 font-medium">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Jakarta, ID</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 font-normal">02 Nov - 04 Nov 2023</td>
                        <td class="px-6 py-4 text-slate-600 font-normal">Workshop AI &bull; Kereta Whoosh</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FEF9C3] text-[#A16207] border border-[#FEF08A]">
                                Menunggu Review
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.show') }}" class="inline-flex items-center gap-1.5 font-medium text-xs text-slate-600 hover:text-slate-900">
                                <span>Lacak Status</span>
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 3: TRQ-8891 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8891</a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-800 font-medium">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Kuala Lumpur, MY</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 font-normal">20 Sep - 22 Sep 2023</td>
                        <td class="px-6 py-4 text-slate-600 font-normal">Southeast Tech Conf &bull; Batik Air</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FEE2E2] text-[#B91C1C] border border-[#FECACA]">
                                Perlu Revisi
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.show') }}" class="inline-flex items-center gap-1.5 font-medium text-xs text-slate-600 hover:text-slate-900">
                                <span>Lihat Catatan</span>
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 4: TRQ-2023-139 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-2023-139</a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-800 font-medium">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Bandung, ID</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 font-normal">15 Sep - 18 Sep 2023</td>
                        <td class="px-6 py-4 text-slate-600 font-normal">Setup Server Cabang &bull; Mobil Dinas</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#F1F5F9] text-[#64748B] border border-[#E2E8F0]">
                                Draf
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.create') }}" class="inline-flex items-center gap-1.5 font-semibold text-xs text-[#0A2558] hover:text-sky-700">
                                <span>Lanjutkan Draf</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 5: TRQ-8870 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8870</a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-800 font-medium">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Tokyo, JP</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 font-normal">10 Agu - 16 Agu 2023</td>
                        <td class="px-6 py-4 text-slate-600 font-normal">Annual Summit &bull; All Nippon Airways</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                Selesai
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('requests.show') }}" class="inline-flex items-center gap-1.5 font-medium text-xs text-slate-600 hover:text-slate-900">
                                <span>Lihat SPPD</span>
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-medium">
            <span>Menampilkan 5 dari 5 riwayat perjalanan Budi Santoso</span>
            <div class="flex items-center gap-1.5">
                <button type="button" class="w-7 h-7 rounded-lg border border-slate-200 text-slate-400 hover:text-slate-700 hover:bg-slate-50 flex items-center justify-center transition disabled:opacity-50">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button type="button" class="w-7 h-7 rounded-lg border border-slate-200 text-slate-400 hover:text-slate-700 hover:bg-slate-50 flex items-center justify-center transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Navigation Back to Dashboard -->
    <div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-2xs">
            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Beranda</span>
        </a>
    </div>
</x-app-travel-layout>
