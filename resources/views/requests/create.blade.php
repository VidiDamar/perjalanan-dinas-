<x-app-travel-layout>
    <!-- Header Title & Step Indicator -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
            <div>
                <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Ajukan Perjalanan Dinas Baru</h1>
                <p class="text-sm text-slate-500 font-medium mt-1">Lengkapi rincian agenda tugas dinas, akomodasi, dan estimasi biaya operasional Anda.</p>
            </div>
            <a href="{{ route('requests.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 shadow-2xs transition self-start sm:self-auto">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- 3-Step Simple Progress Indicator -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-4 shadow-2xs">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                <div class="flex items-center gap-2.5 text-[#0A2558] font-bold">
                    <div class="w-6 h-6 rounded-full bg-[#0A2558] text-white flex items-center justify-center text-[11px]">1</div>
                    <span>1. Detail Tujuan & Jadwal</span>
                </div>
                <div class="flex items-center gap-2.5 text-[#0A2558] font-bold sm:border-l sm:border-slate-100 sm:pl-3">
                    <div class="w-6 h-6 rounded-full bg-[#0A2558] text-white flex items-center justify-center text-[11px]">2</div>
                    <span>2. Estimasi Biaya & Uang Muka</span>
                </div>
                <div class="flex items-center gap-2.5 text-[#0A2558] font-bold sm:border-l sm:border-slate-100 sm:pl-3">
                    <div class="w-6 h-6 rounded-full bg-[#0A2558] text-white flex items-center justify-center text-[11px]">3</div>
                    <span>3. Dokumen / Surat Undangan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Alerts -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs shadow-xs">
            <div class="font-bold mb-1">Terdapat kesalahan dalam pengisian formulir:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Real Functional Form with Alpine Live Calculations -->
    <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{
        startDate: '{{ old('start_date', date('Y-m-d', strtotime('+3 days'))) }}',
        endDate: '{{ old('end_date', date('Y-m-d', strtotime('+5 days'))) }}',
        transportCost: {{ old('estimated_transport', 2500000) }},
        hotelCost: {{ old('estimated_hotel', 1300000) }},
        otherCost: {{ old('estimated_other', 0) }},
        perDiemCustom: {{ old('estimated_per_diem', 0) }},
        cashAdvanceCustom: {{ old('cash_advance_requested', 0) }},
        perDiemManual: {{ old('estimated_per_diem', 0) > 0 ? 'true' : 'false' }},
        cashAdvanceManual: {{ old('cash_advance_requested', 0) > 0 ? 'true' : 'false' }},
        dailyPerDiemRate: {{ $user->getDailyPerDiemLimit() }},
        hotelLimitRate: {{ $user->getHotelLimit() }},

        get durationDays() {
            if (!this.startDate || !this.endDate) return 1;
            let start = new Date(this.startDate);
            let end = new Date(this.endDate);
            let diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
            return diff > 0 ? diff : 1;
        },

        get perDiemSuggested() {
            return this.durationDays * this.dailyPerDiemRate;
        },

        get perDiemValue() {
            return this.perDiemManual ? this.perDiemCustom : this.perDiemSuggested;
        },

        get cashAdvanceSuggested() {
            return this.perDiemValue;
        },

        get cashAdvanceValue() {
            return this.cashAdvanceManual ? this.cashAdvanceCustom : this.cashAdvanceSuggested;
        },

        get totalBudget() {
            return (parseFloat(this.transportCost) || 0) + (parseFloat(this.hotelCost) || 0) + (parseFloat(this.perDiemValue) || 0) + (parseFloat(this.otherCost) || 0);
        },

        get nightlyHotelRate() {
            let nights = Math.max(1, this.durationDays - 1);
            return (parseFloat(this.hotelCost) || 0) / nights;
        },

        get isHotelOverLimit() {
            return this.nightlyHotelRate > this.hotelLimitRate;
        },

        resetPerDiem() {
            this.perDiemManual = false;
            this.perDiemCustom = 0;
        },

        resetCashAdvance() {
            this.cashAdvanceManual = false;
            this.cashAdvanceCustom = 0;
        }
    }">
        @csrf

        <!-- CARD 1: Trip Details -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
            <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg mb-6 pb-4 border-b border-slate-100">
                <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>
                <span>Rincian Maksud & Tujuan Dinas</span>
            </div>

            <div class="space-y-5">
                <!-- Trip Purpose -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Keperluan / Agenda Tugas Dinas <span class="text-rose-500">*</span></label>
                    <input 
                        type="text" 
                        name="purpose"
                        value="{{ old('purpose') }}"
                        placeholder="Contoh: Client Meeting, Instalasi Infrastruktur Server, Pelatihan Partner" 
                        required
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                    />
                </div>

                <!-- Origin & Destination City -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kota Asal Keberangkatan <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="origin_city"
                            value="{{ old('origin_city', 'Jakarta (CGK)') }}"
                            required
                            class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kota Tujuan Tugas <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="destination_city"
                            value="{{ old('destination_city') }}"
                            placeholder="Contoh: Surabaya (SUB), Bali (DPS), Bandung (BDG)" 
                            required
                            class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                        />
                    </div>
                </div>

                <!-- Departure Date & Return Date -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Berangkat <span class="text-rose-500">*</span></label>
                        <input 
                            type="date" 
                            name="start_date"
                            x-model="startDate"
                            required
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Kepulangan <span class="text-rose-500">*</span></label>
                        <input 
                            type="date" 
                            name="end_date"
                            x-model="endDate"
                            required
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Durasi Dihitung</label>
                        <div class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-[#0A2558] flex items-center justify-between">
                            <span x-text="durationDays + ' Hari Kalender'"></span>
                            <span class="text-xs text-slate-400 font-normal">Otomatis</span>
                        </div>
                    </div>
                </div>

                <!-- Transport Mode & Preferences -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pilihan Moda Transportasi Utama <span class="text-rose-500">*</span></label>
                        <select name="transport_mode" class="w-full appearance-none bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs cursor-pointer">
                            <option value="Flight" {{ old('transport_mode') == 'Flight' ? 'selected' : '' }}>Pesawat Udara (Flight)</option>
                            <option value="Train" {{ old('transport_mode') == 'Train' ? 'selected' : '' }}>Kereta Api (KAI / Whoosh)</option>
                            <option value="Company Car" {{ old('transport_mode') == 'Company Car' ? 'selected' : '' }}>Mobil Dinas Kantor</option>
                            <option value="Rental Car" {{ old('transport_mode') == 'Rental Car' ? 'selected' : '' }}>Mobil Sewa (Rental)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan Preferensi Tiket & Hotel</label>
                        <input 
                            type="text" 
                            name="flight_hotel_preference"
                            value="{{ old('flight_hotel_preference') }}"
                            placeholder="Contoh: Penerbangan pagi Garuda/Batik, Hotel dekat lokasi klien" 
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: Estimated Expenses & Policy Engine -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
            <div class="flex items-center justify-between flex-wrap gap-3 pb-4 mb-6 border-b border-slate-100">
                <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg">
                    <svg class="w-5 h-5 text-[#0A2558]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                        <circle cx="12" cy="15" r="2" />
                    </svg>
                    <span>Estimasi Anggaran & Plafon Biaya Jabatan</span>
                </div>

                <!-- Dynamic Real-Time Policy Compliance Badge -->
                <div x-show="!isHotelOverLimit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Sesuai Plafon Kebijakan (In-Policy)</span>
                </div>

                <div x-show="isHotelOverLimit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200" style="display: none;">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Peringatan: Tarif Hotel Melebihi Plafon</span>
                </div>
            </div>

            <!-- Expense Inputs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                <!-- Transport Estimate -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Estimasi Tiket Transportasi (Pesawat/Kereta PP)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 font-bold">Rp</span>
                        <input 
                            type="number" 
                            name="estimated_transport"
                            x-model.number="transportCost"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                        />
                    </div>
                </div>

                <!-- Hotel Estimate -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block font-semibold text-slate-700">Estimasi Akomodasi Hotel (Total)</label>
                        <span class="text-[11px] text-slate-400">Plafon: Rp {{ number_format($user->getHotelLimit(), 0, ',', '.') }}/malam</span>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 font-bold">Rp</span>
                        <input 
                            type="number" 
                            name="estimated_hotel"
                            x-model.number="hotelCost"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                        />
                    </div>
                </div>

                <!-- Per Diem (Editable with auto-suggest) -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block font-semibold text-slate-700">Uang Saku Harian (Per Diem) · Uang Muka</label>
                        <div class="flex items-center gap-2">
                            <span class="text-[11px] text-emerald-600 font-semibold">
                                Saran: Rp {{ number_format($user->getDailyPerDiemLimit(), 0, ',', '.') }} × <span x-text="durationDays"></span> hari
                            </span>
                            <button
                                type="button"
                                @click="perDiemManual = !perDiemManual; if (!perDiemManual) perDiemCustom = 0;"
                                class="text-[11px] font-semibold px-2 py-0.5 rounded-lg transition"
                                :class="perDiemManual ? 'bg-sky-100 text-sky-700 border border-sky-300' : 'bg-slate-100 text-slate-500 border border-slate-200'"
                                x-text="perDiemManual ? '✏️ Custom' : '⚡ Otomatis'"
                            ></button>
                        </div>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 font-bold">Rp</span>
                        <!-- Auto mode: readonly, shows computed value -->
                        <input
                            x-show="!perDiemManual"
                            type="number"
                            name="estimated_per_diem"
                            :value="perDiemSuggested"
                            readonly
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-[#0A2558] cursor-not-allowed shadow-2xs"
                        />
                        <!-- Manual mode: editable -->
                        <input
                            x-show="perDiemManual"
                            type="number"
                            name="estimated_per_diem"
                            x-model.number="perDiemCustom"
                            :placeholder="perDiemSuggested"
                            min="0"
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-sky-400 rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                            style="display:none"
                        />
                    </div>
                    <p class="mt-1.5 text-[11px] text-slate-400" x-show="!perDiemManual">Dihitung otomatis dari plafon jabatan × durasi. Klik <strong>Otomatis</strong> untuk mengisi manual.</p>
                    <p class="mt-1.5 text-[11px] text-sky-600 font-medium" x-show="perDiemManual" style="display:none">Mode custom aktif — isi nominal per diem sesuai kebutuhan aktual perjalanan.</p>
                </div>

                <!-- Other / Operational -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Biaya Operasional Lainnya (Opsional)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 font-bold">Rp</span>
                        <input 
                            type="number" 
                            name="estimated_other"
                            x-model.number="otherCost"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                        />
                    </div>
                </div>
            </div>

            <!-- Total Budget Summary Card -->
            <div class="mt-6 p-4 rounded-xl bg-slate-50 border border-slate-200 flex flex-col gap-4">
                <!-- Uang Muka (Cash Advance) - Editable -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-xs font-semibold text-slate-700">💳 Kasbon / Uang Muka yang Diminta</label>
                            <button
                                type="button"
                                @click="cashAdvanceManual = !cashAdvanceManual; if (!cashAdvanceManual) cashAdvanceCustom = 0;"
                                class="text-[11px] font-semibold px-2 py-0.5 rounded-lg transition"
                                :class="cashAdvanceManual ? 'bg-sky-100 text-sky-700 border border-sky-300' : 'bg-slate-100 text-slate-500 border border-slate-200'"
                                x-text="cashAdvanceManual ? '✏️ Custom' : '⚡ Sama dengan Per Diem'"
                            ></button>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 font-bold text-sm">Rp</span>
                            <!-- Auto mode -->
                            <input
                                x-show="!cashAdvanceManual"
                                type="number"
                                name="cash_advance_requested"
                                :value="cashAdvanceValue"
                                readonly
                                class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-[#0A2558] cursor-not-allowed shadow-2xs"
                            />
                            <!-- Manual mode -->
                            <input
                                x-show="cashAdvanceManual"
                                type="number"
                                name="cash_advance_requested"
                                x-model.number="cashAdvanceCustom"
                                :placeholder="cashAdvanceValue"
                                min="0"
                                class="w-full pl-10 pr-4 py-2.5 bg-white border border-sky-400 rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:ring-1 focus:ring-sky-500 shadow-2xs"
                                style="display:none"
                            />
                        </div>
                        <p class="mt-1 text-[11px] text-slate-400">
                            Akan ditransfer ke rekening <strong>{{ $user->bank_name ?? '-' }} {{ $user->bank_account_number ?? '-' }}</strong> setelah disetujui.
                        </p>
                    </div>
                    <div class="sm:text-right shrink-0">
                        <span class="text-xs text-slate-500 font-medium">Total Estimasi Anggaran:</span>
                        <div class="text-xl font-extrabold text-[#0A2558]">
                            Rp <span x-text="new Intl.NumberFormat('id-ID').format(totalBudget)"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 3: Supporting Documents File Upload -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
            <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg mb-6 pb-4 border-b border-slate-100">
                <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                <span>Dokumen Pendukung / Surat Tugas / Undangan</span>
            </div>

            <div class="border-2 border-dashed border-slate-300 hover:border-sky-400 rounded-2xl p-6 flex flex-col items-center justify-center text-center bg-slate-50/50 transition">
                <svg class="w-10 h-10 text-sky-500 mb-2" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                </svg>
                <div class="text-sm font-semibold text-slate-700 mb-1">
                    Pilih berkas Surat Tugas, TOR, atau Surat Undangan
                </div>
                <div class="text-[11px] text-slate-400 mb-3">
                    Format: PDF, JPG, PNG (Maksimal 10 MB)
                </div>
                <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0A2558] file:text-white hover:file:bg-[#081c42] cursor-pointer" />
            </div>
        </div>

        <!-- Footer Action Buttons -->
        <div class="pt-2 flex items-center justify-end gap-3">
            <a href="{{ route('requests.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 shadow-2xs transition">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center gap-2 px-7 py-2.5 text-sm font-bold text-white bg-[#0A2558] hover:bg-[#081c42] rounded-xl shadow-md transition duration-150 active:scale-[0.99]">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
                <span>Kirim Pengajuan SPPD Resmi</span>
            </button>
        </div>
    </form>
</x-app-travel-layout>
