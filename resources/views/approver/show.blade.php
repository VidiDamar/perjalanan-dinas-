<x-app-travel-layout>
    <!-- Flash & Validation Errors -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs shadow-2xs">
            <div class="font-bold mb-1">Keputusan belum dapat disimpan:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Top Bar Navigation & Back Link -->
    <div class="mb-6">
        <a href="{{ route('approver.requests') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-[#0A2558] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Antrean Approval</span>
        </a>
    </div>

    <!-- Header Card SPPD Review -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-7 shadow-2xs mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-100 pb-6 mb-6">
            <div>
                <div class="flex flex-wrap items-center gap-2.5 mb-2">
                    <span class="font-mono text-sm font-bold text-[#0A2558] bg-slate-100 px-3 py-1 rounded-lg">
                        {{ $requestId ?? $trip->request_number }}
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $trip->status_badge_class }} flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                        {{ $trip->status_label }} (Level {{ $trip->current_approval_level ?? 1 }} / {{ $trip->required_approval_level ?? 1 }})
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200 tabular-nums">
                        Berangkat {{ $trip->start_date->format('d M Y') }}
                    </span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">{{ $trip->purpose }} &bull; {{ $trip->destination }}</h1>
                <p class="text-xs text-slate-500 mt-1 tabular-nums">Diajukan pada {{ $trip->created_at->format('d M Y, H:i') }} WIB oleh {{ $trip->user->name ?? 'Ahmad Pegawai' }} ({{ $trip->user->job_level ?? 'Senior Engineer' }})</p>
            </div>

            <!-- Print or Download Preview -->
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs py-2.5 px-3.5 rounded-xl transition">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.75A2.25 2.25 0 0015.75 1.5h-7.5A2.25 2.25 0 006 3.75v3.456" />
                    </svg>
                    <span>Cetak Lembar Pengajuan</span>
                </button>
            </div>
        </div>

        <!-- Multi-Level Workflow Visualizer -->
        <div>
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Alur Workflow Persetujuan Berjenjang</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <!-- Step 1 -->
                <div class="p-3 rounded-xl bg-emerald-50/70 border border-emerald-200">
                    <div class="flex items-center gap-2 text-xs font-bold text-emerald-800">
                        <span class="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px]">1</span>
                        <span>1. Pengajuan</span>
                    </div>
                    <div class="text-[11px] text-slate-600 mt-1">{{ $trip->user->name ?? 'Ahmad Pegawai' }} (Diajukan)</div>
                    <div class="text-[10px] text-emerald-700 tabular-nums">{{ $trip->created_at->format('d M Y, H:i') }} WIB</div>
                </div>

                <!-- Step 2 -->
                <div class="p-3 rounded-xl {{ $trip->status === 'approved' ? 'bg-emerald-50/70 border border-emerald-200' : 'bg-amber-50/80 border-2 border-amber-400' }}">
                    <div class="flex items-center gap-2 text-xs font-bold {{ $trip->status === 'approved' ? 'text-emerald-800' : 'text-amber-900' }}">
                        <span class="w-5 h-5 rounded-full {{ $trip->status === 'approved' ? 'bg-emerald-600' : 'bg-amber-500' }} text-white flex items-center justify-center text-[10px]">2</span>
                        <span>2. Approval Manager</span>
                    </div>
                    <div class="text-[11px] font-semibold mt-1">{{ $trip->approver->name ?? 'Budi Santoso' }}</div>
                    <div class="text-[10px] font-medium">{{ $trip->status === 'approved' ? 'Disetujui' : 'Posisi aktif saat ini' }}</div>
                </div>

                <!-- Step 3 -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 opacity-70">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">3</span>
                        <span>3. Travel Desk</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1">Admin Booking Tiket/Hotel</div>
                    <div class="text-[10px] text-slate-400">{{ $trip->is_booked ? 'Tiket Terbit' : 'Menunggu Approval' }}</div>
                </div>

                <!-- Step 4 -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 opacity-70">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">4</span>
                        <span>4. Keuangan / Kasir</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1">Pencairan Uang Muka</div>
                    <div class="text-[10px] text-slate-400">{{ $trip->cash_advance_status === 'disbursed' ? 'Sudah Dicairkan' : 'Menunggu Approval' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content: 2 Columns Review -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-24">
        <!-- Left: Agenda, Rute & Dokumen Pendukung (2 Cols) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Card Profil Pemohon & Keperluan -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
                <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                    </svg>
                    <span>Informasi Pemohon & Urgensi Tugas</span>
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-400 font-medium">Nama Karyawan:</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">{{ $trip->user->name ?? 'Ahmad Pegawai' }}</div>
                    </div>
                    <div>
                        <span class="text-slate-400 font-medium">NIK & Jabatan:</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">{{ $trip->user->employee_id ?? 'EMP-0921' }} &bull; {{ $trip->user->job_level ?? 'Senior Engineer' }}</div>
                    </div>
                    <div>
                        <span class="text-slate-400 font-medium">Departemen & Cost Center:</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">{{ $trip->user->department ?? 'Engineering & IT' }} ({{ $trip->cost_center ?? 'CC-2026-OPS' }})</div>
                    </div>
                    <div>
                        <span class="text-slate-400 font-medium">Nomor Telepon:</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">{{ $trip->user->phone ?? '+62 812-9876-5432' }}</div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100">
                    <span class="text-xs text-slate-400 font-medium">Maksud & Tujuan Perjalanan:</span>
                    <p class="text-xs text-slate-700 font-medium leading-relaxed mt-1">
                        {{ $trip->purpose }} &mdash; {{ $trip->departure_notes ?? 'Koordinasi teknis dan peninjauan operasional lapangan sesuai surat penugasan.' }}
                    </p>
                    @if($trip->out_of_policy_reason)
                        <div class="mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs text-amber-900">
                            <strong>Justifikasi Pemohon (Melebihi Plafon):</strong> "{{ $trip->out_of_policy_reason }}"
                        </div>
                    @endif
                </div>

                <!-- Dokumen Pendukung -->
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <span class="text-xs text-slate-400 font-medium block mb-2">Lampiran Dokumen Surat Tugas / TOR:</span>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200">
                        <div class="flex items-center gap-2.5">
                            <span class="p-2 bg-rose-100 text-rose-700 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <div>
                                <div class="font-bold text-xs text-slate-800">{{ $trip->supporting_document_name ?? 'Surat_Tugas_TechCorp_Surabaya.pdf' }}</div>
                                <div class="text-[11px] text-slate-400">Berkas Pendukung Resmi SPPD</div>
                            </div>
                        </div>
                        @if($trip->supporting_document)
                            <a href="{{ route('requests.document', $trip->request_number) }}" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-[#0A2558] hover:bg-slate-100 transition shadow-2xs">
                                Unduh Berkas
                            </a>
                        @else
                            <span class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-500">Terlampir</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Rincian Itinerary & Transport -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
                <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Rute Perjalanan & Usulan Penginapan</span>
                </h2>

                <div class="space-y-4 text-xs">
                    <div class="flex items-start gap-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                        <div class="p-2 bg-sky-100 text-sky-700 rounded-lg shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-900">Transportasi Pergi-Pulang ({{ $trip->transport_type }})</span>
                                <span class="font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">{{ $trip->operator_name ?? 'Garuda Indonesia (Kelas Ekonomi)' }}</span>
                            </div>
                            <div class="text-slate-600 mt-1 tabular-nums">
                                {{ $trip->origin ?: 'Jakarta' }} &rarr; {{ $trip->destination }} ({{ $trip->start_date->format('d M Y') }} s/d {{ $trip->end_date->format('d M Y') }})
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                        <div class="p-2 bg-amber-100 text-amber-800 rounded-lg shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-900">Akomodasi Hotel Rekanan ({{ max(1, $trip->duration_days - 1) }} Malam)</span>
                                <span class="font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">{{ $trip->hotel_name ?? 'Hotel Rekanan Korporat' }}</span>
                            </div>
                            <div class="text-slate-600 mt-1 tabular-nums">
                                Check-in: {{ $trip->start_date->format('d M Y') }} &bull; Check-out: {{ $trip->end_date->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Policy Check & Cost Summary (1 Col) -->
        <div class="space-y-6">
            <!-- Travel Policy Validation Engine Card -->
            <div class="rounded-2xl border {{ $isHotelOverLimit ? 'bg-amber-50/70 border-amber-300' : 'bg-emerald-50/50 border-emerald-200' }} p-6 shadow-2xs">
                <div class="flex items-center gap-2 {{ $isHotelOverLimit ? 'text-amber-800' : 'text-emerald-800' }} font-bold text-xs uppercase tracking-wider mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Audit Plafon Travel Policy</span>
                </div>
                <div class="text-sm font-bold text-slate-900">
                    {{ $isHotelOverLimit ? 'Peringatan: Tarif Hotel Melebihi Plafon' : 'Sesuai Plafon Kebijakan (In-Policy)' }}
                </div>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                     Evaluasi otomatis terhadap matriks plafon jabatan {{ $trip->user->job_level ?? 'Senior Engineer' }} PT Jaya Abadi.
                </p>

                <div class="mt-4 space-y-2.5 pt-3 border-t border-slate-200/80 text-xs tabular-nums">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Tarif Hotel/Malam:</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($nightlyHotelRate, 0, ',', '.') }} <span class="text-[11px] {{ $isHotelOverLimit ? 'text-rose-600 font-bold' : 'text-emerald-600' }}">(Maks: Rp {{ number_format($trip->user ? $trip->user->getHotelLimit() : 750000, 0, ',', '.') }})</span></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Uang Saku/Per Diem:</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($trip->user ? $trip->user->getDailyPerDiemLimit() : 300000, 0, ',', '.') }}/hari <span class="text-[11px] text-emerald-600">(Standar)</span></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Kelas Transportasi:</span>
                        <span class="font-semibold text-slate-800">{{ $policy->transport_class ?? 'Economy Class' }}</span>
                    </div>
                </div>
            </div>

            <!-- Cost Breakdown Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Estimasi Rincian Anggaran</h3>
                <div class="space-y-3 text-xs tabular-nums">
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Tiket Transportasi (PP)</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($trip->ticket_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Akomodasi Hotel ({{ max(1, $trip->duration_days - 1) }} Malam)</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($trip->hotel_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Uang Harian / Per Diem ({{ $trip->duration_days }} Hari)</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($trip->allowance_cost, 0, ',', '.') }}</span>
                    </div>
                    @if($trip->other_cost > 0)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                            <span class="text-slate-600">Biaya Operasional Lainnya</span>
                            <span class="font-bold text-slate-800">Rp {{ number_format($trip->other_cost, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between items-center pt-2 text-sm font-extrabold text-[#0A2558]">
                        <span>Total Diajukan:</span>
                        <span>Rp {{ number_format($trip->total_budget, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="mt-4 p-3 rounded-xl bg-slate-50 border border-slate-200 text-[11px] text-slate-600 font-medium flex items-start gap-2">
                    <svg class="w-4 h-4 text-[#0A2558] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span>Dana Uang Muka sebesar Rp {{ number_format($trip->cash_advance_amount, 0, ',', '.') }} akan ditransfer oleh Kasir setelah disetujui. Tiket & Hotel diproses oleh Travel Desk.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Bottom Decision Action Bar -->
    <div class="fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-slate-200 px-6 py-4 z-40 shadow-lg">
        <div class="max-w-[1440px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                <div>
                    <span class="text-xs font-bold text-slate-800">Keputusan Atasan Berwenang:</span>
                    <span class="text-xs text-slate-500 ml-1">Silakan tentukan persetujuan untuk No. SPPD {{ $trip->request_number }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <!-- Button Tolak -->
                <button type="button" onclick="document.getElementById('modal-reject').classList.remove('hidden')" class="flex-1 sm:flex-initial px-4 py-2.5 rounded-xl border border-rose-200 text-rose-700 bg-rose-50 hover:bg-rose-100 font-semibold text-xs transition">
                    Tolak SPPD
                </button>

                <!-- Button Revisi -->
                <button type="button" onclick="document.getElementById('modal-revision').classList.remove('hidden')" class="flex-1 sm:flex-initial px-4 py-2.5 rounded-xl border border-amber-300 text-amber-800 bg-amber-50 hover:bg-amber-100 font-semibold text-xs transition">
                    Minta Revisi
                </button>

                <!-- Button Approve -->
                <button type="button" onclick="document.getElementById('modal-approve').classList.remove('hidden')" class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-[#0A2558] hover:bg-[#081c42] text-white font-bold text-xs shadow-md transition">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Setujui Pengajuan (Approve)</span>
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL 1: Konfirmasi Approve -->
    <div id="modal-approve" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <form action="{{ route('approver.requests.approve', $trip->request_number) }}" method="POST" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
            @csrf
            <div class="flex items-center gap-3 text-emerald-600 mb-3">
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-base">Setujui Perjalanan Dinas?</h4>
                    <p class="text-xs text-slate-500 font-mono">No. SPPD {{ $trip->request_number }}</p>
                </div>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                Dengan menyetujui, pengajuan ini akan diteruskan secara otomatis ke <strong>Admin Travel Desk</strong> untuk booking tiket/hotel dan ke <strong>Tim Keuangan</strong> untuk persiapan uang muka.
            </p>
            <div class="mb-5">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan Persetujuan (Opsional):</label>
                <textarea name="approval_notes" rows="2" placeholder="Contoh: Disetujui, pastikan laporan diserahkan H+3 setelah kepulangan." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2.5">
                <button type="button" onclick="document.getElementById('modal-approve').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-2xs transition">
                    Ya, Setujui Sekarang
                </button>
            </div>
        </form>
    </div>

    <!-- MODAL 2: Minta Revisi -->
    <div id="modal-revision" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <form action="{{ route('approver.requests.revision', $trip->request_number) }}" method="POST" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
            @csrf
            <div class="flex items-center gap-3 text-amber-600 mb-3">
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-base">Minta Revisi ke Pemohon</h4>
                    <p class="text-xs text-slate-500">Karyawan akan menerima notifikasi perbaikan</p>
                </div>
            </div>
            <div class="mb-5">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Rincian Bagian yang Perlu Direvisi <span class="text-rose-500">*</span>:</label>
                <textarea name="revision_notes" rows="3" required placeholder="Contoh: Mohon ganti pilihan hotel yang tarifnya di bawah plafon atau lampirkan TOR terbaru." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2.5">
                <button type="button" onclick="document.getElementById('modal-revision').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-2xs transition">
                    Kirim Catatan Revisi
                </button>
            </div>
        </form>
    </div>

    <!-- MODAL 3: Tolak SPPD -->
    <div id="modal-reject" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <form action="{{ route('approver.requests.reject', $trip->request_number) }}" method="POST" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
            @csrf
            <div class="flex items-center gap-3 text-rose-600 mb-3">
                <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-base">Tolak Pengajuan SPPD</h4>
                    <p class="text-xs text-slate-500">Tindakan ini akan membatalkan perjalanan dinas</p>
                </div>
            </div>
            <div class="mb-5">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alasan Penolakan Formal <span class="text-rose-500">*</span>:</label>
                <textarea name="rejection_reason" rows="3" required placeholder="Contoh: Jadwal bertabrakan dengan agenda audit internal atau koordinasi cukup dilakukan via daring." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2.5">
                <button type="button" onclick="document.getElementById('modal-reject').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-2xs transition">
                    Konfirmasi Penolakan
                </button>
            </div>
        </form>
    </div>
</x-app-travel-layout>
