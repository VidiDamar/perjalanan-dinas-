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

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs shadow-2xs">
            <div class="font-bold mb-1">Pencairan belum dapat diproses:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Pencairan Uang Muka Perjalanan (Cash Advance)</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Verifikasi rekening bank karyawan dan masukkan nomor referensi transfer kasbon dinas.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 rounded-xl text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200 tabular-nums">
                Total Menunggu Cair: Rp {{ number_format($totalPendingAmount, 0, ',', '.') }}
            </span>
        </div>
    </div>

    <!-- Table Cash Advance Queue -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden mb-8">
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
                    @forelse($advances as $trip)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-5">
                                <div class="font-bold text-slate-900 text-sm">{{ $trip->user->name ?? 'Karyawan' }}</div>
                                <div class="text-[11px] text-slate-400">NIK: {{ $trip->user->employee_id ?? '-' }} &bull; {{ $trip->user->department ?? '-' }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-mono font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $trip->request_number }}
                                </span>
                                <div class="font-medium text-slate-800 mt-1">{{ $trip->purpose }} ({{ $trip->duration_days }} Hari)</div>
                            </td>
                            <td class="py-4 px-4 tabular-nums">
                                <div class="font-extrabold text-[#0A2558] text-base">Rp {{ number_format($trip->cash_advance_amount, 0, ',', '.') }}</div>
                                <div class="text-[10px] text-slate-400">Alokasi Uang Muka</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-mono font-bold text-slate-900">{{ $trip->user->bank_name ?? 'BCA' }}: {{ $trip->user->bank_account_number ?? '-' }}</div>
                                <div class="text-[11px] text-slate-500">{{ $trip->user->bank_account_holder ?? ($trip->user->name ?? '-') }}</div>
                            </td>
                            <td class="py-4 px-4">
                                @if($trip->cash_advance_status === 'disbursed')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Telah Dicairkan ({{ $trip->cash_advance_ref }})
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                        Siap Ditransfer
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-right">
                                @if($trip->cash_advance_status !== 'disbursed')
                                    <form action="{{ route('finance.cash-advances.disburse', $trip->request_number) }}" method="POST" class="inline-flex items-center gap-2 justify-end">
                                        @csrf
                                        <input type="hidden" name="cash_advance_method" value="BCA Corporate Direct Transfer">
                                        <input type="text" name="cash_advance_ref" placeholder="No. Ref Bank..." required class="px-2.5 py-1.5 text-xs font-mono border border-slate-200 rounded-lg w-36 bg-slate-50 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                        <button type="submit" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs py-1.5 px-3 rounded-lg shadow-2xs transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                            <span>Cairkan</span>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[11px] text-slate-400 font-medium tabular-nums">{{ $trip->cash_advance_paid_at?->format('d M Y') }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">Tidak ada data uang muka perjalanan dinas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-travel-layout>
