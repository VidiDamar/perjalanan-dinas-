<x-app-travel-layout>
    <!-- Top Bar Navigation & Back Link -->
    <div class="mb-6">
        <a href="{{ route('approver.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-[#0A2558] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Dashboard Persetujuan</span>
        </a>
    </div>

    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Delegasi Wewenang Persetujuan</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Alihkan hak persetujuan SPPD bawahan Anda sementara saat sedang cuti atau tugas dinas di luar jangkauan.</p>
        </div>
    </div>

    <!-- Active Status Card / Alert -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-xl shrink-0">
                🛡️
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-base font-bold text-slate-900">Status Delegasi Saat Ini: Non-Aktif</h2>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600">Pribadi</span>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">Semua permohonan dinas bawahan langsung masuk ke akun Anda untuk ditinjau secara personal.</p>
            </div>
        </div>

        <div class="text-xs text-slate-400 font-medium">
            Terakhir digunakan: 10 - 15 Agustus 2023 (Cuti Tahunan)
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Pengaturan Delegasi Baru (1 Col) -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
            <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.765z" />
                </svg>
                <span>Aktifkan Delegasi Baru</span>
            </h2>

            <form class="space-y-4 text-xs">
                <!-- Dropdown Pejabat Pengganti -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Pilih Pejabat Pengganti (Acting Approver) <span class="text-rose-500">*</span></label>
                    <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <option value="">-- Pilih Rekan Manager Setara --</option>
                        <option value="1">Rudi Hermawan (Manager Project Ops)</option>
                        <option value="2">Diana Kartika (Quality Assurance Head)</option>
                        <option value="3">Agus Santoso (Engineering Lead II)</option>
                    </select>
                    <span class="text-[11px] text-slate-400 mt-1 block">Pejabat yang dipilih wajib memiliki grade jabatan setara atau lebih tinggi.</span>
                </div>

                <!-- Rentang Tanggal -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Mulai <span class="text-rose-500">*</span></label>
                        <input type="date" value="2023-11-01" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Selesai <span class="text-rose-500">*</span></label>
                        <input type="date" value="2023-11-08" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                    </div>
                </div>

                <!-- Alasan Delegasi -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Alasan Pengalihan Wewenang <span class="text-rose-500">*</span></label>
                    <textarea rows="3" placeholder="Contoh: Mengambil Cuti Melahirkan / Cuti Ibadah Umrah / Penugasan Luar Negeri tanpa koneksi." class="w-full bg-slate-50/70 border border-slate-200 rounded-xl p-3 text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
                </div>

                <!-- Checkbox Opsi -->
                <div class="pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded text-[#0A2558] focus:ring-sky-500 border-slate-300">
                        <span class="font-medium text-slate-600">Kirim salinan notifikasi via email ke HRD & Pejabat Pengganti</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="button" class="w-full flex items-center justify-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition duration-150">
                        <span>Aktifkan Delegasi Wewenang</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Riwayat Delegasi Sebelumnya (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
            <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Riwayat Delegasi Wewenang Terdahulu</span>
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <th class="py-3 px-4">Pejabat Pengganti</th>
                            <th class="py-3 px-4">Periode Tanggal</th>
                            <th class="py-3 px-4">Keperluan</th>
                            <th class="py-3 px-4">Pengajuan Diproses</th>
                            <th class="py-3 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                Rudi Hermawan
                                <div class="text-[11px] text-slate-400 font-normal">Manager Project Operations</div>
                            </td>
                            <td class="py-3.5 px-4 font-medium">10 Agu - 15 Agu 2023 (6 Hari)</td>
                            <td class="py-3.5 px-4 text-slate-600">Cuti Tahunan</td>
                            <td class="py-3.5 px-4 font-bold text-emerald-700">4 SPPD Disetujui</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Selesai</span>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                Diana Kartika
                                <div class="text-[11px] text-slate-400 font-normal">Head of QA</div>
                            </td>
                            <td class="py-3.5 px-4 font-medium">02 Feb - 07 Feb 2023 (6 Hari)</td>
                            <td class="py-3.5 px-4 text-slate-600">Dinas Luar Negeri (Jepang)</td>
                            <td class="py-3.5 px-4 font-bold text-emerald-700">6 SPPD Disetujui</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Selesai</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200/60 text-xs text-slate-500 leading-relaxed">
                ℹ️ Setiap persetujuan yang dilakukan oleh pejabat pengganti akan tetap dicatat dalam <em>Audit Trail Log</em> dengan label <strong>"Approved by Proxy on Behalf of Budi Santoso"</strong> untuk menjaga akuntabilitas.
            </div>
        </div>
    </div>
</x-app-travel-layout>
