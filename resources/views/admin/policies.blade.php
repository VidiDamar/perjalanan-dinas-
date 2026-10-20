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
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Travel Policy Engine & Plafon Biaya</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Konfigurasi batasan tarif hotel, uang harian (Per Diem), dan aturan kepatuhan perjalanan dinas PT Jaya Abadi.</p>
        </div>
        <div>
            <button type="button" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                <span>Simpan Perubahan Kebijakan</span>
            </button>
        </div>
    </div>

    <!-- Matriks Plafon Biaya Berdasarkan Level Jabatan -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Matriks Plafon Biaya Dinas Per Level Jabatan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Sistem akan secara otomatis memvalidasi pengajuan karyawan terhadap matriks di bawah ini.</p>
            </div>
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                Otomatis Tervalidasi
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Level Jabatan (Grade)</th>
                        <th class="py-3.5 px-4">Plafon Hotel / Malam</th>
                        <th class="py-3.5 px-4">Uang Saku Harian (Per Diem)</th>
                        <th class="py-3.5 px-4">Kelas Pesawat</th>
                        <th class="py-3.5 px-4">Kelas Kereta Api</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- Grade 1: Staff -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5 font-bold text-slate-900">
                            Staff / Junior Specialist
                            <div class="text-[11px] text-slate-400 font-normal">Grade 1 &bull; Pelaksana Operasional</div>
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-800">Maks Rp 500.000</td>
                        <td class="py-4 px-4 font-bold text-slate-800">Rp 250.000 / Hari</td>
                        <td class="py-4 px-4 text-slate-600">Ekonomi (Non-Fleksi)</td>
                        <td class="py-4 px-4 text-slate-600">Eksekutif</td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800">Edit Plafon</button>
                        </td>
                    </tr>

                    <!-- Grade 2: Senior Specialist -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5 font-bold text-slate-900">
                            Senior Specialist / Officer
                            <div class="text-[11px] text-slate-400 font-normal">Grade 2 &bull; Termasuk Ahmad Pegawai</div>
                        </td>
                        <td class="py-4 px-4 font-bold text-[#0A2558]">Maks Rp 750.000</td>
                        <td class="py-4 px-4 font-bold text-[#0A2558]">Rp 300.000 / Hari</td>
                        <td class="py-4 px-4 text-slate-600">Ekonomi (Garuda / Batik)</td>
                        <td class="py-4 px-4 text-slate-600">Eksekutif</td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800">Edit Plafon</button>
                        </td>
                    </tr>

                    <!-- Grade 3: Manager -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5 font-bold text-slate-900">
                            Manager / Head of Division
                            <div class="text-[11px] text-slate-400 font-normal">Grade 3 &bull; Pejabat Approver (Budi Santoso)</div>
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-800">Maks Rp 1.200.000</td>
                        <td class="py-4 px-4 font-bold text-slate-800">Rp 450.000 / Hari</td>
                        <td class="py-4 px-4 text-slate-600">Ekonomi Fleksi</td>
                        <td class="py-4 px-4 text-slate-600">Eksekutif / Luxury</td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800">Edit Plafon</button>
                        </td>
                    </tr>

                    <!-- Grade 4: Direksi -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5 font-bold text-slate-900">
                            Direksi / C-Level Executives
                            <div class="text-[11px] text-slate-400 font-normal">Grade 4 &bull; Board of Directors</div>
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-800">Maks Rp 2.500.000</td>
                        <td class="py-4 px-4 font-bold text-slate-800">Rp 800.000 / Hari</td>
                        <td class="py-4 px-4 text-slate-600">Bisnis / Eksekutif</td>
                        <td class="py-4 px-4 text-slate-600">Luxury / Compartment</td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800">Edit Plafon</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Aturan Validasi Khusus & Workflow Threshold -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Box 1: Aturan Threshold Approval Direktur -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
            <h3 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                <span>⚡</span>
                <span>Ambang Batas Persetujuan Direktur Utama</span>
            </h3>
            <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                Pengajuan dinas dengan total estimasi melebihi batas ini wajib mendapatkan persetujuan akhir dari Direktur Utama / Board.
            </p>

            <div class="space-y-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nominal Batas Minimum Approval Direktur (Rp)</label>
                    <input type="text" value="Rp 10.000.000" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 font-bold text-[#0A2558]">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Service Level Agreement (SLA) Approval</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 font-medium text-slate-800">
                        <option selected>Maksimal 48 Jam (2 Hari Kerja)</option>
                        <option>Maksimal 24 Jam (Prioritas)</option>
                        <option>Maksimal 72 Jam</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Box 2: Aturan Tindakan Kepatuhan (Policy Enforcement) -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
            <h3 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                <span>🛡️</span>
                <span>Tindakan Sistem Saat Melebihi Plafon</span>
            </h3>
            <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                Pilih perilaku sistem saat karyawan memilih tiket atau hotel di atas tarif batas yang diizinkan.
            </p>

            <div class="space-y-3 text-xs">
                <label class="flex items-start gap-3 p-3 rounded-xl border border-amber-200 bg-amber-50/40 cursor-pointer">
                    <input type="radio" name="policy_action" checked class="w-4 h-4 text-[#0A2558] mt-0.5">
                    <div>
                        <div class="font-bold text-slate-900">Beri Peringatan & Wajibkan Justifikasi Alasan</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Karyawan tetap dapat mengirimkan permohonan, namun wajib menyertakan alasan khusus untuk disetujui atasan.</div>
                    </div>
                </label>

                <label class="flex items-start gap-3 p-3 rounded-xl border border-slate-200 hover:border-slate-300 cursor-pointer">
                    <input type="radio" name="policy_action" class="w-4 h-4 text-[#0A2558] mt-0.5">
                    <div>
                        <div class="font-bold text-slate-900">Blokir Pengajuan (Strict Mode)</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Sistem menolak tombol submit jika ada komponen yang melebihi batas plafon satu rupiah pun.</div>
                    </div>
                </label>
            </div>
        </div>
    </div>
</x-app-travel-layout>
