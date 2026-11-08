<x-app-travel-layout>
    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs shadow-2xs">
            <div class="font-bold mb-1">Verifikasi belum dapat disimpan:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Top Bar Navigation & Back Link -->
    <div class="mb-6">
        <a href="{{ route('finance.settlements') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-[#0A2558] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Daftar Settlement</span>
        </a>
    </div>

    <!-- Header Review Settlement -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-7 shadow-2xs mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex flex-wrap items-center gap-2.5 mb-2">
                    <span class="font-mono text-sm font-bold text-indigo-700 bg-indigo-50 px-3 py-1 rounded-lg border border-indigo-200">
                        {{ $settlementId ?? $settlement->settlement_number }}
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $settlement->status_badge_class }}">
                        {{ $settlement->status_label }}
                    </span>
                    <span class="text-xs text-slate-400 font-medium font-mono">Ref SPPD: {{ $settlement->travelRequest->request_number ?? 'TRQ-2023-0855' }}</span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Audit Pertanggungjawaban Dinas {{ $settlement->travelRequest->destination ?? 'Semarang' }}</h1>
                <p class="text-xs text-slate-500 mt-1">Pemohon: <strong>{{ $settlement->user->name ?? 'Bagus Pratama' }}</strong> ({{ $settlement->user->department ?? 'Project Operations' }})</p>
            </div>

            <!-- Settlement Calculation Box -->
            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200 text-xs tabular-nums">
                <div class="flex justify-between gap-6 pb-1.5 border-b border-slate-200 text-slate-500">
                    <span>Uang Muka Diterima:</span>
                    <span class="font-bold text-slate-800">Rp {{ number_format($settlement->cash_advance_received, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between gap-6 py-1.5 border-b border-slate-200 text-slate-500">
                    <span>Total Pengeluaran Riil:</span>
                    <span class="font-bold text-slate-900">Rp {{ number_format($settlement->total_actual_expense, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between gap-6 pt-1.5 {{ $settlement->settlement_type === 'reimbursement' ? 'text-rose-700' : 'text-emerald-700' }} font-extrabold text-sm">
                    <span>{{ $settlement->settlement_type === 'reimbursement' ? 'Kurang Bayar (Reimbursement):' : ($settlement->settlement_type === 'refund' ? 'Lebih Bayar (Setor Sisa):' : 'Seimbang (Nihil):') }}</span>
                    <span>Rp {{ number_format($settlement->difference_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 Columns Layout: Left = Items list, Right = Receipt zoom preview -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-24">
        <!-- Kolom Kiri: Tabel Checklist Validasi Nota (7 Cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
            <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Daftar Bukti Transaksi Fisik (Nota & Kuitansi)</span>
                </span>
                <span class="text-xs text-slate-400 font-normal tabular-nums">{{ $settlement->items->count() }} Item Nota</span>
            </h2>

            <div class="space-y-3 text-xs tabular-nums">
                @forelse($settlement->items as $idx => $item)
                    <div class="p-4 rounded-xl border {{ $idx === 0 ? 'border-2 border-sky-400 bg-sky-50/30' : 'border-slate-200 bg-white' }} transition">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-3">
                                <input type="checkbox" checked class="w-4 h-4 rounded text-[#0A2558] focus:ring-sky-500 border-slate-300 mt-0.5">
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">{{ $item->merchant_name }}</div>
                                    <div class="text-[11px] text-slate-500">Kategori: {{ $item->category }} &bull; {{ $item->description }}</div>
                                    <div class="text-[10px] text-slate-400 mt-1">Tanggal Nota: {{ $item->expense_date?->format('d M Y') }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-extrabold text-slate-900 text-sm">Rp {{ number_format($item->amount, 0, ',', '.') }}</div>
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 mt-1">Valid</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-400">Tidak ada rincian item nota.</div>
                @endforelse
            </div>
        </div>

        <!-- Kolom Kanan: Pratinjau Foto Nota / Receipt Viewer (5 Cols) -->
        <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-2 mb-3 border-b border-slate-100">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                        </svg>
                        <span>Pratinjau Foto Nota Terpilih</span>
                    </h3>
                    <span class="text-[11px] font-semibold text-sky-600">Bukti Kuitansi</span>
                </div>

                <!-- Receipt Image Container -->
                <div class="relative bg-slate-900 rounded-xl p-3 flex items-center justify-center min-h-[340px] overflow-hidden border border-slate-800">
                    <div class="bg-white p-4 rounded shadow-md text-slate-800 text-[11px] font-mono max-w-[240px] w-full select-none">
                        <div class="text-center font-bold border-b pb-2 mb-2">
                            BUKTI TRANSAKSI RESMI<br>
                            {{ strtoupper($settlement->items->first()?->merchant_name ?? 'SPBU SHELL SEMARANG') }}
                        </div>
                        <div class="space-y-1 text-[10px]">
                            <div>NO SETTLEMENT : {{ $settlement->settlement_number }}</div>
                            <div>KATEGORI      : {{ strtoupper($settlement->items->first()?->category ?? 'BBM/TOL') }}</div>
                            <div class="border-t pt-1 font-bold flex justify-between text-xs mt-2">
                                <span>NOMINAL</span>
                                <span>RP {{ number_format($settlement->items->first()?->amount ?? 450000, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-xl bg-slate-50 border border-slate-200 text-[11px] text-slate-600">
                <strong>Catatan Auditor Keuangan:</strong> Pastikan seluruh nota fisik telah sesuai dengan tanggal penugasan SPPD sebelum menyetujui pencairan selisih.
            </div>
        </div>
    </div>

    <!-- Sticky Action Decision Bottom Bar -->
    <div class="fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-slate-200 px-6 py-4 z-40 shadow-lg">
        <div class="max-w-[1440px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-slate-700 tabular-nums">
                <span class="font-bold text-slate-900">Keputusan Hasil Audit:</span>
                <span class="text-slate-500 ml-1">Selisih Pertanggungjawaban:</span>
                <span class="font-extrabold text-[#0A2558] text-sm ml-1">Rp {{ number_format($settlement->difference_amount, 0, ',', '.') }}</span>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" onclick="document.getElementById('modal-reject-settlement').classList.remove('hidden')" class="px-4 py-2.5 rounded-xl border border-amber-300 text-amber-800 bg-amber-50 hover:bg-amber-100 font-semibold text-xs transition">
                    Tolak / Minta Perbaikan Nota
                </button>
                <form action="{{ route('finance.settlements.approve', $settlement->settlement_number) }}" method="POST" class="inline-flex items-center gap-2">
                    @csrf
                    <input type="text" name="payment_ref" value="{{ $settlement->payment_ref ?? 'FIN-SETTLE-' . rand(1000, 9999) }}" placeholder="Ref Pelunasan..." class="px-3 py-2 text-xs font-mono border border-slate-200 rounded-xl bg-slate-50 w-40">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Setujui Settlement & Tutup Buku</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Reject Settlement -->
    <div id="modal-reject-settlement" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <form action="{{ route('finance.settlements.reject', $settlement->settlement_number) }}" method="POST" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
            @csrf
            <h4 class="font-bold text-slate-900 text-base mb-1">Kembalikan Settlement untuk Perbaikan</h4>
            <p class="text-xs text-slate-500 mb-4">Karyawan akan diminta mengunggah ulang bukti kuitansi yang valid.</p>
            <div class="mb-4">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan Auditor Keuangan <span class="text-rose-500">*</span></label>
                <textarea name="finance_notes" rows="3" required placeholder="Contoh: Struk parkir tidak terbaca jelas, mohon lampirkan foto ulang." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl p-3"></textarea>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('modal-reject-settlement').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs">Kirim Catatan Perbaikan</button>
            </div>
        </form>
    </div>
</x-app-travel-layout>
