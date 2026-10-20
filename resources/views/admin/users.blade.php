<x-app-travel-layout>
    <!-- Top Bar Navigation & Back Link -->
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-[#0A2558] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Dashboard Super Admin</span>
        </a>
    </div>

    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Master Karyawan & Struktur Approval</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Kelola data seluruh akun pegawai, hak akses sistem, serta pemetaan atasan langsung (Approver 1 & 2).</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" onclick="document.getElementById('modal-user').classList.remove('hidden')" class="inline-flex items-center gap-2 bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold text-xs py-2.5 px-4 rounded-xl shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Pengguna Baru</span>
            </button>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end text-xs">
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Filter Hak Akses (Role)</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option selected>Semua Role (5 Role)</option>
                    <option>Karyawan / Traveler</option>
                    <option>Atasan / Approver</option>
                    <option>Admin Travel Desk</option>
                    <option>Tim Keuangan (Finance)</option>
                    <option>Super Administrator</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Departemen</label>
                <select class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option selected>Semua Departemen</option>
                    <option>Engineering & IT</option>
                    <option>Project Operations</option>
                    <option>Finance & Accounting</option>
                    <option>General Affairs</option>
                </select>
            </div>
            <div>
                <button class="w-full bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold py-2 px-4 rounded-xl shadow-xs transition">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Table Users -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-5">Pegawai</th>
                        <th class="py-3.5 px-4">Role Sistem</th>
                        <th class="py-3.5 px-4">Departemen & Level</th>
                        <th class="py-3.5 px-4">Atasan Langsung (Approver 1)</th>
                        <th class="py-3.5 px-4">Approver Level 2</th>
                        <th class="py-3.5 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- User 1: Karyawan -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 text-sm">Ahmad Pegawai</div>
                            <div class="text-[11px] text-slate-400">user@gmail.com &bull; NIK: EMP-0921</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                👤 Karyawan (Traveler)
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-800">Engineering & IT</div>
                            <div class="text-[11px] text-slate-500">Grade: Senior Specialist</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-medium text-slate-900">Budi Santoso</div>
                            <div class="text-[10px] text-slate-400">Head of Engineering</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-medium text-slate-900">Septianto Raharso</div>
                            <div class="text-[10px] text-slate-400">Direktur Operasional</div>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800 mr-2">Edit</button>
                            <button class="text-xs font-semibold text-rose-600 hover:text-rose-800">Nonaktifkan</button>
                        </td>
                    </tr>

                    <!-- User 2: Atasan -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 text-sm">Budi Santoso</div>
                            <div class="text-[11px] text-slate-400">atasan@gmail.com &bull; NIK: MGR-0104</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                👔 Atasan (Approver)
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-800">Engineering & IT</div>
                            <div class="text-[11px] text-slate-500">Grade: Division Head</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-medium text-slate-900">Septianto Raharso</div>
                            <div class="text-[10px] text-slate-400">Direktur Operasional</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="text-slate-400">-</span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800 mr-2">Edit</button>
                            <button class="text-xs font-semibold text-rose-600 hover:text-rose-800">Nonaktifkan</button>
                        </td>
                    </tr>

                    <!-- User 3: Travel Admin -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 text-sm">Siti Rahma</div>
                            <div class="text-[11px] text-slate-400">travel@gmail.com &bull; NIK: GA-0421</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                ✈️ Admin Travel Desk
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-800">General Affairs</div>
                            <div class="text-[11px] text-slate-500">Corporate Travel Officer</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-medium text-slate-900">Wahyu Pratama</div>
                            <div class="text-[10px] text-slate-400">GA Manager</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="text-slate-400">-</span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800 mr-2">Edit</button>
                            <button class="text-xs font-semibold text-rose-600 hover:text-rose-800">Nonaktifkan</button>
                        </td>
                    </tr>

                    <!-- User 4: Finance -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-5">
                            <div class="font-bold text-slate-900 text-sm">Hendra Wijaya</div>
                            <div class="text-[11px] text-slate-400">finance@gmail.com &bull; NIK: FIN-0220</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                💰 Tim Keuangan (Finance)
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-800">Finance & Accounting</div>
                            <div class="text-[11px] text-slate-500">Senior Cashier Supervisor</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-medium text-slate-900">Rini Susanti</div>
                            <div class="text-[10px] text-slate-400">Finance Controller</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="text-slate-400">-</span>
                        </td>
                        <td class="py-4 px-5 text-right">
                            <button class="text-xs font-semibold text-sky-600 hover:text-sky-800 mr-2">Edit</button>
                            <button class="text-xs font-semibold text-rose-600 hover:text-rose-800">Nonaktifkan</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div id="modal-user" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200">
            <h3 class="font-bold text-slate-900 text-base mb-1">Tambah Data Karyawan & Atur Role</h3>
            <p class="text-xs text-slate-500 mb-4">Pengguna baru akan otomatis mendapatkan akses sesuai role yang dipilih.</p>

            <form class="space-y-3.5 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap & Gelar</label>
                    <input type="text" placeholder="Contoh: Pratama Wicaksana S.T." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Email Perusahaan</label>
                        <input type="email" placeholder="nama@perusahaan.co.id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nomor Induk Karyawan (NIK)</label>
                        <input type="text" placeholder="EMP-xxxx" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Role Akses Sistem</label>
                        <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                            <option value="user">Karyawan (Traveler)</option>
                            <option value="atasan">Atasan (Approver)</option>
                            <option value="travel_admin">Admin Travel Desk</option>
                            <option value="finance">Tim Keuangan (Finance)</option>
                            <option value="admin">Super Administrator</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Level Jabatan (Grade)</label>
                        <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                            <option>Staff / Junior</option>
                            <option>Senior Specialist</option>
                            <option>Supervisor / Lead</option>
                            <option>Manager / Head</option>
                            <option>Direktur</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Atasan Langsung (Approver Level 1)</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                        <option>Budi Santoso (Division Head)</option>
                        <option>Rudi Hermawan (Manager Project Ops)</option>
                        <option>Diana Kartika (QA Head)</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modal-user').classList.add('hidden')" class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 font-semibold transition">
                        Batal
                    </button>
                    <button type="button" onclick="document.getElementById('modal-user').classList.add('hidden')" class="px-5 py-2 rounded-xl bg-[#0A2558] hover:bg-[#081c42] text-white font-bold shadow-xs transition">
                        Simpan Karyawan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-travel-layout>
