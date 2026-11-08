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

    <!-- Header Page with Context Badges -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Portal Persetujuan Pejabat Berwenang
            </div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Persetujuan Perjalanan Dinas</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Tinjau urgensi tugas, kesesuaian anggaran, dan berikan persetujuan SPPD bawahan Anda.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('approver.delegation') }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-semibold text-sm py-2.5 px-4 rounded-xl shadow-2xs transition duration-150">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <polyline points="16 11 18 13 22 9"/>
                </svg>
                <span>Atur Delegasi Wewenang</span>
            </a>
        </div>
    </div>

    <!-- 4 KPI Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1: Menunggu Tindakan -->
        <div class="bg-white rounded-2xl border border-amber-200 p-5 shadow-2xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Perlu Tindakan Segera</span>
                <span class="p-2 bg-amber-50 rounded-xl text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight tabular-nums">{{ $stats['pending_count'] }} <span class="text-sm font-semibold text-amber-600 ml-1">SPPD</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                <span>Menunggu verifikasi otorisasi</span>
            </p>
        </div>

        <!-- Card 2: Disetujui Bulan Ini -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-2xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Disetujui Bulan Ini</span>
                <span class="p-2 bg-emerald-50 rounded-xl text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight tabular-nums">{{ $stats['approved_count'] }} <span class="text-sm font-semibold text-emerald-600 ml-1">SPPD</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5 tabular-nums">Komitmen Rp {{ number_format($stats['committed_budget'], 0, ',', '.') }}</p>
        </div>

        <!-- Card 3: Permintaan Revisi -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-2xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Dalam Revisi Pemohon</span>
                <span class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight tabular-nums">{{ $stats['revision_count'] }} <span class="text-sm font-semibold text-sky-600 ml-1">SPPD</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5">Penyesuaian tiket & hotel dinas</p>
        </div>

        <!-- Card 4: Status Delegasi -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-2xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Status Delegasi Wewenang</span>
                <span class="p-2 bg-slate-100 rounded-xl text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </span>
            </div>
            @if($stats['active_delegation'])
                <div class="text-base font-bold text-emerald-700 tracking-tight mt-1">Aktif ({{ $stats['active_delegation']->delegate->name ?? 'Pejabat Pengganti' }})</div>
                <p class="text-xs text-slate-500 font-medium mt-1">Sampai {{ $stats['active_delegation']->end_date->format('d M Y') }}</p>
            @else
                <div class="text-lg font-bold text-slate-700 tracking-tight mt-1">Non-Aktif</div>
                <p class="text-xs text-slate-500 font-medium mt-1">Anda menangani approval secara langsung</p>
            @endif
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-2xs mb-6">
        <form action="{{ route('approver.requests') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
            <!-- Filter Status -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Status Pengajuan</label>
                <div class="relative">
                    <select name="status" class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 cursor-pointer pr-10">
                        <option value="Semua Status" {{ request('status') === 'Semua Status' ? 'selected' : '' }}>Semua Status</option>
                        <option value="pending_approval" {{ request('status') === 'pending_approval' ? 'selected' : '' }}>Menunggu Persetujuan ({{ $stats['pending_count'] }})</option>
                        <option value="revision_required" {{ request('status') === 'revision_required' ? 'selected' : '' }}>Perlu Revisi ({{ $stats['revision_count'] }})</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui ({{ $stats['approved_count'] }})</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Filter Departemen -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Divisi / Departemen</label>
                <div class="relative">
                    <select name="department" class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 cursor-pointer pr-10">
                        <option value="Semua Divisi">Semua Divisi Binaan</option>
                        <option value="Engineering" {{ request('department') === 'Engineering' ? 'selected' : '' }}>Engineering & IT</option>
                        <option value="Project Operations" {{ request('department') === 'Project Operations' ? 'selected' : '' }}>Project Operations</option>
                        <option value="Quality Assurance" {{ request('department') === 'Quality Assurance' ? 'selected' : '' }}>Quality Assurance</option>
                    </select>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Search Keyword -->
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Cari No. SPPD / Pemohon</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: TRQ-2023-0891, Ahmad..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-1 focus:ring-sky-500">
            </div>

            <!-- Search Action -->
            <div>
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-2xs transition duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <span>Terapkan Filter</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Table: Antrean Pengajuan SPPD Menunggu Tindakan -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden mb-8">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Daftar Pengajuan Menunggu Tinjauan Anda</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pengajuan di bawah memerlukan persetujuan Manager sebelum diteruskan ke Travel Desk & Keuangan.</p>
            </div>
            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 tabular-nums">
                {{ $requests->count() }} Pengajuan
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Pemohon</th>
                        <th class="py-3.5 px-4">No. SPPD & Keperluan</th>
                        <th class="py-3.5 px-4">Rute & Jadwal</th>
                        <th class="py-3.5 px-4">Total Biaya & Kebijakan</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-5 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($requests as $req)
                        @php
                            $nights = max(1, $req->duration_days - 1);
                            $nightlyHotel = $req->hotel_cost / $nights;
                            $isOverHotel = $req->user && $nightlyHotel > $req->user->getHotelLimit();
                            $initials = collect(explode(' ', $req->user->name ?? 'KP'))->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-sky-100 text-[#0A2558] font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900">{{ $req->user->name ?? 'Karyawan' }}</div>
                                        <div class="text-xs text-slate-400">NIK: {{ $req->user->employee_id ?? '-' }} &bull; {{ $req->user->job_level ?? 'Staff' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-block font-mono text-xs font-bold text-[#0A2558] bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $req->request_number }}
                                </span>
                                <div class="font-semibold text-slate-800 text-xs mt-1">{{ $req->purpose }}</div>
                                <div class="text-[11px] text-slate-400">{{ $req->supporting_document_name ?? 'Surat Tugas terlampir (PDF)' }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-semibold text-slate-900 flex items-center gap-1.5">
                                    <span>{{ $req->origin ?: 'Jakarta' }}</span>
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                    <span>{{ $req->destination }}</span>
                                </div>
                                <div class="text-xs text-slate-500 mt-0.5 tabular-nums">{{ $req->start_date->format('d M') }} - {{ $req->end_date->format('d M Y') }} ({{ $req->duration_days }} Hari)</div>
                            </td>
                            <td class="py-4 px-4 tabular-nums">
                                <div class="font-bold text-slate-900">Rp {{ number_format($req->total_budget, 0, ',', '.') }}</div>
                                @if($isOverHotel)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200 mt-1">
                                        <svg class="w-3 h-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        Tarif Hotel &gt; Plafon
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 mt-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        In-Policy (Sesuai Plafon)
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $req->status_badge_class }}">
                                    {{ $req->status_label }}
                                </span>
                            </td>
                            <td class="py-4 px-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('approver.requests.show', $req->request_number) }}" class="inline-flex items-center gap-1 bg-[#0A2558] hover:bg-[#081c42] text-white text-xs font-semibold py-1.5 px-3 rounded-lg shadow-2xs transition">
                                        <span>Tinjau</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400 text-xs">
                                Tidak ada pengajuan perjalanan dinas yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Riwayat Persetujuan Terakhir -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs p-6">
        <h3 class="text-sm font-bold text-slate-900 mb-4">Riwayat Keputusan Terakhir</h3>
        <div class="space-y-3">
            @foreach($recentProcessed as $item)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3.5 rounded-xl bg-slate-50 border border-slate-200/70 text-xs">
                    <div class="flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full {{ $item->status === 'approved' ? 'bg-emerald-500' : 'bg-sky-500' }}"></span>
                        <span class="font-mono font-bold text-slate-800">{{ $item->request_number }}</span>
                        <span class="font-medium text-slate-700">{{ $item->user->name ?? 'Karyawan' }} &bull; {{ $item->purpose }}</span>
                    </div>
                    <div class="flex items-center gap-3 tabular-nums">
                        <span class="font-bold text-slate-800">Rp {{ number_format($item->total_budget, 0, ',', '.') }}</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $item->status_badge_class }}">{{ $item->status_label }}</span>
                        <a href="{{ route('approver.requests.show', $item->request_number) }}" class="text-[#0A2558] font-bold hover:underline">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-travel-layout>
