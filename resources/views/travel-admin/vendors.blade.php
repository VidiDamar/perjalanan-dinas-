<x-app-travel-layout>
    <!-- Top Bar Navigation & Back Link -->
    <div class="mb-6">
        <a href="{{ route('travel-admin.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-[#0A2558] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Dashboard Travel Desk</span>
        </a>
    </div>

    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Rekapitulasi Kemitraan Vendor</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Pemantauan volume pemesanan maskapai, kereta, dan hotel rekanan untuk keperluan negosiasi tarif korporasi (Corporate Rate).</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Unduh Rekap Bulanan (Excel/CSV)</span>
            </button>
        </div>
    </div>

    <!-- 3 Highlight Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Belanja Vendor (Tahun 2023)</span>
            <div class="text-2xl font-extrabold text-slate-900 mt-2">Rp 312.450.000</div>
            <p class="text-xs text-slate-500 mt-1">74 Tiket & 52 Malam Hotel</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Penghematan Corporate Rate</span>
            <div class="text-2xl font-extrabold text-emerald-600 mt-2">Rp 42.800.000</div>
            <p class="text-xs text-slate-500 mt-1">Rata-rata diskon korporasi 12.5%</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Vendor Terbanyak Dipakai</span>
            <div class="text-2xl font-extrabold text-[#0A2558] mt-2">Garuda Indonesia</div>
            <p class="text-xs text-slate-500 mt-1">38 Tiket (Rp 148 Jt Volume)</p>
        </div>
    </div>

    <!-- Table Rekap Vendor Mitra -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-bold text-slate-900">Daftar Mitra Vendor & Perjanjian Korporat Aktif</h2>
            <span class="text-xs text-slate-500 font-medium">Periode: Januari - Oktober 2023</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Nama Mitra Vendor</th>
                        <th class="py-3.5 px-4">Kategori Layanan</th>
                        <th class="py-3.5 px-4">Volume Booking</th>
                        <th class="py-3.5 px-4">Total Nilai Transaksi</th>
                        <th class="py-3.5 px-4">Diskon Negosiasi</th>
                        <th class="py-3.5 px-4">Status Kontrak (MOU)</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 text-sm">PT Garuda Indonesia (Persero) Tbk</div>
                            <div class="text-[11px] text-slate-400">Corporate Account ID: GA-CORP-9821</div>
                        </td>
                        <td class="py-4 px-4 font-semibold text-slate-800">✈️ Penerbangan Domestik</td>
                        <td class="py-4 px-4 font-bold text-slate-900">38 Penerbangan</td>
                        <td class="py-4 px-4 font-bold text-[#0A2558]">Rp 148.650.000</td>
                        <td class="py-4 px-4 font-semibold text-emerald-700">10% Off Base Fare</td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Aktif s/d Des 2024
                            </span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800">Detail MOU</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 text-sm">Santika Indonesia Hotels & Resorts</div>
                            <div class="text-[11px] text-slate-400">Jaringan Santika, Amaris & Premiere</div>
                        </td>
                        <td class="py-4 px-4 font-semibold text-slate-800">🏨 Hotel Rekanan Nasional</td>
                        <td class="py-4 px-4 font-bold text-slate-900">28 Room Nights</td>
                        <td class="py-4 px-4 font-bold text-[#0A2558]">Rp 32.400.000</td>
                        <td class="py-4 px-4 font-semibold text-emerald-700">Fixed Corporate Rate</td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Aktif s/d Mar 2024
                            </span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800">Detail MOU</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 text-sm">PT Kereta Api Indonesia (Persero)</div>
                            <div class="text-[11px] text-slate-400">Layanan Eksekutif Jawa & Whoosh</div>
                        </td>
                        <td class="py-4 px-4 font-semibold text-slate-800">🚆 Transportasi Darat</td>
                        <td class="py-4 px-4 font-bold text-slate-900">22 Tiket</td>
                        <td class="py-4 px-4 font-bold text-[#0A2558]">Rp 16.800.000</td>
                        <td class="py-4 px-4 font-semibold text-slate-600">Standard Corporate</td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Aktif s/d Des 2023
                            </span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800">Detail MOU</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-travel-layout>
