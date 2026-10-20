<x-app-travel-layout>
    <!-- Flash Notifications -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[11px]">✓</span>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold text-sm">&times;</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs shadow-xs">
            <div class="font-bold mb-1">Terdapat kesalahan dalam formulir settlement:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header Title & Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Klaim & Pertanggungjawaban Biaya (Settlement)</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Lapor realisasi pengeluaran riil dinas Anda, unggah foto bukti struk/kwitansi, dan ajukan reimbursement ke kantor.</p>
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

    <!-- Main Grid 2 Kolom (Kiri: Daftar Agenda & Riwayat | Kanan: Form Pelaporan / Detail) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{
        selectedTripId: '{{ $selectedTrip?->id }}',
        cashAdvance: {{ $selectedTrip?->cash_advance_requested ?? 1000000 }},
        items: [
            { category: 'BBM/Tol', merchant_name: 'SPBU Pertamina', expense_date: '{{ date('Y-m-d') }}', amount: 350000, description: 'BBM kendaraan dinas' }
        ],
        addItem() {
            this.items.push({ category: 'Konsumsi', merchant_name: '', expense_date: '{{ date('Y-m-d') }}', amount: 0, description: '' });
        },
        removeItem(index) {
            if (this.items.length > 1) {
                this.items.splice(index, 1);
            }
        },
        get totalActual() {
            return this.items.reduce((sum, item) => sum + (parseFloat(item.amount) || 0), 0);
        },
        get difference() {
            return this.totalActual - this.cashAdvance;
        }
    }">
        <!-- KOLOM KIRI: Daftar Agenda Dinas & Settlement User (1 Col Span) -->
        <div class="lg:col-span-1 flex flex-col gap-4">
            <!-- Section 1: Perjalanan yang Siap Dilaporkan -->
            <div>
                <h2 class="font-bold text-slate-900 text-sm mb-2">Pilih Perjalanan untuk Diklaim</h2>
                <div class="space-y-3">
                    @forelse($availableTrips as $trip)
                        <a 
                            href="{{ route('settlements.index', ['trip_id' => $trip->id]) }}"
                            class="block p-4 rounded-xl border bg-white cursor-pointer transition relative shadow-2xs {{ $selectedTrip?->id === $trip->id ? 'border-[#0A2558] ring-1 ring-[#0A2558]/20 before:absolute before:left-0 before:top-3 before:bottom-3 before:w-1 before:bg-[#0A2558] before:rounded-r' : 'border-slate-200/80 hover:border-slate-300' }}"
                        >
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-[#E0F2FE] text-[#0369A1]">
                                    {{ $trip->request_number }}
                                </span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                    Siap Dilaporkan
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">{{ $trip->origin_city }} &rarr; {{ $trip->destination_city }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ $trip->purpose }}</div>
                                    <div class="text-[11px] text-slate-400 mt-2">Uang Muka Diterima:</div>
                                    <div class="font-bold text-slate-900 text-xs">Rp {{ number_format($trip->cash_advance_requested, 0, ',', '.') }}</div>
                                </div>

                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-center text-xs text-slate-500">
                            Semua perjalanan dinas Anda telah diselesaikan pertanggungjawabannya.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Section 2: Riwayat Settlement yang Pernah Diajukan -->
            <div class="mt-4">
                <h2 class="font-bold text-slate-900 text-sm mb-2">Riwayat Klaim Terdahulu</h2>
                <div class="space-y-3">
                    @forelse($settlements as $st)
                        <div class="p-3.5 rounded-xl border border-slate-200 bg-white text-xs shadow-2xs">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-mono font-bold text-[#0A2558]">{{ $st->settlement_number }}</span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $st->status_badge_class }}">
                                    {{ $st->status_label }}
                                </span>
                            </div>
                            <div class="font-semibold text-slate-800">{{ $st->travelRequest->purpose ?? 'Perjalanan Dinas' }}</div>
                            <div class="flex justify-between items-center mt-2 pt-2 border-t border-slate-100">
                                <span class="text-slate-500">Realisasi Nota:</span>
                                <span class="font-bold text-slate-900">Rp {{ number_format($st->total_actual_expense, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-[11px] mt-0.5">
                                <span class="text-slate-500">Selisih ({{ $st->settlement_type === 'reimbursement' ? 'Reimbursement' : 'Setor Sisa' }}):</span>
                                <span class="font-bold {{ $st->settlement_type === 'reimbursement' ? 'text-rose-600' : 'text-emerald-600' }}">
                                    Rp {{ number_format($st->difference_amount, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-xs text-slate-400 text-center py-2">Belum ada riwayat klaim terdahulu.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: Formulir Pelaporan Realisasi Biaya & Nota (2 Col Span) -->
        <div class="lg:col-span-2">
            @if($selectedTrip)
                <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
                    <!-- Header Form -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-6 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold font-mono text-[#0A2558] bg-slate-100 px-2.5 py-1 rounded">
                                Form Klaim SPPD: {{ $selectedTrip->request_number }}
                            </span>
                            <h2 class="text-lg font-bold text-slate-900 mt-2">{{ $selectedTrip->purpose }}</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Rute: {{ $selectedTrip->origin_city }} &rarr; {{ $selectedTrip->destination_city }} ({{ $selectedTrip->duration_days }} Hari)</p>
                        </div>

                        <!-- Real-time Balance Box -->
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-right">
                            <span class="text-slate-500">Uang Muka Diterima:</span>
                            <div class="font-bold text-slate-800 text-sm">Rp {{ number_format($selectedTrip->cash_advance_requested, 0, ',', '.') }}</div>
                            <div class="text-[11px] text-slate-400 mt-1">Status: Siap Dipertanggungjawabkan</div>
                        </div>
                    </div>

                    <!-- REAL FORM SUBMISSION -->
                    <form action="{{ route('settlements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="travel_request_id" value="{{ $selectedTrip->id }}">

                        <!-- Dynamic Expense Items with Alpine -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Daftar Bukti Pengeluaran Riil (Nota / Kwitansi)</label>
                                <button type="button" @click="addItem()" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0A2558] hover:text-sky-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span>Tambah Baris Nota</span>
                                </button>
                            </div>

                            <div class="space-y-4">
                                <template x-for="(item, index) in items" :key="index">
                                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-3 text-xs relative">
                                        <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                                            <span class="font-bold text-slate-700" x-text="'Item Nota #' + (index + 1)"></span>
                                            <button type="button" @click="removeItem(index)" x-show="items.length > 1" class="text-rose-600 hover:text-rose-800 font-bold text-xs" title="Hapus baris">
                                                ✕ Hapus
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                            <!-- Category -->
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Kategori Pengeluaran</label>
                                                <select :name="'items[' + index + '][category]'" x-model="item.category" class="w-full bg-white border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs font-medium focus:outline-none focus:ring-1 focus:ring-sky-500">
                                                    <option value="BBM/Tol">BBM & Tol</option>
                                                    <option value="Akomodasi">Akomodasi / Penginapan</option>
                                                    <option value="Konsumsi">Konsumsi / Makan</option>
                                                    <option value="Transport Lokal">Transportasi Lokal</option>
                                                    <option value="Parkir/Lainnya">Parkir & Retribusi</option>
                                                </select>
                                            </div>

                                            <!-- Merchant Name -->
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Toko / Tempat</label>
                                                <input type="text" :name="'items[' + index + '][merchant_name]'" x-model="item.merchant_name" placeholder="Contoh: SPBU Shell, Resto Santika" required class="w-full bg-white border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-sky-500">
                                            </div>

                                            <!-- Expense Date -->
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Tanggal Transaksi</label>
                                                <input type="date" :name="'items[' + index + '][expense_date]'" x-model="item.expense_date" required class="w-full bg-white border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-sky-500">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <!-- Amount -->
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nominal Riil (Rp) <span class="text-rose-500">*</span></label>
                                                <input type="number" :name="'items[' + index + '][amount]'" x-model.number="item.amount" min="1000" required class="w-full bg-white border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs font-bold text-slate-900 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                            </div>

                                            <!-- Receipt Upload -->
                                            <div>
                                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Foto Bukti Struk / Kwitansi</label>
                                                <input type="file" :name="'items[' + index + '][receipt]'" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 cursor-pointer">
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div>
                                            <input type="text" :name="'items[' + index + '][description]'" x-model="item.description" placeholder="Keterangan singkat pengeluaran..." class="w-full bg-white border border-slate-200 rounded-lg px-2.5 py-1 text-xs text-slate-600 focus:outline-none focus:ring-1 focus:ring-sky-500">
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Real Settlement Calculation Summary Card -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                            <div class="flex justify-between items-center text-slate-600">
                                <span>Total Realisasi Pengeluaran Riil (Nota):</span>
                                <span class="font-bold text-slate-900 text-sm">Rp <span x-text="new Intl.NumberFormat('id-ID').format(totalActual)"></span></span>
                            </div>
                            <div class="flex justify-between items-center text-slate-600">
                                <span>Uang Muka Diterima (Kasbon):</span>
                                <span class="font-semibold text-slate-800">Rp {{ number_format($selectedTrip->cash_advance_requested, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-slate-200 text-sm font-extrabold">
                                <span x-show="difference >= 0" class="text-rose-700">Kurang Bayar (Reimbursement Dicairkan ke Anda):</span>
                                <span x-show="difference < 0" class="text-emerald-700" style="display: none;">Lebih Bayar (Sisa Uang Disetor ke Perusahaan):</span>
                                <span :class="difference >= 0 ? 'text-rose-700' : 'text-emerald-700'">
                                    Rp <span x-text="new Intl.NumberFormat('id-ID').format(Math.abs(difference))"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Notes Textarea -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan Tambahan untuk Tim Keuangan</label>
                            <textarea name="notes" rows="2" placeholder="Contoh: Bukti tol menggunakan e-toll mandiri, struk fisik dilampirkan lengkap." class="w-full text-xs bg-white border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
                        </div>

                        <!-- Action Submit -->
                        <div class="pt-2 flex items-center justify-end gap-3">
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 text-xs font-bold text-white bg-[#0A2558] hover:bg-[#081c42] rounded-xl shadow-md transition duration-150 active:scale-[0.99]">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                </svg>
                                <span>Kirim Pertanggungjawaban (Settlement)</span>
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-200/90 p-12 text-center shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-500 flex items-center justify-center mx-auto mb-3 text-xl">
                        📋
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Pilih Perjalanan Dinas untuk Diklaim</h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 mb-4">
                        Pilih salah satu agenda perjalanan di panel kiri untuk mulai mengisi nota realisasi pengeluaran dan mengajukan reimbursement.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-travel-layout>
