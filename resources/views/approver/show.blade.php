<x-app-travel-layout>
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
    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-7 shadow-xs mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-100 pb-6 mb-6">
            <div>
                <div class="flex flex-wrap items-center gap-2.5 mb-2">
                    <span class="font-mono text-sm font-bold text-[#0A2558] bg-slate-100 px-3 py-1 rounded-lg">
                        {{ $requestId ?? 'TRQ-2023-0891' }}
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        Menunggu Persetujuan Anda (Level 1 - Manager)
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                        Prioritas Tinggi &bull; Berangkat 26 Okt 2023
                    </span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Client Meeting &bull; TechCorp Infra Surabaya</h1>
                <p class="text-xs text-slate-500 mt-1">Diajukan pada 20 Okt 2023, 10:15 WIB oleh Ahmad Pegawai (Senior Engineer)</p>
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
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px]">✓</span>
                        <span>1. Pengajuan</span>
                    </div>
                    <div class="text-[11px] text-slate-600 mt-1">Ahmad Pegawai (Diajukan)</div>
                    <div class="text-[10px] text-emerald-700">20 Okt 2023, 10:15 WIB</div>
                </div>

                <!-- Step 2 -->
                <div class="p-3 rounded-xl bg-amber-50/80 border-2 border-amber-400">
                    <div class="flex items-center gap-2 text-xs font-bold text-amber-900">
                        <span class="w-5 h-5 rounded-full bg-amber-500 text-white flex items-center justify-center text-[10px]">2</span>
                        <span>2. Approval Manager</span>
                    </div>
                    <div class="text-[11px] text-amber-900 font-semibold mt-1">Budi Santoso (Menunggu)</div>
                    <div class="text-[10px] text-amber-700 font-medium">Posisi aktif saat ini</div>
                </div>

                <!-- Step 3 -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 opacity-60">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">3</span>
                        <span>3. Travel Desk</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1">Admin Booking Tiket/Hotel</div>
                    <div class="text-[10px] text-slate-400">Menunggu Approval</div>
                </div>

                <!-- Step 4 -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 opacity-60">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center text-[10px]">4</span>
                        <span>4. Keuangan / Kasir</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1">Pencairan Uang Muka</div>
                    <div class="text-[10px] text-slate-400">Menunggu Approval</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content: 2 Columns Review -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-24">
        <!-- Left: Agenda, Rute & Dokumen Pendukung (2 Cols) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Card Profil Pemohon & Keperluan -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                    </svg>
                    <span>Informasi Pemohon & Urgensi Tugas</span>
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-400 font-medium">Nama Karyawan:</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">Ahmad Pegawai</div>
                    </div>
                    <div>
                        <span class="text-slate-400 font-medium">NIK & Jabatan:</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">EMP-0921 &bull; Senior Engineer</div>
                    </div>
                    <div>
                        <span class="text-slate-400 font-medium">Departemen:</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">Engineering & IT Infrastructure</div>
                    </div>
                    <div>
                        <span class="text-slate-400 font-medium">Nomor Telepon:</span>
                        <div class="font-bold text-slate-900 text-sm mt-0.5">+62 812-9876-5432</div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100">
                    <span class="text-xs text-slate-400 font-medium">Maksud & Tujuan Perjalanan:</span>
                    <p class="text-xs text-slate-700 font-medium leading-relaxed mt-1">
                        Menghadiri technical coordination meeting dan sign-off arsitektur data center tahap 2 bersama manajemen PT TechCorp Infra Surabaya. Peninjauan fisik fasilitas server rak di Rungkut Industrial Estate.
                    </p>
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
                                <div class="font-bold text-xs text-slate-800">Surat_Tugas_TechCorp_Surabaya.pdf</div>
                                <div class="text-[11px] text-slate-400">1.8 MB &bull; Ditandatangani Direktur Operasional</div>
                            </div>
                        </div>
                        <a href="#" class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-[#0A2558] hover:bg-slate-100 transition shadow-2xs">
                            Unduh Berkas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Rincian Itinerary & Transport -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Rute Perjalanan & Usulan Penginapan</span>
                </h2>

                <div class="space-y-4 text-xs">
                    <div class="flex items-start gap-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                        <div class="p-2 bg-sky-100 text-sky-700 rounded-lg shrink-0">
                            ✈️
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-900">Penerbangan Pergi-Pulang (PP)</span>
                                <span class="font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">Garuda Indonesia (Kelas Ekonomi)</span>
                            </div>
                            <div class="text-slate-600 mt-1">
                                CGK &rarr; SUB (26 Okt 2023, 08:30 WIB) &bull; SUB &rarr; CGK (28 Okt 2023, 17:00 WIB)
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-3.5 rounded-xl bg-slate-50 border border-slate-200/70">
                        <div class="p-2 bg-amber-100 text-amber-800 rounded-lg shrink-0">
                            🏨
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-900">Akomodasi Hotel Rekanan (2 Malam)</span>
                                <span class="font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">Hotel Santika Premiere Gubeng (Deluxe Room)</span>
                            </div>
                            <div class="text-slate-600 mt-1">
                                Check-in: 26 Okt 2023 &bull; Check-out: 28 Okt 2023 &bull; Dekat lokasi pertemuan (800m)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Policy Check & Cost Summary (1 Col) -->
        <div class="space-y-6">
            <!-- Travel Policy Validation Engine Card -->
            <div class="bg-gradient-to-b from-emerald-50/60 to-white rounded-2xl border border-emerald-200 p-6 shadow-xs">
                <div class="flex items-center gap-2 text-emerald-800 font-bold text-xs uppercase tracking-wider mb-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Audit Plafon Travel Policy</span>
                </div>
                <div class="text-sm font-bold text-slate-900">Sesuai Plafon Kebijakan (In-Policy)</div>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Pengajuan dinas memenuhi ketentuan batas biaya jabatan Senior Engineer PT Jaya Abadi.
                </p>

                <div class="mt-4 space-y-2.5 pt-3 border-t border-emerald-200/60 text-xs">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Plafon Hotel/Malam:</span>
                        <span class="font-semibold text-slate-800">Rp 650.000 <span class="text-[11px] text-emerald-600">(Maks: Rp 750.000)</span></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Uang Saku/Per Diem:</span>
                        <span class="font-semibold text-slate-800">Rp 300.000/hari <span class="text-[11px] text-emerald-600">(Standar)</span></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Kelas Pesawat:</span>
                        <span class="font-semibold text-slate-800">Ekonomi <span class="text-[11px] text-emerald-600">(Sesuai)</span></span>
                    </div>
                </div>
            </div>

            <!-- Cost Breakdown Card -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Estimasi Rincian Anggaran</h3>
                <div class="space-y-3 text-xs">
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Tiket Pesawat Garuda (PP)</span>
                        <span class="font-bold text-slate-800">Rp 2.550.000</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Akomodasi Hotel (2 Malam)</span>
                        <span class="font-bold text-slate-800">Rp 1.300.000</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                        <span class="text-slate-600">Uang Harian / Per Diem (3 Hari)</span>
                        <span class="font-bold text-slate-800">Rp 900.000</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 text-sm font-extrabold text-[#0A2558]">
                        <span>Total Diajukan:</span>
                        <span>Rp 4.750.000</span>
                    </div>
                </div>
                <div class="mt-4 p-3 rounded-xl bg-slate-50 text-[11px] text-slate-500 font-medium">
                    💡 Dana Uang Muka sebesar Rp 900.000 (Per Diem) akan ditransfer oleh Kasir setelah disetujui. Tiket & Hotel akan diproses oleh Travel Desk.
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Bottom Decision Action Bar -->
    <div class="fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-slate-200 px-6 py-4 z-40 shadow-lg">
        <div class="max-w-[1440px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-amber-500 animate-pulse"></span>
                <div>
                    <span class="text-xs font-bold text-slate-800">Keputusan Atasan Langsung:</span>
                    <span class="text-xs text-slate-500 ml-1">Silakan tentukan persetujuan untuk No. SPPD TRQ-2023-0891</span>
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
                <button type="button" onclick="document.getElementById('modal-approve').classList.remove('hidden')" class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-[#0A2558] hover:bg-[#081c42] text-white font-bold text-xs shadow-md transition active:scale-[0.99]">
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
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
            <div class="flex items-center gap-3 text-emerald-600 mb-3">
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 text-base">Setujui Perjalanan Dinas?</h4>
                    <p class="text-xs text-slate-500">No. SPPD TRQ-2023-0891</p>
                </div>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                Dengan menyetujui, pengajuan ini akan diteruskan secara otomatis ke <strong>Admin Travel Desk</strong> untuk booking tiket/hotel dan ke <strong>Tim Keuangan</strong> untuk persiapan uang muka.
            </p>
            <div class="mb-5">
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan Persetujuan (Opsional):</label>
                <textarea rows="2" placeholder="Contoh: Disetujui, pastikan laporan diserahkan H+3 setelah kepulangan." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2.5">
                <button type="button" onclick="document.getElementById('modal-approve').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </button>
                <a href="{{ route('approver.requests') }}" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition">
                    Ya, Setujui Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- MODAL 2: Minta Revisi -->
    <div id="modal-revision" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
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
                <textarea rows="3" placeholder="Contoh: Mohon ganti pilihan hotel yang tarifnya di bawah plafon Rp 600.000/malam atau lampirkan TOR terbaru." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2.5">
                <button type="button" onclick="document.getElementById('modal-revision').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </button>
                <a href="{{ route('approver.requests') }}" class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shadow-xs transition">
                    Kirim Catatan Revisi
                </a>
            </div>
        </div>
    </div>

    <!-- MODAL 3: Tolak SPPD -->
    <div id="modal-reject" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200">
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
                <textarea rows="3" placeholder="Contoh: Jadwal bertabrakan dengan agenda audit internal atau koordinasi cukup dilakukan via daring." class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2.5">
                <button type="button" onclick="document.getElementById('modal-reject').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </button>
                <a href="{{ route('approver.requests') }}" class="px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-xs transition">
                    Konfirmasi Penolakan
                </a>
            </div>
        </div>
    </div>
</x-app-travel-layout>
