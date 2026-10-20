<x-app-travel-layout>
    <!-- Top Bar Navigation & Back Link -->
    <div class="mb-6">
        <a href="{{ route('finance.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-[#0A2558] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Dashboard Keuangan</span>
        </a>
    </div>

    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Laporan Keuangan & Export Akuntansi</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Unduh rekapitulasi data perjalanan dinas yang telah diselaraskan dengan format kolom software akuntansi (Accurate, SAP, Jurnal) dan Payroll.</p>
        </div>

        <!-- Export Buttons -->
        <div class="flex items-center gap-2">
            <button type="button" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Download Excel (.xlsx)</span>
            </button>
            <button type="button" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-semibold text-xs py-2.5 px-3 rounded-xl transition">
                <span>CSV</span>
            </button>
        </div>
    </div>

    <!-- Filter & Generator Options -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end text-xs">
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Periode Bulan</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option selected>Oktober 2023</option>
                    <option>September 2023</option>
                    <option>Kuartal 3 (Q3 2023)</option>
                    <option>Tahun 2023 Lengkap (YTD)</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Divisi / Cost Center</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option selected>Semua Divisi & Cost Center</option>
                    <option>Engineering (CC-101)</option>
                    <option>Project Operations (CC-102)</option>
                    <option>Marketing & Sales (CC-201)</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Status Transaksi</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option selected>Hanya yang Selesai & Terverifikasi</option>
                    <option>Termasuk Kasbon Berjalan</option>
                </select>
            </div>
            <div>
                <button class="w-full bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold py-2 px-4 rounded-xl shadow-xs transition">
                    Perbarui Pratinjau
                </button>
            </div>
        </div>
    </div>

    <!-- Department Budget Consumption Bar -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs mb-8">
        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">Penyerapan Anggaran Perjalanan Per Divisi (YTD 2023)</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs">
            <!-- IT -->
            <div class="space-y-1.5">
                <div class="flex justify-between font-semibold">
                    <span class="text-slate-800">IT & Infrastructure</span>
                    <span class="text-[#0A2558] font-bold">Rp 142.5 Jt / 180 Jt (79%)</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-sky-600 h-full rounded-full" style="width: 79%"></div>
                </div>
            </div>

            <!-- Operations -->
            <div class="space-y-1.5">
                <div class="flex justify-between font-semibold">
                    <span class="text-slate-800">Project Operations</span>
                    <span class="text-[#0A2558] font-bold">Rp 185.0 Jt / 220 Jt (84%)</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-amber-500 h-full rounded-full" style="width: 84%"></div>
                </div>
            </div>

            <!-- Marketing -->
            <div class="space-y-1.5">
                <div class="flex justify-between font-semibold">
                    <span class="text-slate-800">Marketing & Sales</span>
                    <span class="text-[#0A2558] font-bold">Rp 85.0 Jt / 200 Jt (42%)</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full" style="width: 42%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Format Export Akuntansi -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Pratinjau Data Export Buku Besar (General Ledger Format)</h2>
                <p class="text-xs text-slate-500 mt-0.5">Struktur kolom disesuaikan untuk di-import langsung tanpa manipulasi manual.</p>
            </div>
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                12 Transaksi Terverifikasi
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs font-mono">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[10px] font-bold text-slate-500 uppercase tracking-wider font-sans">
                        <th class="py-3 px-4">Tgl Transaksi</th>
                        <th class="py-3 px-4">No. Jurnal</th>
                        <th class="py-3 px-4">No. SPPD</th>
                        <th class="py-3 px-4">Cost Center</th>
                        <th class="py-3 px-4">Pegawai</th>
                        <th class="py-3 px-4">Tiket (Dr)</th>
                        <th class="py-3 px-4">Hotel (Dr)</th>
                        <th class="py-3 px-4">Per Diem (Dr)</th>
                        <th class="py-3 px-4 font-bold text-slate-900">Total Biaya</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-3 px-4">2023-10-18</td>
                        <td class="py-3 px-4 font-bold text-[#0A2558]">JV-TRV-1021</td>
                        <td class="py-3 px-4">TRQ-2023-0855</td>
                        <td class="py-3 px-4">CC-102</td>
                        <td class="py-3 px-4 font-sans font-medium text-slate-900">Bagus Pratama</td>
                        <td class="py-3 px-4">Rp 750.000</td>
                        <td class="py-3 px-4">Rp 900.000</td>
                        <td class="py-3 px-4">Rp 1.450.000</td>
                        <td class="py-3 px-4 font-bold text-slate-900">Rp 3.100.000</td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-3 px-4">2023-10-15</td>
                        <td class="py-3 px-4 font-bold text-[#0A2558]">JV-TRV-1020</td>
                        <td class="py-3 px-4">TRQ-2023-0820</td>
                        <td class="py-3 px-4">CC-101</td>
                        <td class="py-3 px-4 font-sans font-medium text-slate-900">Ahmad Pegawai</td>
                        <td class="py-3 px-4">Rp 1.850.000</td>
                        <td class="py-3 px-4">Rp 1.200.000</td>
                        <td class="py-3 px-4">Rp 600.000</td>
                        <td class="py-3 px-4 font-bold text-slate-900">Rp 3.650.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-travel-layout>
