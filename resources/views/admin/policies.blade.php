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

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">Tutup</button>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.policies.update') }}">
        @csrf

        <!-- Header Page -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Travel Policy Engine & Plafon Biaya</h1>
                <p class="text-sm text-slate-500 font-medium mt-1">Konfigurasi batasan tarif hotel, uang harian (Per Diem), dan aturan kepatuhan perjalanan dinas PT Jaya Abadi.</p>
            </div>
            <div>
                <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition">
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
                            <th class="py-3.5 px-4">Plafon Hotel / Malam (Rp)</th>
                            <th class="py-3.5 px-4">Uang Saku Harian / Per Diem (Rp)</th>
                            <th class="py-3.5 px-4">Kelas Pesawat</th>
                            <th class="py-3.5 px-4">Kelas Kereta Api</th>
                            <th class="py-3.5 px-5 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($policies ?? [] as $pol)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-4 px-5 font-bold text-slate-900">
                                    {{ $pol->job_level }}
                                    <div class="text-[11px] text-slate-400 font-normal">{{ $pol->grade_code }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-slate-400 font-semibold">Rp</span>
                                        <input type="number" name="policies[{{ $pol->job_level }}][hotel_limit]" value="{{ (int) $pol->hotel_limit }}" class="w-32 bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1.5 font-bold text-[#0A2558] tabular-nums">
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5 tabular-nums">Maks Rp {{ number_format($pol->hotel_limit, 0, ',', '.') }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-slate-400 font-semibold">Rp</span>
                                        <input type="number" name="policies[{{ $pol->job_level }}][per_diem_limit]" value="{{ (int) $pol->per_diem_limit }}" class="w-32 bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1.5 font-bold text-[#0A2558] tabular-nums">
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5 tabular-nums">Rp {{ number_format($pol->per_diem_limit, 0, ',', '.') }} / Hari</div>
                                </td>
                                <td class="py-4 px-4">
                                    <input type="text" name="policies[{{ $pol->job_level }}][flight_class]" value="{{ $pol->flight_class }}" class="w-40 bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1.5 text-slate-700 font-medium">
                                </td>
                                <td class="py-4 px-4">
                                    <input type="text" name="policies[{{ $pol->job_level }}][train_class]" value="{{ $pol->train_class }}" class="w-36 bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1.5 text-slate-700 font-medium">
                                </td>
                                <td class="py-4 px-5 text-right">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700">Aktif</span>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-4 px-5 font-bold text-slate-900">
                                    Senior Specialist
                                    <div class="text-[11px] text-slate-400 font-normal">Grade 2 &bull; Termasuk Ahmad Pegawai</div>
                                </td>
                                <td class="py-4 px-4 font-bold text-[#0A2558] tabular-nums">Maks Rp 750.000</td>
                                <td class="py-4 px-4 font-bold text-[#0A2558] tabular-nums">Rp 300.000 / Hari</td>
                                <td class="py-4 px-4 text-slate-600">Ekonomi (Garuda / Batik)</td>
                                <td class="py-4 px-4 text-slate-600">Eksekutif</td>
                                <td class="py-4 px-5 text-right">
                                    <span class="text-xs font-semibold text-emerald-600">Aktif</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aturan Validasi Khusus & Workflow Threshold -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Box 1: Aturan Threshold Approval Direktur -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <h3 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <span class="p-1.5 rounded-lg bg-amber-50 text-amber-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </span>
                    <span>Ambang Batas Persetujuan Direktur Utama</span>
                </h3>
                <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                    Pengajuan dinas dengan total estimasi melebihi batas ini wajib mendapatkan persetujuan akhir dari Direktur Utama / Board.
                </p>

                <div class="space-y-4 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nominal Batas Minimum Approval Direktur (Rp)</label>
                        <input type="number" name="director_threshold" value="{{ (int) ($firstPolicy->director_threshold ?? 10000000) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 font-bold text-[#0A2558] tabular-nums">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Service Level Agreement (SLA) Approval</label>
                        <select name="sla_hours" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 font-medium text-slate-800">
                            <option value="48" {{ ($firstPolicy->sla_hours ?? 48) == 48 ? 'selected' : '' }}>Maksimal 48 Jam (2 Hari Kerja)</option>
                            <option value="24" {{ ($firstPolicy->sla_hours ?? 48) == 24 ? 'selected' : '' }}>Maksimal 24 Jam (Prioritas)</option>
                            <option value="72" {{ ($firstPolicy->sla_hours ?? 48) == 72 ? 'selected' : '' }}>Maksimal 72 Jam</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Box 2: Aturan Tindakan Kepatuhan (Policy Enforcement) -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <h3 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <span class="p-1.5 rounded-lg bg-sky-50 text-sky-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </span>
                    <span>Tindakan Sistem Saat Melebihi Plafon</span>
                </h3>
                <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                    Pilih perilaku sistem saat karyawan memilih tiket atau hotel di atas tarif batas yang diizinkan.
                </p>

                <div class="space-y-3 text-xs">
                    <label class="flex items-start gap-3 p-3 rounded-xl border {{ ($firstPolicy->enforcement_mode ?? 'warn_justify') === 'warn_justify' ? 'border-amber-200 bg-amber-50/40' : 'border-slate-200' }} cursor-pointer">
                        <input type="radio" name="enforcement_mode" value="warn_justify" {{ ($firstPolicy->enforcement_mode ?? 'warn_justify') === 'warn_justify' ? 'checked' : '' }} class="w-4 h-4 text-[#0A2558] mt-0.5">
                        <div>
                            <div class="font-bold text-slate-900">Beri Peringatan & Wajibkan Justifikasi Alasan</div>
                            <div class="text-[11px] text-slate-500 mt-0.5">Karyawan tetap dapat mengirimkan permohonan, namun wajib menyertakan alasan khusus untuk disetujui atasan.</div>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 p-3 rounded-xl border {{ ($firstPolicy->enforcement_mode ?? 'warn_justify') === 'strict_block' ? 'border-amber-200 bg-amber-50/40' : 'border-slate-200 hover:border-slate-300' }} cursor-pointer">
                        <input type="radio" name="enforcement_mode" value="strict_block" {{ ($firstPolicy->enforcement_mode ?? 'warn_justify') === 'strict_block' ? 'checked' : '' }} class="w-4 h-4 text-[#0A2558] mt-0.5">
                        <div>
                            <div class="font-bold text-slate-900">Blokir Pengajuan (Strict Mode)</div>
                            <div class="text-[11px] text-slate-500 mt-0.5">Sistem menolak tombol submit jika ada komponen yang melebihi batas plafon satu rupiah pun.</div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </form>
</x-app-travel-layout>
