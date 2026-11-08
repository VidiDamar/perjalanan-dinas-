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
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Audit Pertanggungjawaban & Settlement Biaya</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Verifikasi kesesuaian fisik nota/kuitansi pengeluaran dinas terhadap uang muka yang diterima.</p>
        </div>
        <div>
            <span class="px-3 py-1.5 rounded-xl text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 tabular-nums">
                {{ $settlements->where('status', 'pending_finance')->count() }} Klaim Perlu Diverifikasi
            </span>
        </div>
    </div>

    <!-- Table Settlement Queue -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Pemohon</th>
                        <th class="py-3.5 px-4">No. Settlement & SPPD</th>
                        <th class="py-3.5 px-4">Pengeluaran Riil (Nota)</th>
                        <th class="py-3.5 px-4">Uang Muka (Kasbon)</th>
                        <th class="py-3.5 px-4">Kalkulasi Selisih</th>
                        <th class="py-3.5 px-4">Status Audit</th>
                        <th class="py-3.5 px-5 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 tabular-nums">
                    @forelse($settlements as $st)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-5">
                                <div class="font-bold text-slate-900 text-sm">{{ $st->user->name ?? 'Karyawan' }}</div>
                                <div class="text-[11px] text-slate-400">{{ $st->user->department ?? 'Operations' }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-mono font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded border border-indigo-200">
                                    {{ $st->settlement_number }}
                                </span>
                                <div class="text-slate-800 font-medium mt-1">Ref SPPD: {{ $st->travelRequest->request_number ?? '-' }} ({{ $st->travelRequest->destination ?? '-' }})</div>
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-900 text-sm">
                                Rp {{ number_format($st->total_actual_expense, 0, ',', '.') }}
                                <div class="text-[10px] text-slate-400 font-normal">{{ $st->items->count() }} Nota Fisik Terlampir</div>
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-700">
                                Rp {{ number_format($st->cash_advance_received, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4">
                                @if($st->settlement_type === 'reimbursement')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-extrabold text-rose-700 bg-rose-50 px-2 py-0.5 rounded border border-rose-200">
                                        Kurang Bayar: Rp {{ number_format($st->difference_amount, 0, ',', '.') }}
                                    </span>
                                    <div class="text-[10px] text-slate-500 mt-0.5">Perlu dicairkan ke pegawai</div>
                                @elseif($st->settlement_type === 'refund')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-extrabold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                        Lebih Bayar: Rp {{ number_format($st->difference_amount, 0, ',', '.') }}
                                    </span>
                                    <div class="text-[10px] text-slate-500 mt-0.5">Disetor kembali ke kas</div>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-extrabold text-slate-700 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                        Seimbang (Rp 0)
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $st->status_badge_class }}">
                                    {{ $st->status_label }}
                                </span>
                            </td>
                            <td class="py-4 px-5 text-right">
                                <a href="{{ route('finance.settlements.review', $st->settlement_number) }}" class="inline-flex items-center gap-1.5 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2 px-3.5 rounded-xl shadow-2xs transition">
                                    <span>Audit Nota & Selisih</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400">Belum ada pengajuan settlement biaya perjalanan dinas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-travel-layout>
