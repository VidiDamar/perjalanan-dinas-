<x-app-travel-layout>
    <!-- Top Bar Navigation & Back Link -->
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-[#0A2558] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Dashboard Super Admin</span>
        </a>
    </div>

    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Audit Trail & Log Sistem</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Rekam jejak setiap tindakan persetujuan, penerbitan tiket, pencairan dana, dan modifikasi data untuk akuntabilitas kepatuhan.</p>
        </div>
        <div>
            <button type="button" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Export Log (CSV/Audit)</span>
            </button>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end text-xs">
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Kategori Aktivitas</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option selected>Semua Aktivitas Sistem</option>
                    <option>Persetujuan / Approval SPPD</option>
                    <option>Booking Tiket & Hotel</option>
                    <option>Pencairan Uang Muka Kasir</option>
                    <option>Audit Settlement & Reimbursement</option>
                    <option>Perubahan Master Kebijakan</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Pelaksana / User</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option selected>Semua Pengguna</option>
                    <option>Budi Santoso (Atasan)</option>
                    <option>Siti Rahma (Admin Travel)</option>
                    <option>Hendra Wijaya (Finance)</option>
                    <option>Super Administrator</option>
                </select>
            </div>
            <div>
                <button class="w-full bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold py-2 px-4 rounded-xl shadow-xs transition">
                    Filter Rekaman Log
                </button>
            </div>
        </div>
    </div>

    <!-- Table Audit Trail -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider font-mono">
                        <th class="py-3.5 px-5 font-sans">Waktu & Tanggal</th>
                        <th class="py-3.5 px-4 font-sans">Pengguna (Aktor)</th>
                        <th class="py-3.5 px-4 font-sans">Aksi & Modul</th>
                        <th class="py-3.5 px-4 font-sans">Rincian Perubahan / Transaksi</th>
                        <th class="py-3.5 px-4 font-sans">Alamat IP & Perangkat</th>
                        <th class="py-3.5 px-5 font-sans text-right">Hasil</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- Log 1 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5 font-mono text-[11px] text-slate-500">
                            2023-10-20 14:15:32
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-900">
                            Budi Santoso
                            <div class="text-[10px] text-slate-400 font-normal">Head of Engineering</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                APPROVE_SPPD
                            </span>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-800">
                            Menyetujui SPPD <span class="font-mono font-bold text-[#0A2558]">TRQ-2023-0891</span> (Ahmad Pegawai &bull; Rp 4.750.000)
                        </td>
                        <td class="py-4 px-4 font-mono text-[11px] text-slate-500">
                            192.168.1.45 &bull; Chrome Win64
                        </td>
                        <td class="py-4 px-5 text-right">
                            <span class="text-emerald-600 font-bold">✓ Success</span>
                        </td>
                    </tr>

                    <!-- Log 2 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5 font-mono text-[11px] text-slate-500">
                            2023-10-20 11:40:19
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-900">
                            Siti Rahma
                            <div class="text-[10px] text-slate-400 font-normal">Corporate Travel Desk</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-sky-100 text-sky-800">
                                ISSUE_TICKET
                            </span>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-800">
                            Menerbitkan E-Tiket Garuda GA-312 & Voucher Hotel Santika Gubeng (PNR: GAK78Q)
                        </td>
                        <td class="py-4 px-4 font-mono text-[11px] text-slate-500">
                            192.168.1.18 &bull; Firefox Win64
                        </td>
                        <td class="py-4 px-5 text-right">
                            <span class="text-emerald-600 font-bold">✓ Success</span>
                        </td>
                    </tr>

                    <!-- Log 3 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5 font-mono text-[11px] text-slate-500">
                            2023-10-19 16:05:10
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-900">
                            Hendra Wijaya
                            <div class="text-[10px] text-slate-400 font-normal">Finance Supervisor</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-100 text-indigo-800">
                                DISBURSE_CASH
                            </span>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-800">
                            Pencairan uang muka Rp 900.000 via BCA Transfer Ref: BCA-TXN-902198301
                        </td>
                        <td class="py-4 px-4 font-mono text-[11px] text-slate-500">
                            192.168.1.22 &bull; Edge Win64
                        </td>
                        <td class="py-4 px-5 text-right">
                            <span class="text-emerald-600 font-bold">✓ Success</span>
                        </td>
                    </tr>

                    <!-- Log 4 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5 font-mono text-[11px] text-slate-500">
                            2023-10-18 09:30:00
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-900">
                            Super Administrator
                            <div class="text-[10px] text-slate-400 font-normal">System Admin</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-100 text-purple-800">
                                UPDATE_POLICY
                            </span>
                        </td>
                        <td class="py-4 px-4 font-medium text-slate-800">
                            Penyesuaian batas plafon hotel Grade 2 dari Rp 700.000 menjadi Rp 750.000 / malam
                        </td>
                        <td class="py-4 px-4 font-mono text-[11px] text-slate-500">
                            192.168.1.10 &bull; Chrome Win64
                        </td>
                        <td class="py-4 px-5 text-right">
                            <span class="text-emerald-600 font-bold">✓ Success</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-travel-layout>
