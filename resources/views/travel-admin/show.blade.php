<x-app-travel-layout>
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
    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-7 shadow-xs mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex flex-wrap items-center gap-2.5 mb-2">
                    <span class="font-mono text-sm font-bold text-[#0A2558] bg-slate-100 px-3 py-1 rounded-lg">
                        {{ $requestId ?? 'TRQ-2023-0891' }}
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200">
                        Siap Pemrosesan Tiket & Hotel
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        ✓ Disetujui Atasan: Budi Santoso (Division Head)
                    </span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Penerbitan Dokumen Tiket & Voucher Hotel</h1>
                <p class="text-xs text-slate-500 mt-1">Pemohon: <strong>Ahmad Pegawai</strong> (Senior Engineer) &bull; Rute: <strong>Jakarta &rarr; Surabaya (PP)</strong></p>
            </div>

            <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-xs text-right">
                <div class="text-slate-400 font-medium">Batas Alokasi Biaya Disetujui:</div>
                <div class="font-extrabold text-[#0A2558] text-base">Rp 4.750.000</div>
                <div class="text-[11px] text-emerald-600 font-semibold">Termasuk Tiket & Hotel</div>
            </div>
        </div>
    </div>

    <!-- Main Form Grid -->
    <form class="space-y-8 mb-20">
        <!-- Panel 1: Data Identitas Penumpang (Read-Only Info) -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
            <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                </svg>
                <span>Data Penumpang Sesuai KTP / Paspor (Untuk Reservasi)</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                <div>
                    <span class="text-slate-400 font-medium">Nama Lengkap (KTP):</span>
                    <div class="font-bold text-slate-900 mt-0.5">AHMAD PEGAWAI SANTOSO</div>
                </div>
                <div>
                    <span class="text-slate-400 font-medium">Nomor KTP (NIK):</span>
                    <div class="font-bold text-slate-900 mt-0.5 font-mono">3175021990080004</div>
                </div>
                <div>
                    <span class="text-slate-400 font-medium">Tanggal Lahir:</span>
                    <div class="font-bold text-slate-900 mt-0.5">19 Agustus 1990</div>
                </div>
                <div>
                    <span class="text-slate-400 font-medium">No. Telepon & Email:</span>
                    <div class="font-bold text-slate-900 mt-0.5">+62 812-9876-5432</div>
                </div>
            </div>
        </div>

        <!-- Panel 2: Pemrosesan Tiket Pesawat / Kereta -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
                <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="text-lg">✈️</span>
                    <span>1. Detail Reservasi Tiket Transportasi</span>
                </h2>
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Plafon: Garuda Indonesia / Batik (Kelas Ekonomi)
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-xs mb-4">
                <!-- Maskapai / Operator -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Maskapai / Operator Transportasi <span class="text-rose-500">*</span></label>
                    <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                        <option selected>Garuda Indonesia (GA)</option>
                        <option>Batik Air (ID)</option>
                        <option>Citilink (QG)</option>
                        <option>PT Kereta Api Indonesia (KAI)</option>
                    </select>
                </div>

                <!-- Kode Booking (PNR) -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Kode Booking (PNR / Record Locator) <span class="text-rose-500">*</span></label>
                    <input type="text" value="GAK78Q" placeholder="Contoh: 6 Karakter PNR" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-mono font-bold focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- No Tiket Elektronik -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nomor E-Ticket (13 Digit)</label>
                    <input type="text" value="126-2391029311" placeholder="Contoh: 126-xxxx" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-mono focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Penerbangan Berangkat -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Penerbangan Pergi (No. Flight & Jam)</label>
                    <input type="text" value="GA-312 &bull; CGK-SUB (08:30 - 10:05 WIB)" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Penerbangan Pulang -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Penerbangan Pulang (No. Flight & Jam)</label>
                    <input type="text" value="GA-319 &bull; SUB-CGK (17:00 - 18:35 WIB)" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Harga Riil Tiket -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Total Biaya Riil Tiket (Rp) <span class="text-rose-500">*</span></label>
                    <input type="text" value="Rp 2.480.000" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-bold focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>
            </div>

            <!-- Upload File E-Tiket -->
            <div class="mt-4 pt-4 border-t border-slate-100">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lampirkan Berkas E-Tiket (PDF) <span class="text-rose-500">*</span></label>
                <div class="border-2 border-dashed border-slate-200 hover:border-sky-400 rounded-2xl p-4 text-center cursor-pointer bg-slate-50/50 transition">
                    <svg class="w-8 h-8 mx-auto text-sky-500 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <div class="text-xs font-semibold text-slate-700">Tarik berkas PDF E-Tiket ke sini atau <span class="text-sky-600 underline">pilih dari komputer</span></div>
                    <div class="text-[11px] text-slate-400 mt-0.5">Format: PDF (Maksimal 5 MB) &bull; Berkas akan langsung terbit di akun karyawan</div>
                </div>
            </div>
        </div>

        <!-- Panel 3: Pemrosesan Voucher Hotel -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
                <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="text-lg">🏨</span>
                    <span>2. Detail Reservasi Hotel & Akomodasi</span>
                </h2>
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Plafon: Maks Rp 750.000 / Malam
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-xs mb-4">
                <!-- Nama Hotel -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Properti Hotel <span class="text-rose-500">*</span></label>
                    <input type="text" value="Hotel Santika Premiere Gubeng Surabaya" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Tipe Kamar & Sarapan -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Tipe Kamar & Fasilitas</label>
                    <input type="text" value="Deluxe King Bed &bull; Free Breakfast (1 Pax)" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Kode Konfirmasi Reservasi Hotel -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nomor Konfirmasi Reservasi <span class="text-rose-500">*</span></label>
                    <input type="text" value="SNT-SUB-89211" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-mono font-bold focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Check in date -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Check-in</label>
                    <input type="date" value="2023-10-26" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Check out date -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Tanggal Check-out</label>
                    <input type="date" value="2023-10-28" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>

                <!-- Total Biaya Hotel Riil -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Total Biaya Riil Hotel (2 Malam)</label>
                    <input type="text" value="Rp 1.250.000 (Rp 625.000/Malam)" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 font-bold focus:outline-none focus:ring-1 focus:ring-sky-500">
                </div>
            </div>

            <!-- Upload Voucher Hotel -->
            <div class="mt-4 pt-4 border-t border-slate-100">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Lampirkan Voucher Konfirmasi Hotel (PDF / Gambar) <span class="text-rose-500">*</span></label>
                <div class="border-2 border-dashed border-slate-200 hover:border-sky-400 rounded-2xl p-4 text-center cursor-pointer bg-slate-50/50 transition">
                    <svg class="w-8 h-8 mx-auto text-sky-500 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <div class="text-xs font-semibold text-slate-700">Tarik berkas Voucher Hotel ke sini atau <span class="text-sky-600 underline">pilih dari komputer</span></div>
                    <div class="text-[11px] text-slate-400 mt-0.5">Format: PDF, PNG, JPG (Maksimal 5 MB)</div>
                </div>
            </div>
        </div>

        <!-- Sticky Action Bar -->
        <div class="fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-slate-200 px-6 py-4 z-40 shadow-lg">
            <div class="max-w-[1440px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-600">
                    <span class="font-bold text-slate-900">Total Biaya Riil Booking:</span>
                    <span class="font-extrabold text-[#0A2558] text-sm ml-1">Rp 3.730.000</span>
                    <span class="text-emerald-600 ml-2 font-medium">(Hemat Rp 120.000 dari plafon estimasi)</span>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('travel-admin.bookings') }}" class="px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                        Batal
                    </a>
                    <a href="{{ route('travel-admin.bookings') }}" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow-md transition active:scale-[0.99]">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        <span>Terbitkan Dokumen & Kirim ke Pemohon</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-app-travel-layout>
