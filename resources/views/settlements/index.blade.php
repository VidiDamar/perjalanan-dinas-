<x-app-travel-layout>
    <!-- Header Title & Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Klaim & Pertanggungjawaban Biaya (Settlement)</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Lapor realisasi pengeluaran dinas Anda, unggah bukti struk/kwitansi, dan ajukan reimbursement ke kantor.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('support.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-2xs">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                </svg>
                <span>Panduan SOP Klaim Biaya</span>
            </a>
        </div>
    </div>

    <!-- Main Grid 2 Kolom (Kiri: Daftar Perjalanan Saya | Kanan: Formulir Pelaporan Realisasi) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{
        selectedTrip: 'TRQ-2023-0891'
    }">
        
        <!-- KOLOM KIRI (1 Col Span: Daftar Perjalanan Dinas Milik Pegawai) -->
        <div class="lg:col-span-1 flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <h2 class="font-bold text-slate-900 text-base">Perjalanan Dinas Saya</h2>
                <span class="text-xs font-medium text-slate-400">Pilih agenda</span>
            </div>

            <div class="space-y-3">
                <!-- Item 1: TRQ-2023-0891 (Perlu Dilaporkan - Selected) -->
                <div 
                    @click="selectedTrip = 'TRQ-2023-0891'"
                    class="p-4 rounded-xl border bg-white cursor-pointer transition relative shadow-2xs"
                    :class="selectedTrip === 'TRQ-2023-0891' ? 'border-[#0A2558] ring-1 ring-[#0A2558]/20 before:absolute before:left-0 before:top-3 before:bottom-3 before:w-1 before:bg-[#0A2558] before:rounded-r' : 'border-slate-200/80 hover:border-slate-300'"
                >
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-[#E0F2FE] text-[#0369A1]">
                            TRQ-2023-0891
                        </span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-[#FEF3C7] text-[#D97706]">
                            Draf Laporan
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-bold text-slate-900 text-sm">Jakarta &rarr; Surabaya</div>
                            <div class="text-xs text-slate-500 mt-0.5">Client Meeting TechCorp</div>
                            <div class="text-[11px] text-slate-400 mt-2">Uang Muka Diterima:</div>
                            <div class="font-bold text-slate-900 text-xs">Rp 4.500.000</div>
                        </div>

                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Item 2: TRQ-8870 (Selesai & Dicairkan) -->
                <div 
                    @click="selectedTrip = 'TRQ-8870'"
                    class="p-4 rounded-xl border bg-white cursor-pointer transition shadow-2xs"
                    :class="selectedTrip === 'TRQ-8870' ? 'border-[#0A2558] ring-1 ring-[#0A2558]/20 before:absolute before:left-0 before:top-3 before:bottom-3 before:w-1 before:bg-[#0A2558] before:rounded-r' : 'border-slate-200/80 hover:border-slate-300'"
                >
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-slate-100 text-slate-600">
                            TRQ-8870
                        </span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                            Selesai & Dicairkan
                        </span>
                    </div>

                    <div>
                        <div class="font-bold text-slate-900 text-sm">Tokyo Annual Summit</div>
                        <div class="text-xs text-slate-500 mt-0.5">10 Agu - 16 Agu 2023</div>
                        <div class="text-[11px] text-slate-400 mt-2">Reimbursement Cair:</div>
                        <div class="font-bold text-emerald-600 text-xs">Rp 850.000 (Lunas)</div>
                    </div>
                </div>
            </div>

            <!-- Petunjuk Singkat Pegawai -->
            <div class="p-4 rounded-2xl bg-sky-50/70 border border-sky-100 text-xs text-slate-600 space-y-1.5 mt-2">
                <div class="font-bold text-sky-900 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span>Ketentuan Laporan:</span>
                </div>
                <p class="leading-relaxed text-slate-600">
                    Klaim pertanggungjawaban dinas wajib diserahkan maksimal <strong>7 hari kerja</strong> setelah kembali dari perjalanan dinas dengan menyertakan bukti fisik/digital struk pembayaran.
                </p>
            </div>
        </div>

        <!-- KOLOM KANAN (2 Col Span: Formulir Pelaporan Realisasi Pengeluaran) -->
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-slate-900 text-base">Formulir Laporan Pertanggungjawaban (Settlement)</h2>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-[#FEF3C7] text-[#D97706] border border-[#FDE68A]">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    <span>Status: Draf Pegawai</span>
                </span>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs space-y-6">
                
                <!-- Trip Summary Header -->
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 pb-6 border-b border-slate-100">
                    <div>
                        <div class="flex items-center gap-2.5">
                            <h2 class="text-xl md:text-2xl font-bold text-[#0A2558]">TRQ-2023-0891</h2>
                            <span class="text-xs px-2.5 py-0.5 rounded-full font-semibold bg-sky-50 text-sky-700 border border-sky-100">26 - 28 Okt 2023</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-1">
                            Jakarta &rarr; Surabaya (Client Meeting &mdash; TechCorp Infra)
                        </p>
                    </div>

                    <div class="text-left sm:text-right">
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400">PEMOHON / PEGAWAI</div>
                        <div class="font-bold text-slate-900 text-sm">Budi Santoso</div>
                        <div class="text-[11px] text-slate-400 font-medium">Senior Engineer &bull; NIP: EMP-2023-084</div>
                    </div>
                </div>

                <!-- Expense Line Items & Financial Summary Box -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="font-bold text-slate-800 text-sm">Rincian Pengeluaran Aktual (Real Expenses)</span>
                        <button type="button" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0A2558] hover:text-sky-700 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m-4-4h8" />
                            </svg>
                            <span>+ Tambah Pengeluaran</span>
                        </button>
                    </div>

                    <!-- Items Table -->
                    <div class="border border-slate-200/80 rounded-xl overflow-hidden mb-5">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-200/80">
                                <tr>
                                    <th class="px-4 py-3">Kategori</th>
                                    <th class="px-4 py-3">Keterangan Biaya</th>
                                    <th class="px-4 py-3">Bukti Pembayaran</th>
                                    <th class="px-4 py-3 text-right">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-800">Tiket Pesawat</td>
                                    <td class="px-4 py-3 text-slate-600">Tiket PP CGK - SUB (Garuda GA-312/325)</td>
                                    <td class="px-4 py-3 text-emerald-600 font-medium flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                        E-Ticket & Boarding Pass
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-slate-900 text-right">3.500.000</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-800">Hotel / Penginapan</td>
                                    <td class="px-4 py-3 text-slate-600">JW Marriott Surabaya (2 Malam)</td>
                                    <td class="px-4 py-3 text-emerald-600 font-medium flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                        Invoice_Hotel.pdf
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-slate-900 text-right">800.000</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-800">Transportasi Lokal</td>
                                    <td class="px-4 py-3 text-slate-600">Taksi Bandara Juanda & Transport Operasional</td>
                                    <td class="px-4 py-3 text-emerald-600 font-medium flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                        Struk_Taksi.jpg
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-slate-900 text-right">450.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- 3 Metric Columns: Rekapitulasi Keuangan Otomatis (User Friendly) -->
                    <div class="border border-slate-200 rounded-2xl p-5 bg-slate-50/50 grid grid-cols-1 md:grid-cols-3 gap-6 divide-y md:divide-y-0 md:divide-x divide-slate-200">
                        <!-- Total Uang Muka (A) -->
                        <div class="pt-3 md:pt-0">
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                UANG MUKA DITERIMA (A)
                            </div>
                            <div class="text-xl font-extrabold text-slate-800 mt-1">
                                Rp 4.500.000
                            </div>
                            <div class="text-[11px] text-slate-400 mt-1">Ditransfer sebelum berangkat</div>
                        </div>

                        <!-- Realisasi Pengeluaran (B) -->
                        <div class="pt-3 md:pt-0 md:pl-6">
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                TOTAL REALISASI BIAYA (B)
                            </div>
                            <div class="text-xl font-extrabold text-[#0A2558] mt-1">
                                Rp 4.750.000
                            </div>
                            <div class="text-[11px] text-slate-400 mt-1">Total seluruh bukti struk</div>
                        </div>

                        <!-- Selisih (B - A) -->
                        <div class="pt-3 md:pt-0 md:pl-6 flex flex-col justify-between">
                            <div>
                                <div class="text-[11px] font-semibold text-emerald-700 uppercase tracking-wider">
                                    HAK REIMBURSEMENT (B - A)
                                </div>
                                <div class="text-xl font-extrabold text-emerald-600 mt-1">
                                    + Rp 250.000
                                </div>
                            </div>
                            <div class="mt-2">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Rekening Pencairan -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                    <div>
                        <div class="font-bold text-slate-800">Rekening Tujuan Pencairan Reimbursement:</div>
                        <div class="text-slate-500 mt-0.5">Bank Mandiri &bull; No. Rek: 123-00-9876543-1 (a/n Budi Santoso)</div>
                    </div>
                    <a href="{{ route('settings.index') }}" class="font-semibold text-[#0A2558] hover:underline self-start sm:self-auto">
                        Ubah Rekening di Profil
                    </a>
                </div>

                <!-- Upload Dokumen / Struk Tambahan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-2">Unggah Bukti Struk & Kwitansi Tambahan</label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-5 flex flex-col items-center justify-center text-center hover:bg-slate-50/60 transition cursor-pointer group">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-sky-600 transition mb-1.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <div class="text-xs text-slate-600 font-medium">
                            Tarik berkas struk di sini atau <span class="text-[#0A2558] font-bold underline">pilih file</span>
                        </div>
                        <div class="text-[10px] text-slate-400 mt-0.5">Format file yang didukung: JPG, PNG, PDF (maks 5MB per berkas)</div>
                    </div>
                </div>

                <!-- Remarks / Justifikasi Pegawai -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Catatan / Keterangan Pegawai (Opsional)</label>
                    <textarea 
                        rows="2" 
                        placeholder="Contoh: Terjadi selisih biaya taksi Rp 250.000 karena meeting dengan tim klien berlangsung hingga malam hari dan menggunakan taksi resmi bandara." 
                        class="w-full bg-white border border-slate-200 rounded-xl p-3.5 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs resize-none"
                    ></textarea>
                </div>

                <!-- Action Button Footer -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('requests.index') }}" class="px-5 py-2.5 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-2xs">
                        Kembali
                    </a>
                    <button type="button" class="px-5 py-2.5 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200/80 rounded-xl transition">
                        Simpan Draf
                    </button>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 text-xs font-semibold text-white bg-[#0A2558] hover:bg-[#071d47] rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        <span>Kirim Laporan Pertanggungjawaban</span>
                    </button>
                </div>

            </div>
        </div>

    </div>
</x-app-travel-layout>
