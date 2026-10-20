<x-app-travel-layout>
    <!-- Header Title & Subtitle -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Account Settings</h1>
        <p class="text-sm text-slate-500 font-medium mt-1">Manage your personal information, notifications, and security preferences.</p>
    </div>

    <!-- Layout 2 Kolom (Kiri: Tabs Navigasi | Kanan: Content Form Card) -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">

        <!-- KOLOM KIRI (Sub Navigation Tabs) -->
        <div class="lg:col-span-1 flex flex-col gap-2">
            <!-- Profile Settings (Active) -->
            <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#E2E8F0]/70 text-[#0A2558] font-semibold text-sm transition">
                <svg class="w-4 h-4 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span>Profile Settings</span>
            </a>

            <!-- Notification Preferences -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium text-sm transition">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                <span>Notification Preferences</span>
            </a>

            <!-- Security -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-medium text-sm transition">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <span>Security</span>
            </a>

            <!-- Back Button -->
            <div class="pt-4">
                <a href="{{ route('requests.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition shadow-xs">
                    Back
                </a>
            </div>
        </div>

        <!-- KOLOM KANAN (3 Col Span - Profile Information Card) -->
        <div class="lg:col-span-3 flex flex-col gap-6">

            <!-- Success Alert -->
            @if (session('success'))
                <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 rounded-xl px-5 py-4 text-sm text-emerald-800 font-medium">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Profile Information Card -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-8 shadow-xs">
                <h2 class="text-lg font-bold text-slate-900 mb-6">Profile Information</h2>

                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-8 items-start">

                        <!-- Left Avatar / Initials Area -->
                        <div class="flex flex-col items-center gap-3 shrink-0">
                            <div class="w-28 h-28 rounded-xl overflow-hidden shadow-xs border border-slate-200 bg-[#0A2558] flex items-center justify-center">
                                <span class="text-white text-3xl font-bold tracking-wide">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strstr($user->name, ' ') ?: ' ', 1, 1)) }}
                                </span>
                            </div>
                            <div class="text-center">
                                <span class="inline-block px-3 py-1 text-[11px] font-semibold rounded-full border {{ $user->role_badge_class }}">
                                    {{ $user->role_label }}
                                </span>
                            </div>
                        </div>

                        <!-- Right Form Input Fields Grid -->
                        <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Full Name -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Lengkap</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs @error('name') border-red-400 @enderror"
                                />
                                @error('name')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Employee ID (readonly) -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">NIP / ID Pegawai</label>
                                <input
                                    type="text"
                                    value="{{ $user->employee_id ?? '-' }}"
                                    readonly
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-500 font-medium cursor-not-allowed shadow-2xs"
                                />
                                <p class="mt-1 text-[11px] text-slate-400">Hubungi HR untuk mengubah ID Pegawai.</p>
                            </div>

                            <!-- Department (readonly) -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Departemen</label>
                                <input
                                    type="text"
                                    value="{{ $user->department ?? '-' }}"
                                    readonly
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-500 font-medium cursor-not-allowed shadow-2xs"
                                />
                            </div>

                            <!-- Job Level (readonly) -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Level Jabatan</label>
                                <input
                                    type="text"
                                    value="{{ $user->job_level ?? '-' }}"
                                    readonly
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-500 font-medium cursor-not-allowed shadow-2xs"
                                />
                            </div>

                            <!-- Email Address (readonly) -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Alamat Email</label>
                                <input
                                    type="email"
                                    value="{{ $user->email }}"
                                    readonly
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-500 font-medium cursor-not-allowed shadow-2xs"
                                />
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nomor Telepon</label>
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    placeholder="+62 812-xxxx-xxxx"
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs @error('phone') border-red-400 @enderror"
                                />
                                @error('phone')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons Footer -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('settings.index') }}" class="px-5 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 shadow-2xs transition">
                            Discard
                        </a>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-[#0A2558] hover:bg-[#081c42] rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bank Account Card -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-8 shadow-xs">
                <div class="flex items-center gap-2.5 mb-6">
                    <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5M4.5 21V10.5M3 21h18" />
                    </svg>
                    <h2 class="text-lg font-bold text-slate-900">Rekening Pencairan Dana</h2>
                </div>
                <p class="text-xs text-slate-500 mb-6">Informasi rekening bank untuk pencairan uang muka dan reimbursement perjalanan dinas.</p>

                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    <!-- Hidden name & phone to preserve profile when updating bank -->
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="phone" value="{{ $user->phone }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Bank Name -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Bank</label>
                            <div class="relative">
                                <select
                                    name="bank_name"
                                    class="w-full appearance-none bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10 shadow-2xs @error('bank_name') border-red-400 @enderror"
                                >
                                    @foreach(['BCA', 'BNI', 'BRI', 'Mandiri', 'CIMB Niaga', 'Permata', 'Danamon', 'BTN', 'Jenius (SMBC)', 'OVO', 'GoPay', 'Dana', 'Lainnya'] as $bank)
                                        <option value="{{ $bank }}" {{ old('bank_name', $user->bank_name) === $bank ? 'selected' : '' }}>{{ $bank }}</option>
                                    @endforeach
                                </select>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </div>
                            @error('bank_name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Account Number -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nomor Rekening</label>
                            <input
                                type="text"
                                name="bank_account_number"
                                value="{{ old('bank_account_number', $user->bank_account_number) }}"
                                placeholder="Contoh: 1234567890"
                                class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs @error('bank_account_number') border-red-400 @enderror"
                            />
                            @error('bank_account_number')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Account Holder -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Pemilik Rekening</label>
                            <input
                                type="text"
                                name="bank_account_holder"
                                value="{{ old('bank_account_holder', $user->bank_account_holder) }}"
                                placeholder="Harus sama persis dengan nama di buku tabungan"
                                class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs @error('bank_account_holder') border-red-400 @enderror"
                            />
                            @error('bank_account_holder')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-[11px] text-slate-400">Pastikan nama pemilik rekening sesuai dengan KTP dan buku tabungan untuk menghindari kegagalan transfer.</p>
                        </div>
                    </div>

                    <!-- Verified Badge -->
                    @if ($user->bank_name && $user->bank_account_number)
                        <div class="mt-5 flex items-center gap-2 text-xs text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-2.5">
                            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Rekening terverifikasi — <strong>{{ $user->bank_name }}</strong> {{ $user->bank_account_number }}</span>
                        </div>
                    @else
                        <div class="mt-5 flex items-center gap-2 text-xs text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-4 py-2.5">
                            <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                            <span>Belum ada rekening tersimpan. Isi informasi rekening untuk mengaktifkan pencairan uang muka.</span>
                        </div>
                    @endif

                    <!-- Action Buttons Footer -->
                    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('settings.index') }}" class="px-5 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 shadow-2xs transition">
                            Discard
                        </a>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-[#0A2558] hover:bg-[#081c42] rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
                            Simpan Rekening
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-app-travel-layout>
