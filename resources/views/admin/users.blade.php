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

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">Tutup</button>
        </div>
    @endif

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('admin.users') }}" class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end text-xs">
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Filter Hak Akses (Role)</label>
                <select name="role" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option value="all" {{ request('role') === 'all' ? 'selected' : '' }}>Semua Role (5 Role)</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Karyawan / Traveler</option>
                    <option value="atasan" {{ request('role') === 'atasan' ? 'selected' : '' }}>Atasan / Approver</option>
                    <option value="travel_admin" {{ request('role') === 'travel_admin' ? 'selected' : '' }}>Admin Travel Desk</option>
                    <option value="finance" {{ request('role') === 'finance' ? 'selected' : '' }}>Tim Keuangan (Finance)</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Super Administrator</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-600 mb-1.5">Departemen</label>
                <select name="department" class="w-full bg-slate-50/70 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                    <option value="all" {{ request('department') === 'all' ? 'selected' : '' }}>Semua Departemen</option>
                    <option value="Engineering" {{ request('department') === 'Engineering' ? 'selected' : '' }}>Engineering & IT</option>
                    <option value="Project" {{ request('department') === 'Project' ? 'selected' : '' }}>Project Operations</option>
                    <option value="Finance" {{ request('department') === 'Finance' ? 'selected' : '' }}>Finance & Accounting</option>
                    <option value="General" {{ request('department') === 'General' ? 'selected' : '' }}>General Affairs</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-[#0A2558] hover:bg-[#081c42] text-white font-semibold py-2 px-4 rounded-xl shadow-xs transition">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </form>

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
                        <th class="py-3.5 px-5 text-right">Status & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($users ?? [] as $u)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-5">
                                <div class="font-bold text-slate-900 text-sm">{{ $u->name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $u->email }} &bull; NIK: {{ $u->employee_id ?? 'EMP-00'.$u->id }}</div>
                            </td>
                            <td class="py-4 px-4">
                                @if($u->role === 'user')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                        <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                        <span>Karyawan (Traveler)</span>
                                    </span>
                                @elseif(in_array($u->role, ['atasan', 'approver']))
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span>Atasan (Approver)</span>
                                    </span>
                                @elseif($u->role === 'travel_admin')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                        <svg class="w-3 h-3 text-sky-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                                        <span>Admin Travel Desk</span>
                                    </span>
                                @elseif($u->role === 'finance')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        <svg class="w-3 h-3 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span>Tim Keuangan (Finance)</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-200">
                                        <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                                        <span>Super Administrator</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-semibold text-slate-800">{{ $u->department ?? 'Engineering & IT' }}</div>
                                <div class="text-[11px] text-slate-500">Grade: {{ $u->job_level ?? 'Senior Specialist' }}</div>
                            </td>
                            <td class="py-4 px-4">
                                @if($u->manager)
                                    <div class="font-medium text-slate-900">{{ $u->manager->name }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $u->manager->job_level }}</div>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                @if($u->secondApprover)
                                    <div class="font-medium text-slate-900">{{ $u->secondApprover->name }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $u->secondApprover->job_level }}</div>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-right">
                                <form method="POST" action="{{ route('admin.users.toggle', $u->id) }}" class="inline">
                                    @csrf
                                    @if($u->is_active ?? true)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 mr-2">Aktif</span>
                                        <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-800">Nonaktifkan</button>
                                    @else
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-500 mr-2">Nonaktif</span>
                                        <button type="submit" class="text-xs font-semibold text-emerald-600 hover:text-emerald-800">Aktifkan</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-5">
                                <div class="font-bold text-slate-900 text-sm">Ahmad Pegawai</div>
                                <div class="text-[11px] text-slate-400">user@gmail.com &bull; NIK: EMP-0921</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                    <span>Karyawan (Traveler)</span>
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
                                <span class="text-xs font-semibold text-emerald-600">Aktif</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div id="modal-user" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200">
            <h3 class="font-bold text-slate-900 text-base mb-1">Tambah Data Karyawan & Atur Role</h3>
            <p class="text-xs text-slate-500 mb-4">Pengguna baru akan otomatis mendapatkan akses sesuai role yang dipilih (Password default: <code class="font-mono font-bold">password123</code>).</p>

            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-3.5 text-xs">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap & Gelar</label>
                    <input type="text" name="name" required placeholder="Contoh: Pratama Wicaksana S.T." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Email Perusahaan</label>
                        <input type="email" name="email" required placeholder="nama@perusahaan.co.id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nomor Induk Karyawan (NIK)</label>
                        <input type="text" name="employee_id" required placeholder="EMP-xxxx" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Role Akses Sistem</label>
                        <select name="role" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                            <option value="user">Karyawan (Traveler)</option>
                            <option value="atasan">Atasan (Approver)</option>
                            <option value="travel_admin">Admin Travel Desk</option>
                            <option value="finance">Tim Keuangan (Finance)</option>
                            <option value="admin">Super Administrator</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Level Jabatan (Grade)</label>
                        <select name="job_level" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                            <option value="Staff / Junior Specialist">Staff / Junior Specialist</option>
                            <option value="Senior Specialist" selected>Senior Specialist</option>
                            <option value="Manager / Head of Division">Manager / Head of Division</option>
                            <option value="Direksi / C-Level">Direksi / C-Level</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Departemen</label>
                    <input type="text" name="department" value="Engineering & IT Infrastructure" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Atasan Langsung (Approver Level 1)</label>
                    <select name="manager_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium">
                        <option value="">-- Pilih Atasan Langsung --</option>
                        @foreach($approvers ?? [] as $app)
                            <option value="{{ $app->id }}">{{ $app->name }} ({{ $app->job_level }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modal-user').classList.add('hidden')" class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 font-semibold transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#0A2558] hover:bg-[#081c42] text-white font-bold shadow-xs transition">
                        Simpan Karyawan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-travel-layout>
