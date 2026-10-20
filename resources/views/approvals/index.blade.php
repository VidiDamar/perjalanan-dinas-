<x-app-travel-layout>
    <!-- Header Title & Subtitle -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Status Persetujuan & Verifikasi SPPD</h1>
        <p class="text-sm text-slate-500 font-medium mt-1">Pantau alur verifikasi atasan, penerbitan tiket oleh Travel Desk, dan pencairan uang muka dinas Anda secara real-time.</p>
    </div>

    <!-- Main Grid 2 Kolom (Kiri: List SPPD Saya | Kanan: Detail & Timeline Approval) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- KOLOM KIRI (1 Col Span) -->
        <div class="lg:col-span-1 flex flex-col gap-4">
            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-slate-900 text-sm">Daftar Pengajuan Saya</h2>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-sky-50 text-sky-700 border border-sky-100">
                        {{ $requests->count() }} Pengajuan
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($requests as $req)
                        <a 
                            href="{{ route('approvals.index', ['id' => $req->id]) }}"
                            class="block p-4 rounded-xl border transition relative shadow-2xs {{ $selectedTrip?->id === $req->id ? 'border-[#0A2558] bg-slate-50/50 ring-1 ring-[#0A2558]/20 before:absolute before:left-0 before:top-3 before:bottom-3 before:w-1 before:bg-[#0A2558] before:rounded-r' : 'border-slate-200/80 bg-white hover:border-slate-300' }}"
                        >
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="font-mono font-bold text-[#0A2558]">{{ $req->request_number }}</span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $req->status_badge_class }}">
                                    {{ $req->status_label }}
                                </span>
                            </div>
                            <div class="font-bold text-slate-900 text-sm mt-1">{{ $req->purpose }}</div>
                            <div class="flex items-center justify-between text-xs mt-3 pt-2 border-t border-slate-100">
                                <div class="flex items-center gap-1.5 text-slate-500 font-medium">
                                    <span>{{ $req->origin_city }} &rarr; {{ $req->destination_city }}</span>
                                </div>
                                <span class="font-bold text-[#0A2558]">Rp {{ number_format($req->total_estimated_budget, 0, ',', '.') }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="p-6 text-center text-xs text-slate-400">
                            Belum ada pengajuan perjalanan dinas.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (2 Col Span: Detail Panel & Live Multi-Level Stepper) -->
        <div class="lg:col-span-2">
            @if($selectedTrip)
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
                    <!-- Detail Header -->
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 pb-6 border-b border-slate-100">
                        <div>
                            <div class="flex flex-wrap items-center gap-2.5 mb-1.5">
                                <span class="font-mono font-bold text-sm text-[#0A2558] bg-slate-100 px-2.5 py-1 rounded">
                                    {{ $selectedTrip->request_number }}
                                </span>
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $selectedTrip->status_badge_class }}">
                                    {{ $selectedTrip->status_label }}
                                </span>
                            </div>
                            <h2 class="text-xl md:text-2xl font-bold text-slate-900">{{ $selectedTrip->purpose }}</h2>
                            <p class="text-xs text-slate-500 mt-1">
                                Rute: <strong>{{ $selectedTrip->origin_city }} &rarr; {{ $selectedTrip->destination_city }}</strong> &bull; Jadwal: <strong>{{ $selectedTrip->start_date->format('d M Y') }}</strong> ({{ $selectedTrip->duration_days }} Hari)
                            </p>
                        </div>

                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-right">
                            <span class="text-slate-400">Estimasi Total Biaya:</span>
                            <div class="font-extrabold text-[#0A2558] text-base">Rp {{ number_format($selectedTrip->total_estimated_budget, 0, ',', '.') }}</div>
                            <div class="text-[11px] text-emerald-600 font-semibold">Uang Muka: Rp {{ number_format($selectedTrip->cash_advance_requested, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <!-- Alert Revisi jika diperlukan -->
                    @if($selectedTrip->status === 'revision_required')
                        <div class="my-6 p-4 rounded-xl bg-amber-50 border border-amber-200 text-xs">
                            <div class="flex items-center gap-2 text-amber-800 font-bold mb-1">
                                <span>⚠️ Catatan Revisi dari Atasan:</span>
                            </div>
                            <p class="text-amber-900 leading-relaxed">
                                {{ $selectedTrip->revision_notes ?? 'Harap tinjau kembali rincian anggaran hotel dan sesuaikan dengan batas kebijakan.' }}
                            </p>
                        </div>
                    @endif

                    <!-- Multi-Level Workflow Visualizer -->
                    <div class="py-6 border-b border-slate-100">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Progres Verifikasi Berjenjang</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs">
                            <!-- Step 1: Submit -->
                            <div class="p-3.5 rounded-xl bg-emerald-50/80 border border-emerald-200">
                                <div class="flex items-center gap-2 font-bold text-emerald-800">
                                    <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px]">✓</span>
                                    <span>1. Pengajuan</span>
                                </div>
                                <div class="text-[11px] text-slate-600 mt-1">Diajukan oleh Anda</div>
                                <div class="text-[10px] text-emerald-700 font-medium">{{ $selectedTrip->created_at->format('d M Y, H:i') }} WIB</div>
                            </div>

                            <!-- Step 2: Manager Approval -->
                            <div class="p-3.5 rounded-xl border {{ in_array($selectedTrip->status, ['approved', 'ticket_issued', 'completed']) ? 'bg-emerald-50/80 border-emerald-200 text-emerald-800' : 'bg-amber-50/80 border-amber-300 text-amber-900' }}">
                                <div class="flex items-center gap-2 font-bold">
                                    <span class="w-5 h-5 rounded-full {{ in_array($selectedTrip->status, ['approved', 'ticket_issued', 'completed']) ? 'bg-emerald-500' : 'bg-amber-500' }} text-white flex items-center justify-center text-[10px]">
                                        {{ in_array($selectedTrip->status, ['approved', 'ticket_issued', 'completed']) ? '✓' : '2' }}
                                    </span>
                                    <span>2. Approval Atasan</span>
                                </div>
                                <div class="text-[11px] mt-1">{{ $selectedTrip->approver->name ?? 'Budi Santoso' }}</div>
                                <div class="text-[10px] font-medium">
                                    @if($selectedTrip->approval_date)
                                        Disetujui: {{ $selectedTrip->approval_date->format('d M Y') }}
                                    @else
                                        Menunggu Keputusan
                                    @endif
                                </div>
                            </div>

                            <!-- Step 3: Travel Desk Booking -->
                            <div class="p-3.5 rounded-xl border {{ $selectedTrip->pnr_code ? 'bg-emerald-50/80 border-emerald-200 text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-500 opacity-60' }}">
                                <div class="flex items-center gap-2 font-bold">
                                    <span class="w-5 h-5 rounded-full {{ $selectedTrip->pnr_code ? 'bg-emerald-500 text-white' : 'bg-slate-300 text-slate-700' }} flex items-center justify-center text-[10px]">
                                        {{ $selectedTrip->pnr_code ? '✓' : '3' }}
                                    </span>
                                    <span>3. Tiket & Hotel</span>
                                </div>
                                <div class="text-[11px] mt-1">Admin Travel Desk</div>
                                <div class="text-[10px] font-medium">
                                    {{ $selectedTrip->pnr_code ? 'Tiket Terbit' : 'Belum Diproses' }}
                                </div>
                            </div>

                            <!-- Step 4: Cash Advance -->
                            <div class="p-3.5 rounded-xl border {{ $selectedTrip->cash_advance_status === 'disbursed' ? 'bg-emerald-50/80 border-emerald-200 text-emerald-800' : 'bg-slate-50 border-slate-200 text-slate-500 opacity-60' }}">
                                <div class="flex items-center gap-2 font-bold">
                                    <span class="w-5 h-5 rounded-full {{ $selectedTrip->cash_advance_status === 'disbursed' ? 'bg-emerald-500 text-white' : 'bg-slate-300 text-slate-700' }} flex items-center justify-center text-[10px]">
                                        {{ $selectedTrip->cash_advance_status === 'disbursed' ? '✓' : '4' }}
                                    </span>
                                    <span>4. Uang Muka</span>
                                </div>
                                <div class="text-[11px] mt-1">Kasir Keuangan</div>
                                <div class="text-[10px] font-medium">
                                    {{ $selectedTrip->cash_advance_status === 'disbursed' ? 'Sudah Ditransfer' : 'Menunggu Transfer' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Bar -->
                    <div class="pt-6 flex items-center justify-between">
                        <div class="text-xs text-slate-500">
                            Surat Tugas: <strong>{{ $selectedTrip->document_name ?? 'Surat_Tugas.pdf' }}</strong>
                        </div>
                        <a href="{{ route('requests.show', $selectedTrip->request_number) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-bold text-xs rounded-xl shadow-xs transition">
                            <span>Buka Halaman Lengkap SPPD</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-travel-layout>
