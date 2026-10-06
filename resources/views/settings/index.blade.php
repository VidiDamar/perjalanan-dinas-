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
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#E2E8F0]/70 text-[#0A2558] font-semibold text-sm transition">
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
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl border border-slate-200/90 p-8 shadow-xs">
                <h2 class="text-lg font-bold text-slate-900 mb-6">Profile Information</h2>

                <form action="#" method="POST" onsubmit="event.preventDefault();">
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        
                        <!-- Left Avatar / Photo Upload Area -->
                        <div class="flex flex-col items-center gap-3 shrink-0">
                            <div class="w-28 h-36 rounded-xl overflow-hidden shadow-xs border border-slate-200 bg-red-600">
                                <img 
                                    src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=300" 
                                    alt="Muhamad Fiqri Abdullah" 
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <button type="button" class="px-3.5 py-1.5 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 shadow-2xs transition">
                                Change Photo
                            </button>
                        </div>

                        <!-- Right Form Input Fields Grid -->
                        <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Full Name -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Full Name</label>
                                <input 
                                    type="text" 
                                    value="Muhamad Fiqri Abdullah" 
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                                />
                            </div>

                            <!-- Employee ID -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Employee ID</label>
                                <input 
                                    type="text" 
                                    value="EMP-2023-084" 
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                                />
                            </div>

                            <!-- Department Dropdown -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Department</label>
                                <div class="relative">
                                    <select class="w-full appearance-none bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10 shadow-2xs">
                                        <option selected>Operations</option>
                                        <option>Engineering</option>
                                        <option>Sales</option>
                                        <option>Marketing</option>
                                        <option>Finance</option>
                                    </select>
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Email Address</label>
                                <input 
                                    type="email" 
                                    value="mhmdfqruabduloh@gmail.com" 
                                    class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                                />
                            </div>
                        </div>

                    </div>

                    <!-- Action Buttons Footer -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <button type="button" class="px-5 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 shadow-2xs transition">
                            Discard
                        </button>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-[#0A2558] hover:bg-[#081c42] rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-travel-layout>
