<x-app-travel-layout>
    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs shadow-2xs">
            <div class="font-bold mb-1">Data booking belum lengkap:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Top Bar Navigation & Back Link -->
    <div class="mb-6">
        <a href="{{ route('travel-admin.bookings') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-[#0A2558] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Antrean Booking Travel</span>
        </a>
    </div>

    <!-- Header SPPD Info -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-7 shadow-2xs mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex flex-wrap items-center gap-2.5 mb-2">
                    <span class="font-mono text-sm font-bold text-[#0A2558] bg-slate-100 px-3 py-1 rounded-lg">
                        {{ $requestId ?? $trip->request_number }}
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200">
                        {{ $trip->is_booked ? 'Tiket & Voucher Terbit' : 'Siap Pemrosesan Tiket & Hotel' }}
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>Disetujui Atasan: {{ $trip->approver->name ?? 'Budi Santoso' }}</span>
                    </span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Penerbitan Dokumen Tiket & Voucher Hotel</h1>
                <p class="text-xs text-slate-500 mt-1">Pemohon: <strong>{{ $trip->user->name ?? 'Ahmad Pegawai' }}</strong> ({{ $trip->user->job_level ?? 'Senior Engineer' }}) &bull; Rute: <strong>{{ $trip->origin ?: 'Jakarta' }} &rarr; {{ $trip->destination }} (PP)</strong></p>
            </div>

            <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-xs text-right tabular-nums">
                <div class="text-slate-400 font-medium">Batas Alokasi Biaya Disetujui:</div>
                <div class="font-extrabold text-[#0A2558] text-base">Rp {{ number_format($trip->total_budget, 0, ',', '.') }}</div>
                <div class="text-[11px] text-emerald-600 font-semibold">Termasuk Tiket & Hotel</div>
            </div>
        </div>
    </div>

    <!-- Main Form Grid -->
    <form action="{{ route('travel-admin.bookings.store', $trip->request_number) }}" method="POST" enctype="multipart/form-data" class="space-y-8 mb-20">
        @csrf
        <!-- Panel 1: Data Identitas Penumpang (Read-Only Info) -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
            <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                </svg>
                <span>Data Penumpang Sesuai KTP / Paspor (Untuk Reservasi)</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                <div>
                    <span class="text-slate-400 font-medium">Nama Lengkap (KTP):</span>
                    <div class="font-bold text-slate-900 mt-0.5 uppercase">{{ $trip->user->name ?? 'AHMAD PEGAWAI' }}</div>
                </div>
                <div>
                    <span class="text-slate-400 font-medium">Nomor KTP (NIK):</span>
                    <div class="font-bold text-slate-900 mt-0.5 font-mono">{{ $trip->user->nik_ktp ?? '3175021990080004' }}</div>
                </div>
                <div>
                    <span class="text-slate-400 font-medium">Tanggal Lahir:</span>
                    <div class="font-bold text-slate-900 mt-0.5">{{ $trip->user->birth_date ? $trip->user->birth_date->format('d F Y') : '19 Agustus 1990' }}</div>
                </div>
                <div>
                    <span class="text-slate-400 font-medium">No. Telepon & Email:</span>
                    <div class="font-bold text-slate-900 mt-0.5">{{ $trip->user->phone ?? '+62 812-9876-5432' }}</div>
                </div>
            </div>
        </div>

        <!-- Panel 2: Pemrosesan Tiket Pesawat / Kereta -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
                <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z" />
                    </svg>
                    <span>1. Detail Reservasi Tiket Transportasi</span>
                </h2>
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Plafon: {{ $trip->transport_type }} (Kelas Ekonomi)
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-xs mb-4">
                <!-- Maskapai / Operator -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Maskapai / Operator Transportasi <span class="text-rose-500">*</span></label>
                    <input type="text" name="departure_airline" value="{{ old('departure_airline', $trip->departure_airline ?? 'Garuda Indonesia') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Kode Booking (PNR) -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Kode Booking (PNR / Record Locator) <span class="text-rose-500">*</span></label>
                    <input type="text" name="departure_pnr" value="{{ old('departure_pnr', $trip->departure_pnr ?? 'GAK78Q') }}" required placeholder="Contoh: 6 Karakter PNR" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-mono font-bold focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Penerbangan Berangkat -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Penerbangan Pergi (No. Flight)</label>
                    <input type="text" name="departure_flight_code" value="{{ old('departure_flight_code', $trip->departure_flight_code ?? 'GA-312') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Penerbangan Pulang -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Penerbangan Pulang (No. Flight)</label>
                    <input type="text" name="return_flight_code" value="{{ old('return_flight_code', $trip->return_flight_code ?? 'GA-319') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Kode PNR Pulang -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Kode PNR Pulang</label>
                    <input type="text" name="return_pnr" value="{{ old('return_pnr', $trip->return_pnr ?? 'GAK78Q') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-mono focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Harga Riil Tiket -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Total Biaya Riil Tiket (Rp) <span class="text-rose-500">*</span></label>
                    <input type="number" name="ticket_cost" value="{{ old('ticket_cost', $trip->ticket_cost) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-bold tabular-nums focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>
            </div>

            <!-- Upload File E-Tiket -->
            <div class="mt-4 pt-4 border-t border-slate-100">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lampirkan Berkas E-Tiket (PDF/Gambar)</label>
                <input type="file" name="e_ticket_file" accept=".pdf,.jpg,.jpeg,.png" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0A2558] file:text-white hover:file:bg-[#081c42] cursor-pointer">
            </div>
        </div>

        <!-- Panel 3: Pemrosesan Voucher Hotel -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-2xs">
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
                <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21" />
                    </svg>
                    <span>2. Detail Reservasi Hotel & Akomodasi</span>
                </h2>
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 tabular-nums">
                    Plafon: Maks Rp {{ number_format($trip->user ? $trip->user->getHotelLimit() : 750000, 0, ',', '.') }} / Malam
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs mb-4">
                <!-- Nama Hotel -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Properti Hotel <span class="text-rose-500">*</span></label>
                    <input type="text" name="hotel_name" value="{{ old('hotel_name', $trip->hotel_name ?? 'Hotel Santika Premiere Gubeng') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Tipe Kamar & Sarapan -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Tipe Kamar & Fasilitas</label>
                    <input type="text" name="hotel_room_type" value="{{ old('hotel_room_type', $trip->hotel_room_type ?? 'Deluxe Room - Breakfast') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Kode Konfirmasi Reservasi Hotel -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nomor Konfirmasi Reservasi <span class="text-rose-500">*</span></label>
                    <input type="text" name="hotel_booking_code" value="{{ old('hotel_booking_code', $trip->hotel_booking_code ?? 'SNT-SUB-89211') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-mono font-bold focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Total Biaya Hotel Riil -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Total Biaya Riil Hotel (Rp) <span class="text-rose-500">*</span></label>
                    <input type="number" name="hotel_cost" value="{{ old('hotel_cost', $trip->hotel_cost) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-bold tabular-nums focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>
            </div>

            <!-- Upload Voucher Hotel -->
            <div class="mt-4 pt-4 border-t border-slate-100">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lampirkan Voucher Konfirmasi Hotel (PDF / Gambar)</label>
                <input type="file" name="hotel_voucher_file" accept=".pdf,.jpg,.jpeg,.png" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0A2558] file:text-white hover:file:bg-[#081c42] cursor-pointer">
            </div>
        </div>

        <!-- Sticky Action Bar -->
        <div class="fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-slate-200 px-6 py-4 z-40 shadow-lg">
            <div class="max-w-[1440px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-600 tabular-nums">
                    <span class="font-bold text-slate-900">Estimasi Alokasi Tiket + Hotel:</span>
                    <span class="font-extrabold text-[#0A2558] text-sm ml-1">Rp {{ number_format($trip->ticket_cost + $trip->hotel_cost, 0, ',', '.') }}</span>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('travel-admin.bookings') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow-md transition">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        <span>Terbitkan Dokumen & Kirim ke Pemohon</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-travel-layout>
