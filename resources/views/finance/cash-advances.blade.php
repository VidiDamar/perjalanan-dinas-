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
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Pencairan Uang Muka Perjalanan (Cash Advance)</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Verifikasi rekening bank karyawan dan masukkan nomor referensi transfer kasbon dinas.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 rounded-xl text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                Total Menunggu Cair: Rp 1.800.000
            </span>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end text-xs">
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Status Pencairan</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                    <option selected>Menunggu Transfer Kasir (2)</option>
                    <option>Telah Dicairkan (14)</option>
                    <option>Semua Status</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Metode Kasir</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                    <option>Semua Metode</option>
                    <option>Bank BCA Corporate</option>
                    <option>Bank Mandiri Corporate</option>
                    <option>Kas Kecil Tunai (Petty Cash)</option>
                </select>
            </div>
            <div>
                <button class="w-full bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold py-2 px-4 rounded-xl shadow-xs transition">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Table Cash Advance Queue -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Penerima Dana</th>
                        <th class="py-3.5 px-4">No. SPPD & Maksud</th>
                        <th class="py-3.5 px-4">Nominal Disetujui</th>
                        <th class="py-3.5 px-4">Rekening Tujuan</th>
                        <th class="py-3.5 px-4">Status Kasbon</th>
                        <th class="py-3.5 px-5 text-right">Aksi Pencairan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 text-sm">Ahmad Pegawai</div>
                            <div class="text-[11px] text-slate-400">NIK: EMP-0921 &bull; IT Infra</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="font-mono font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                TRQ-2023-0891
                            </span>
                            <div class="font-medium text-slate-800 mt-1">Client Meeting Surabaya (3 Hari)</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-extrabold text-[#0A2558] text-base">Rp 900.000</div>
                            <div class="text-[10px] text-slate-400">Rp 300.000/Hari x 3 Hari</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-mono font-bold text-slate-900">BCA: 8920192831</div>
                            <div class="text-[11px] text-slate-500">Ahmad Pegawai Santoso</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                Siap Ditransfer
                            </span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <button type="button" onclick="document.getElementById('modal-disburse').classList.remove('hidden')" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs py-2 px-3.5 rounded-xl shadow-xs transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <span>Input Bukti Transfer</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Input Bukti Transfer Kasir -->
    <div id="modal-disburse" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
            <div class="flex items-center gap-3 text-emerald-600 mb-3">
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-base">Konfirmasi Pencairan Kasbon</h4>
                    <p class="text-xs text-slate-500">Nominal: <strong>Rp 900.000</strong> ke Ahmad Pegawai</p>
                </div>
            </div>

            <form class="space-y-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Metode Pencairan</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                        <option>BCA Corporate Direct Transfer</option>
                        <option>Mandiri Cash Management</option>
                        <option>Kas Tunai Kantor (Petty Cash)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Referensi Bank / Mutasi <span class="text-rose-500">*</span></label>
                    <input type="text" placeholder="Contoh: BCA-TXN-902198301" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 font-mono font-bold text-slate-800">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Tanggal & Jam Pencairan</label>
                    <input type="datetime-local" value="2023-10-24T14:30" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Lampirkan Bukti Transfer (Opsional)</label>
                    <input type="file" class="w-full text-slate-500 text-xs">
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modal-disburse').classList.add('hidden')" class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 font-semibold transition">
                        Batal
                    </button>
                    <button type="button" onclick="document.getElementById('modal-disburse').classList.add('hidden')" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold shadow-xs transition">
                        Konfirmasi Dana Cair
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-travel-layout>
