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

    <!-- Top Action / Back Button -->
    <div class="mb-4">
        <a href="{{ route('requests.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-2xs">
            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Daftar Perjalanan</span>
        </a>
    </div>

    <!-- Main Title & Action Bar (Real Data) -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-2xl md:text-[28px] font-bold text-[#0A2558] tracking-tight font-mono">{{ $trip->request_number }}</h1>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $trip->status_badge_class }}">
                    {{ $trip->status_label }}
                </span>
                @if($trip->checked_in_at)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                        <svg class="w-3.5 h-3.5 text-emerald-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span>Sudah Check-in di {{ $trip->checkin_location }}</span>
                    </span>
                @endif
            </div>
            <p class="text-sm text-slate-500 font-medium mt-1">{{ $trip->purpose }} &bull; {{ $trip->origin ?: 'Jakarta' }} &rarr; {{ $trip->destination }}</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-2xs">
                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Cetak / Unduh SPPD</span>
            </button>

            @if(in_array($trip->status, ['approved', 'booked', 'completed']))
                <a href="{{ route('settlements.index', ['trip_id' => $trip->id]) }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white bg-[#0A2558] hover:bg-[#081c42] rounded-xl shadow-2xs transition">
                    <span>Klaim Pertanggungjawaban (Settlement)</span>
                </a>
            @endif
        </div>
    </div>

    @if(in_array($trip->status, ['revision_required', 'draft']))
        <!-- Revision Resubmit Panel -->
        <div class="bg-amber-50/90 border border-amber-200 rounded-2xl p-6 mb-6 shadow-2xs">
            <div class="flex items-start gap-3 mb-4">
                <div class="p-2 rounded-lg bg-amber-100 text-amber-800 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-amber-900">Pengajuan Memerlukan Revisi Sebelum Disetujui</h3>
                    @if($trip->revision_notes)
                        <p class="text-xs text-amber-800 mt-1">Catatan Atasan: <strong>"{{ $trip->revision_notes }}"</strong></p>
                    @endif
                </div>
            </div>

            <form action="{{ route('requests.update', $trip->request_number) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs bg-white p-4 rounded-xl border border-amber-200">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Keperluan Tugas</label>
                    <input type="text" name="purpose" value="{{ $trip->purpose }}" required class="w-full px-3 py-2 border border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kota Tujuan</label>
                    <input type="text" name="destination_city" value="{{ $trip->destination }}" required class="w-full px-3 py-2 border border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Moda Transportasi</label>
                    <input type="text" name="transport_mode" value="{{ $trip->transport_type }}" required class="w-full px-3 py-2 border border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Tanggal Berangkat</label>
                    <input type="date" name="start_date" value="{{ $trip->start_date->format('Y-m-d') }}" required class="w-full px-3 py-2 border border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Tanggal Kembali</label>
                    <input type="date" name="end_date" value="{{ $trip->end_date->format('Y-m-d') }}" required class="w-full px-3 py-2 border border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Revisi Estimasi Hotel (Rp)</label>
                    <input type="number" name="estimated_hotel" value="{{ $trip->hotel_cost }}" required class="w-full px-3 py-2 border border-slate-200 rounded-lg tabular-nums">
                    <input type="hidden" name="estimated_transport" value="{{ $trip->ticket_cost }}">
                    <input type="hidden" name="estimated_per_diem" value="{{ $trip->allowance_cost }}">
                    <input type="hidden" name="estimated_other" value="{{ $trip->other_cost }}">
                    <input type="hidden" name="cash_advance_requested" value="{{ $trip->cash_advance_amount }}">
                </div>
                <div class="md:col-span-3 flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-bold px-4 py-2 rounded-lg transition">
                        <span>Kirim Ulang Pengajuan (Resubmit SPPD)</span>
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Grid 2 Kolom (Kiri: Itinerary & Expenses | Kanan: Timeline, Documents, Traveler) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start mb-12">
        <!-- KOLOM KIRI (2 Col Span) -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <!-- Card 1: Itinerary & Tickets Details -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
                <div class="flex items-center justify-between mb-6 pb-2 border-b border-slate-100">
                    <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg">
                        <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z" />
                        </svg>
                        <span>Jadwal & Reservasi Tiket</span>
                    </div>

                    @if($trip->departure_pnr)
                        <span class="px-2.5 py-1 rounded-md text-xs font-mono font-bold bg-sky-50 text-sky-800 border border-sky-200">
                            PNR: {{ $trip->departure_pnr }}
                        </span>
                    @endif
                </div>

                <div class="space-y-6 text-xs">
                    <!-- Keberangkatan -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <div class="p-2.5 bg-sky-100 text-[#0A2558] rounded-xl shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-900 text-sm">Transportasi Dinas: {{ $trip->transport_type }}</span>
                                <span class="font-semibold text-slate-500 tabular-nums">{{ $trip->start_date->format('d M Y') }}</span>
                            </div>
                            <div class="text-slate-700 font-medium mt-1">
                                {{ $trip->origin ?: 'Jakarta' }} &rarr; {{ $trip->destination }}
                            </div>
                            @if($trip->departure_airline)
                                <div class="text-[11px] text-[#0A2558] font-bold mt-1">
                                    {{ $trip->departure_airline }} ({{ $trip->departure_flight_code }})
                                </div>
                            @endif
                            @if($trip->departure_pnr)
                                <div class="text-[11px] text-slate-500 font-mono mt-0.5">
                                    Kode Booking PNR: {{ $trip->departure_pnr }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Akomodasi Hotel -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <div class="p-2.5 bg-amber-100 text-amber-800 rounded-xl shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-900 text-sm">Akomodasi Penginapan</span>
                                <span class="font-semibold text-slate-500 tabular-nums">{{ max(1, $trip->duration_days - 1) }} Malam</span>
                            </div>
                            <div class="text-slate-800 font-semibold mt-1">
                                {{ $trip->hotel_name ?? 'Hotel Rekanan (Diproses Travel Desk)' }}
                            </div>
                            @if($trip->hotel_room_type)
                                <div class="text-[11px] text-slate-500 mt-0.5">
                                    Tipe Kamar: {{ $trip->hotel_room_type }}
                                </div>
                            @endif
                            @if($trip->hotel_booking_code)
                                <div class="text-[11px] text-emerald-700 font-bold font-mono mt-0.5">
                                    Kode Reservasi: {{ $trip->hotel_booking_code }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Check-in Action Bar -->
                @if(in_array($trip->status, ['approved', 'booked']) && ! $trip->checked_in_at)
                    <div class="mt-6 p-4 rounded-xl bg-sky-50 border border-sky-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                        <div>
                            <span class="font-bold text-sky-900">Sudah tiba di kota tujuan?</span>
                            <p class="text-slate-500 mt-0.5">Tekan tombol check-in untuk konfirmasi keselamatan dan update posisi di radar monitoring dinas.</p>
                        </div>
                        <form action="{{ route('requests.checkin', $trip->request_number) }}" method="POST">
                            @csrf
                            <input type="hidden" name="location" value="{{ $trip->hotel_name ?? $trip->destination }}">
                            <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2 rounded-xl shadow-2xs transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Check-in Sekarang</span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Card 2: Expense Breakdown -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
                <h3 class="text-base font-bold text-[#0A2558] mb-4">Rincian Anggaran Perjalanan</h3>
                <div class="space-y-3 text-xs tabular-nums">
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Estimasi Tiket Transportasi</span>
                        <span class="font-bold text-slate-900">Rp {{ number_format($trip->ticket_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Estimasi Akomodasi Hotel</span>
                        <span class="font-bold text-slate-900">Rp {{ number_format($trip->hotel_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Uang Harian / Per Diem ({{ $trip->duration_days }} Hari)</span>
                        <span class="font-bold text-slate-900">Rp {{ number_format($trip->allowance_cost, 0, ',', '.') }}</span>
                    </div>
                    @if($trip->other_cost > 0)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                            <span class="text-slate-600">Biaya Operasional Lainnya</span>
                            <span class="font-bold text-slate-900">Rp {{ number_format($trip->other_cost, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between items-center pt-2 text-base font-extrabold text-[#0A2558]">
                        <span>Total Anggaran:</span>
                        <span>Rp {{ number_format($trip->total_budget, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($trip->cash_advance_amount > 0)
                    <div class="mt-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs flex items-center justify-between">
                        <div>
                            <span class="text-slate-500 font-medium">Uang Muka / Kasbon Dicairkan:</span>
                            <div class="font-bold text-emerald-700 text-sm tabular-nums">Rp {{ number_format($trip->cash_advance_amount, 0, ',', '.') }}</div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                            {{ $trip->cash_advance_status === 'disbursed' ? 'Sudah Ditransfer Kasir' : 'Dalam Proses Transfer' }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- KOLOM KANAN (1 Col Span) -->
        <div class="flex flex-col gap-6">
            <!-- Traveler Profile Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs text-xs">
                <h4 class="font-bold text-slate-900 text-sm mb-3">Informasi Pelaksana Tugas</h4>
                <div class="space-y-2 text-slate-600">
                    <div>
                        <span class="text-slate-400">Nama Pegawai:</span>
                        <div class="font-bold text-slate-900 text-sm">{{ $trip->user->name }}</div>
                    </div>
                    <div>
                        <span class="text-slate-400">NIK & Divisi:</span>
                        <div class="font-semibold text-slate-800">{{ $trip->user->employee_id ?? 'EMP-0921' }} &bull; {{ $trip->user->department ?? 'Engineering' }}</div>
                    </div>
                    <div>
                        <span class="text-slate-400">Atasan Penyetuju:</span>
                        <div class="font-semibold text-slate-800">{{ $trip->approver->name ?? 'Budi Santoso' }}</div>
                    </div>
                </div>
            </div>

            <!-- Approval Timeline Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs text-xs">
                <h4 class="font-bold text-slate-900 text-sm mb-4">Jejak Status Approval</h4>
                <div class="relative pl-6 space-y-4 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-[2px] before:bg-slate-200">
                    <!-- Step 1: Submit -->
                    <div class="relative">
                        <div class="absolute -left-[23px] top-0.5 w-3 h-3 rounded-full bg-emerald-500 ring-4 ring-white"></div>
                        <div class="font-bold text-slate-900">Diajukan oleh Karyawan</div>
                        <div class="text-[11px] text-slate-400 tabular-nums">{{ $trip->created_at->format('d M Y, H:i') }} WIB</div>
                    </div>

                    <!-- Step 2: Approval -->
                    <div class="relative">
                        <div class="absolute -left-[23px] top-0.5 w-3 h-3 rounded-full {{ in_array($trip->status, ['approved', 'booked', 'completed']) ? 'bg-emerald-500' : ($trip->status === 'rejected' ? 'bg-rose-500' : 'bg-amber-400') }} ring-4 ring-white"></div>
                        <div class="font-bold text-slate-900">Persetujuan Atasan (Manager)</div>
                        @if($trip->approved_at)
                            <div class="text-[11px] text-emerald-700 font-semibold tabular-nums">{{ $trip->approved_at->format('d M Y, H:i') }} WIB &bull; Disetujui</div>
                        @elseif($trip->status === 'rejected')
                            <div class="text-[11px] text-rose-700 font-semibold">Ditolak: {{ $trip->rejection_reason }}</div>
                        @elseif($trip->status === 'revision_required')
                            <div class="text-[11px] text-amber-700 font-semibold">Diminta Revisi: {{ $trip->revision_notes }}</div>
                        @else
                            <div class="text-[11px] text-amber-700 font-medium">Dalam peninjauan {{ $trip->approver->name ?? 'Atasan' }}</div>
                        @endif
                    </div>

                    <!-- Step 3: Ticket Fulfillment -->
                    <div class="relative">
                        <div class="absolute -left-[23px] top-0.5 w-3 h-3 rounded-full {{ $trip->is_booked ? 'bg-emerald-500' : 'bg-slate-300' }} ring-4 ring-white"></div>
                        <div class="font-bold text-slate-900">Penerbitan Tiket & Hotel</div>
                        <div class="text-[11px] text-slate-500">
                            {{ $trip->is_booked ? 'E-Tiket terbit oleh Travel Desk' : 'Menunggu pemrosesan booking' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Download Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs text-xs">
                <h4 class="font-bold text-slate-900 text-sm mb-3">Dokumen Terlampir</h4>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="p-2 bg-rose-100 text-rose-700 rounded-lg shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </span>
                        <div>
                            <div class="font-bold text-slate-800 truncate max-w-[150px]">{{ $trip->supporting_document_name ?? 'Surat_Tugas_Dinas.pdf' }}</div>
                            <div class="text-[10px] text-slate-400">Berkas Pendukung Resmi</div>
                        </div>
                    </div>
                    @if($trip->supporting_document)
                        <a href="{{ route('requests.document', $trip->request_number) }}" class="px-2.5 py-1 bg-white border border-slate-200 rounded text-[11px] font-bold text-[#0A2558] hover:bg-slate-100">
                            Unduh
                        </a>
                    @else
                        <span class="text-[11px] text-slate-400">PDF Terverifikasi</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-travel-layout>
