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

    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200 mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                Divisi Keuangan & Kasir Korporat
            </div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Manajemen Kasbon & Pertanggungjawaban Keuangan</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Kelola pencairan uang muka dinas (Cash Advance), verifikasi bukti kuitansi riil, dan rekonsiliasi selisih dana.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('finance.reports.export') }}" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-2xs transition duration-150">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Export Laporan Akuntansi (Excel/CSV)</span>
            </a>
        </div>
    </div>

    <!-- 4 KPI Metrics Finance -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1: Kasbon Menunggu Cair -->
        <div class="bg-white rounded-2xl border border-amber-200 p-5 shadow-2xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Uang Muka Menunggu Cair</span>
                <span class="p-2 bg-amber-50 rounded-xl text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 tracking-tight tabular-nums">Rp {{ number_format($stats['pending_ca_amount'], 0, ',', '.') }}</div>
            <p class="text-xs text-amber-700 font-medium mt-1.5 flex items-center gap-1.5 tabular-nums">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                <span>{{ $stats['pending_ca_count'] }} SPPD (Siap transfer bank)</span>
            </p>
        </div>

        <!-- Card 2: Klaim Settlement Menunggu Verifikasi -->
        <div class="bg-white rounded-2xl border border-indigo-200 p-5 shadow-2xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-700">Klaim Settlement Masuk</span>
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 tracking-tight tabular-nums">Rp {{ number_format($stats['pending_settlement_amount'], 0, ',', '.') }}</div>
            <p class="text-xs text-indigo-600 font-medium mt-1.5 tabular-nums">{{ $stats['pending_settlement_count'] }} Pengajuan perlu audit nota fisik</p>
        </div>

        <!-- Card 3: Outstanding Cash Advance -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-2xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Kasbon Belum Selesai</span>
                <span class="p-2 bg-slate-100 rounded-xl text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 tracking-tight tabular-nums">Rp {{ number_format($stats['outstanding_ca_amount'], 0, ',', '.') }}</div>
            <p class="text-xs text-slate-500 font-medium mt-1.5">Dana kasbon dalam perjalanan</p>
        </div>

        <!-- Card 4: Realisasi Anggaran YTD -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-2xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Anggaran Disetujui</span>
                <span class="p-2 bg-emerald-50 rounded-xl text-emerald-600 font-bold text-xs">
                    YTD
                </span>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 tracking-tight tabular-nums">Rp {{ number_format($stats['ytd_budget'], 0, ',', '.') }}</div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full mt-2 overflow-hidden">
                <div class="bg-emerald-500 h-full rounded-full" style="width: 68.7%"></div>
            </div>
        </div>
    </div>

    <!-- Quick Navigation Tabs for Finance -->
    <div class="flex flex-wrap items-center gap-3 mb-6 border-b border-slate-200 pb-2">
        <a href="{{ route('finance.cash-advances') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#0A2558] text-white shadow-2xs">
            Pencairan Kasbon Uang Muka ({{ $stats['pending_ca_count'] }})
        </a>
        <a href="{{ route('finance.settlements') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
            Audit Settlement & Reimbursement ({{ $stats['pending_settlement_count'] }})
        </a>
        <a href="{{ route('finance.reports') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
            Laporan Anggaran Departemen
        </a>
    </div>

    <!-- Table: Antrean Uang Muka Siap Dicairkan -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden mb-8">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Uang Muka Dinas Siap Dicairkan (Disbursement Queue)</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pengajuan telah disetujui atasan; Kasir silakan transfer ke rekening dinas karyawan.</p>
            </div>
            <a href="{{ route('finance.cash-advances') }}" class="text-xs font-bold text-sky-600 hover:text-sky-800">Lihat Semua Kasbon &rarr;</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Penerima Uang Muka</th>
                        <th class="py-3.5 px-4">No. SPPD & Rute</th>
                        <th class="py-3.5 px-4">Jadwal Berangkat</th>
                        <th class="py-3.5 px-4">Nominal Uang Muka</th>
                        <th class="py-3.5 px-4">Rekening Bank Karyawan</th>
                        <th class="py-3.5 px-5 text-right">Aksi Kasir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($pendingDisbursements as $trip)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-5">
                                <div class="font-bold text-slate-900 text-sm">{{ $trip->user->name ?? 'Karyawan' }}</div>
                                <div class="text-[11px] text-slate-400">{{ $trip->user->job_level ?? 'Staff' }} &bull; {{ $trip->user->department ?? '-' }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-mono font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $trip->request_number }}
                                </span>
                                <div class="font-medium text-slate-800 mt-1">{{ $trip->origin ?: 'Jakarta' }} &rarr; {{ $trip->destination }} ({{ $trip->purpose }})</div>
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-900 tabular-nums">
                                {{ $trip->start_date->format('d M Y') }}
                            </td>
                            <td class="py-4 px-4 tabular-nums">
                                <div class="font-extrabold text-[#0A2558] text-sm">Rp {{ number_format($trip->cash_advance_amount, 0, ',', '.') }}</div>
                                <div class="text-[11px] text-slate-400">Uang Saku/Per Diem {{ $trip->duration_days }} Hari</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-mono font-bold text-slate-900">{{ $trip->user->bank_name ?? 'BCA' }} - {{ $trip->user->bank_account_number ?? '-' }}</div>
                                <div class="text-[11px] text-slate-500">a.n {{ $trip->user->bank_account_holder ?? ($trip->user->name ?? '-') }}</div>
                            </td>
                            <td class="py-4 px-5 text-right">
                                <a href="{{ route('finance.cash-advances') }}" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs py-2 px-3.5 rounded-xl shadow-2xs transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    <span>Konfirmasi Transfer</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">Semua uang muka perjalanan dinas telah dicairkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-travel-layout>
