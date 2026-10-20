<x-app-travel-layout>
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200 mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-purple-500 animate-pulse"></span>
                Pusat Kontrol Sistem & Analitik Eksekutif
            </div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Executive Dashboard & Radar Perjalanan</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Pantau pergerakan karyawan dinas di lapangan secara real-time melalui status check-in dan kepatuhan anggaran.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.policies') }}" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                </svg>
                <span>Kelola Kebijakan & Plafon Biaya</span>
            </a>
        </div>
    </div>

    <!-- 4 KPI Cards Executive -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1: Radar Check-in -->
        <div class="bg-white rounded-2xl border border-emerald-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">Dinas Lapangan Aktif</span>
                <span class="p-2 bg-emerald-50 rounded-xl text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight">4 <span class="text-sm font-semibold text-emerald-600 ml-1">Karyawan</span></div>
            <p class="text-xs text-emerald-700 font-medium mt-1.5 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                <span>Semua ter-check-in di kota tujuan</span>
            </p>
        </div>

        <!-- Card 2: Total SPPD -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total SPPD Terbit (2023)</span>
                <span class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 tracking-tight">89 <span class="text-sm font-semibold text-sky-600 ml-1">Perjalanan</span></div>
            <p class="text-xs text-slate-500 font-medium mt-1.5">Tingkat kepatuhan policy: 96.2%</p>
        </div>

        <!-- Card 3: Total Biaya Dinas -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Biaya Realisasi</span>
                <span class="p-2 bg-purple-50 rounded-xl text-purple-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold text-slate-900 tracking-tight mt-1">Rp 412.5 Jt</div>
            <p class="text-xs text-slate-500 font-medium mt-1">Plafon Perusahaan: Rp 600 Jt</p>
        </div>

        <!-- Card 4: Early Warning System -->
        <div class="bg-white rounded-2xl border border-rose-200/90 p-5 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-rose-700">Early Warning System</span>
                <span class="p-2 bg-rose-50 rounded-xl text-rose-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold text-rose-700 tracking-tight mt-1">1 Departemen</div>
            <p class="text-xs text-rose-600 font-medium mt-1">Project Ops: 84% anggaran terpakai</p>
        </div>
    </div>

    <!-- Radar Check-in Karyawan Real-Time -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-emerald-500 animate-ping"></span>
                    <span>Radar Monitoring Check-in Karyawan Dinas (Status Lokasi)</span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Karyawan menekan tombol check-in saat tiba di kota/hotel untuk pelacakan keselamatan & transparansi dinas.</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                4 Karyawan di Luar Kota
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Traveler 1 -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-slate-900 text-sm">Ahmad Pegawai</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Check-in OK</span>
                </div>
                <div class="text-slate-500">IT Infra &bull; Senior Engineer</div>
                <div class="pt-2 border-t border-slate-200">
                    <div class="font-semibold text-slate-800">📍 Surabaya, Jawa Timur</div>
                    <div class="text-[11px] text-slate-500">Hotel Santika Premiere Gubeng</div>
                    <div class="text-[10px] text-slate-400 mt-1">Waktu: Hari ini, 10:45 WIB</div>
                </div>
            </div>

            <!-- Traveler 2 -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-slate-900 text-sm">Bagus Pratama</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Check-in OK</span>
                </div>
                <div class="text-slate-500">Project Operations Lead</div>
                <div class="pt-2 border-t border-slate-200">
                    <div class="font-semibold text-slate-800">📍 Semarang, Jawa Tengah</div>
                    <div class="text-[11px] text-slate-500">Kantor Cabang Trans Jawa</div>
                    <div class="text-[10px] text-slate-400 mt-1">Waktu: Kemarin, 09:15 WIB</div>
                </div>
            </div>

            <!-- Traveler 3 -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-slate-900 text-sm">Rina Melati</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Check-in OK</span>
                </div>
                <div class="text-slate-500">Network Engineer</div>
                <div class="pt-2 border-t border-slate-200">
                    <div class="font-semibold text-slate-800">📍 Bandung, Jawa Barat</div>
                    <div class="text-[11px] text-slate-500">IDC Data Center Batununggal</div>
                    <div class="text-[10px] text-slate-400 mt-1">Waktu: Hari ini, 11:20 WIB</div>
                </div>
            </div>

            <!-- Traveler 4 -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-slate-900 text-sm">Hendra Kurnia</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Check-in OK</span>
                </div>
                <div class="text-slate-500">Civil & Project Manager</div>
                <div class="pt-2 border-t border-slate-200">
                    <div class="font-semibold text-slate-800">📍 Balikpapan / IKN</div>
                    <div class="text-[11px] text-slate-500">Site Proyek Infrastruktur</div>
                    <div class="text-[10px] text-slate-400 mt-1">Waktu: 19 Okt 2023, 14:00 WITA</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Navigation to Admin Modules -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.users') }}" class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-purple-300 transition group">
            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                👥
            </div>
            <h3 class="font-bold text-slate-900 text-sm">Master Karyawan & Organisasi</h3>
            <p class="text-xs text-slate-500 mt-1">Kelola data pegawai, penugasan level jabatan, dan tetapkan struktur hierarki atasan langsung (Approver 1 & 2).</p>
        </a>

        <a href="{{ route('admin.policies') }}" class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-purple-300 transition group">
            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                ⚖️
            </div>
            <h3 class="font-bold text-slate-900 text-sm">Travel Policy Engine & Plafon</h3>
            <p class="text-xs text-slate-500 mt-1">Atur matriks batas tarif hotel per malam, uang harian (Per Diem), kelas tiket transportasi, dan ambang batas Direktur.</p>
        </a>

        <a href="{{ route('admin.audit-logs') }}" class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-purple-300 transition group">
            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                📜
            </div>
            <h3 class="font-bold text-slate-900 text-sm">Audit Trail Log Sistem</h3>
            <p class="text-xs text-slate-500 mt-1">Pelacakan log aktivitas lengkap: histori persetujuan SPPD, pencairan kasbon, perubahan parameter kebijakan, alamat IP & timestamp.</p>
        </a>
    </div>
</x-app-travel-layout>
