<x-app-travel-layout>
    <!-- Flash Notifications -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </span>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold text-sm">&times;</button>
        </div>
    @endif

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
    <div class="bg-white rounded-2xl border {{ $activeDelegation ? 'border-emerald-300 bg-emerald-50/30' : 'border-slate-200' }} p-6 shadow-2xs mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl {{ $activeDelegation ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-[#0A2558] border-slate-200' }} border flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
            </div>
            <div>
                @if($activeDelegation)
                    <div class="flex items-center gap-2">
                        <h2 class="text-base font-bold text-slate-900">Status Delegasi Saat Ini: Aktif ke {{ $activeDelegation->delegate->name ?? 'Pejabat Pengganti' }}</h2>
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-0.5">Periode: {{ $activeDelegation->start_date->format('d M Y') }} s/d {{ $activeDelegation->end_date->format('d M Y') }} &bull; Alasan: {{ $activeDelegation->reason }}</p>
                @else
                    <div class="flex items-center gap-2">
                        <h2 class="text-base font-bold text-slate-900">Status Delegasi Saat Ini: Non-Aktif</h2>
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600">Pribadi</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Semua permohonan dinas bawahan langsung masuk ke akun Anda untuk ditinjau secara personal.</p>
                @endif
            </div>
        </div>

        @if($activeDelegation)
            <form action="{{ route('approver.delegation.deactivate', $activeDelegation->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold transition">
                    Nonaktifkan Delegasi Sekarang
                </button>
            </form>
        @else
            <div class="text-xs text-slate-400 font-medium">
                Mode persetujuan langsung aktif
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Pengaturan Delegasi Baru (1 Col) -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
            <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.765z" />
                </svg>
                <span>Aktifkan Delegasi Baru</span>
            </h2>

            <form action="{{ route('approver.delegation.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <!-- Dropdown Pejabat Pengganti -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Pilih Pejabat Pengganti (Acting Approver) <span class="text-rose-500">*</span></label>
                    <select name="delegate_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <option value="">-- Pilih Rekan Manager Setara --</option>
                        @foreach($colleagues as $colleague)
                            <option value="{{ $colleague->id }}">{{ $colleague->name }} ({{ $colleague->department ?? 'Management' }})</option>
                        @endforeach
                    </select>
                    <span class="text-[11px] text-slate-400 mt-1 block">Pejabat yang dipilih wajib memiliki grade jabatan setara atau lebih tinggi.</span>
                </div>

                <!-- Rentang Tanggal -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Mulai <span class="text-rose-500">*</span></label>
                        <input type="date" name="start_date" value="{{ date('Y-m-d') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Selesai <span class="text-rose-500">*</span></label>
                        <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                    </div>
                </div>

                <!-- Alasan Delegasi -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Alasan Pengalihan Wewenang <span class="text-rose-500">*</span></label>
                    <textarea name="reason" rows="3" required placeholder="Contoh: Mengambil Cuti Tahunan / Penugasan Luar Negeri tanpa koneksi." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-2xs transition duration-150">
                        <span>Aktifkan Delegasi Wewenang</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Riwayat Delegasi Sebelumnya (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
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
                        @forelse($delegations as $del)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3.5 px-4 font-bold text-slate-900">
                                    {{ $del->delegate->name ?? 'Pejabat Pengganti' }}
                                    <div class="text-[11px] text-slate-400 font-normal">{{ $del->delegate->department ?? 'Management' }}</div>
                                </td>
                                <td class="py-3.5 px-4 font-medium tabular-nums">{{ $del->start_date->format('d M') }} - {{ $del->end_date->format('d M Y') }}</td>
                                <td class="py-3.5 px-4 text-slate-600">{{ $del->reason }}</td>
                                <td class="py-3.5 px-4 font-bold text-emerald-700 tabular-nums">{{ $del->processed_count }} SPPD Disetujui</td>
                                <td class="py-3.5 px-4">
                                    @if($del->is_active)
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-slate-400">Belum ada riwayat delegasi wewenang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-500 leading-relaxed flex items-start gap-2.5">
                <svg class="w-4 h-4 text-[#0A2558] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                <span>Setiap persetujuan yang dilakukan oleh pejabat pengganti akan tetap dicatat dalam <em>Audit Trail Log</em> dengan label <strong>"Approved by Proxy"</strong> untuk menjaga akuntabilitas tata kelola.</span>
            </div>
        </div>
    </div>
</x-app-travel-layout>
