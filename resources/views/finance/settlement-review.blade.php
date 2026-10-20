<x-app-travel-layout>
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
    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-7 shadow-xs mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex flex-wrap items-center gap-2.5 mb-2">
                    <span class="font-mono text-sm font-bold text-indigo-700 bg-indigo-50 px-3 py-1 rounded-lg border border-indigo-200">
                        {{ $settlementId ?? 'SET-2023-0104' }}
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                        Audit Kuitansi Fisik & Pengeluaran Riil
                    </span>
                    <span class="text-xs text-slate-400 font-medium">Ref SPPD: TRQ-2023-0855</span>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Audit Pertanggungjawaban Dinas Semarang</h1>
                <p class="text-xs text-slate-500 mt-1">Pemohon: <strong>Bagus Pratama</strong> (Project Operations) &bull; Pelaksanaan: 12 - 14 Okt 2023</p>
            </div>

            <!-- Settlement Calculation Box -->
            <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-200 text-xs">
                <div class="flex justify-between gap-6 pb-1.5 border-b border-slate-200 text-slate-500">
                    <span>Uang Muka Diterima:</span>
                    <span class="font-bold text-slate-800">Rp 1.000.000</span>
                </div>
                <div class="flex justify-between gap-6 py-1.5 border-b border-slate-200 text-slate-500">
                    <span>Total Pengeluaran Riil:</span>
                    <span class="font-bold text-slate-900">Rp 1.450.000</span>
                </div>
                <div class="flex justify-between gap-6 pt-1.5 text-rose-700 font-extrabold text-sm">
                    <span>Kurang Bayar (Reimbursement):</span>
                    <span>Rp 450.000</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 Columns Layout: Left = Items list, Right = Receipt zoom preview -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-24">
        <!-- Kolom Kiri: Tabel Checklist Validasi Nota (7 Cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
            <h2 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center justify-between">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Daftar Bukti Transaksi Fisik (Nota & Kuitansi)</span>
                </span>
                <span class="text-xs text-slate-400 font-normal">4 Item Nota</span>
            </h2>

            <div class="space-y-3 text-xs">
                <!-- Item 1 -->
                <div class="p-4 rounded-xl border-2 border-sky-400 bg-sky-50/30 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" checked class="w-4 h-4 rounded text-[#0A2558] focus:ring-sky-500 border-slate-300 mt-0.5">
                            <div>
                                <div class="font-bold text-slate-900 text-sm">SPBU Shell MT Haryono Semarang</div>
                                <div class="text-[11px] text-slate-500">Kategori: BBM Operasional Kendaraan Dinas</div>
                                <div class="text-[10px] text-slate-400 mt-1">Tanggal Nota: 12 Okt 2023, 14:22 WIB</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-extrabold text-slate-900 text-sm">Rp 450.000</div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 mt-1">Valid</span>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 bg-white transition">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" checked class="w-4 h-4 rounded text-[#0A2558] focus:ring-sky-500 border-slate-300 mt-0.5">
                            <div>
                                <div class="font-bold text-slate-900 text-sm">Tol Trans Jawa (Gardu Banyumanik)</div>
                                <div class="text-[11px] text-slate-500">Kategori: Struk Tol Elektronik e-Toll</div>
                                <div class="text-[10px] text-slate-400 mt-1">Tanggal: 12 Okt 2023 &bull; Struk Bank Mandiri</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-extrabold text-slate-900 text-sm">Rp 380.000</div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 mt-1">Valid</span>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 bg-white transition">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" checked class="w-4 h-4 rounded text-[#0A2558] focus:ring-sky-500 border-slate-300 mt-0.5">
                            <div>
                                <div class="font-bold text-slate-900 text-sm">Makan Malam Koordinasi Lapangan</div>
                                <div class="text-[11px] text-slate-500">Kategori: Konsumsi Tim Teknis & Mitra</div>
                                <div class="text-[10px] text-slate-400 mt-1">Resto Pesta Keboen Semarang &bull; 13 Okt 2023</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-extrabold text-slate-900 text-sm">Rp 420.000</div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 mt-1">Valid</span>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="p-4 rounded-xl border border-slate-200 hover:border-slate-300 bg-white transition">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" checked class="w-4 h-4 rounded text-[#0A2558] focus:ring-sky-500 border-slate-300 mt-0.5">
                            <div>
                                <div class="font-bold text-slate-900 text-sm">Parkir Inap Stasiun & Lokasi Proyek</div>
                                <div class="text-[11px] text-slate-500">Kategori: Retribusi & Parkir Resmi</div>
                                <div class="text-[10px] text-slate-400 mt-1">12-14 Okt 2023</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-extrabold text-slate-900 text-sm">Rp 200.000</div>
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 mt-1">Valid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Pratinjau Foto Nota / Receipt Viewer (5 Cols) -->
        <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-2 mb-3 border-b border-slate-100">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                        <span>📸</span>
                        <span>Pratinjau Foto Nota Terpilih</span>
                    </h3>
                    <span class="text-[11px] font-semibold text-sky-600">Nota 1 dari 4</span>
                </div>

                <!-- Receipt Image Container -->
                <div class="relative bg-slate-900 rounded-xl p-3 flex items-center justify-center min-h-[360px] overflow-hidden border border-slate-800">
                    <div class="bg-white p-4 rounded shadow-md text-slate-800 text-[11px] font-mono max-w-[240px] w-full transform -rotate-1 select-none">
                        <div class="text-center font-bold border-b pb-2 mb-2">
                            SPBU SHELL 40129<br>
                            JL. MT HARYONO NO. 88 SEMARANG
                        </div>
                        <div class="space-y-1 text-[10px]">
                            <div>TANGGAL : 12-10-2023 14:22</div>
                            <div>POMPA   : 04 (V-POWER DIESEL)</div>
                            <div>VOLUME  : 30.00 LITER</div>
                            <div>HARGA/L : RP 15.000</div>
                            <div class="border-t pt-1 font-bold flex justify-between text-xs">
                                <span>TOTAL</span>
                                <span>RP 450.000</span>
                            </div>
                            <div class="text-[9px] text-slate-500 pt-2 text-center">
                                PEMBAYARAN: KARTU DEBIT MANDIRI<br>
                                NOMOR STRUK: 98129038
                            </div>
                        </div>
                    </div>

                    <!-- Zoom Controls -->
                    <div class="absolute bottom-3 right-3 flex items-center gap-1 bg-black/60 backdrop-blur-xs p-1 rounded-lg text-white text-xs">
                        <button type="button" class="p-1 hover:bg-white/20 rounded" title="Perbesar">+</button>
                        <button type="button" class="p-1 hover:bg-white/20 rounded" title="Perkecil">-</button>
                        <button type="button" class="p-1 hover:bg-white/20 rounded" title="Rotasi">↻</button>
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <span class="text-xs text-slate-500 font-medium">Klik pada item di sebelah kiri untuk mengganti pratinjau nota</span>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-xl bg-slate-50 border border-slate-200/60 text-[11px] text-slate-600">
                <strong>Catatan Auditor Keuangan:</strong> Semua nota fisik telah dicek keasliannya dan memenuhi kriteria audit pajak korporat.
            </div>
        </div>
    </div>

    <!-- Sticky Action Decision Bottom Bar -->
    <div class="fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-md border-t border-slate-200 px-6 py-4 z-40 shadow-lg">
        <div class="max-w-[1440px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-slate-700">
                <span class="font-bold text-slate-900">Keputusan Hasil Audit:</span>
                <span class="text-slate-500 ml-1">Kondisi Kurang Bayar &bull; Menyetujui reimbursement sisa dana sebesar</span>
                <span class="font-extrabold text-rose-600 text-sm ml-1">Rp 450.000</span>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" class="px-4 py-2.5 rounded-xl border border-amber-300 text-amber-800 bg-amber-50 hover:bg-amber-100 font-semibold text-xs transition">
                    Minta Klarifikasi Nota
                </button>
                <a href="{{ route('finance.settlements') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition active:scale-[0.99]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Setujui Settlement & Transfer Sisa</span>
                </a>
            </div>
        </div>
    </div>
</x-app-travel-layout>
