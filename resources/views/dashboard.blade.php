<x-app-travel-layout>
    <!-- Welcome Greeting Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-[30px] font-bold text-slate-900 tracking-tight">Welcome back, Firman.</h1>
    </div>

    <!-- 3 Metrics Top Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1: Active Trips -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs flex flex-col justify-between">
            <div class="w-10 h-10 rounded-xl bg-[#E0F2FE] text-[#0284C7] flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                </svg>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-500">Active Trips</span>
                <div class="text-3xl font-extrabold text-slate-900 mt-1">2</div>
            </div>
        </div>

        <!-- Card 2: Pending Approvals -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs flex flex-col justify-between">
            <div class="w-10 h-10 rounded-xl bg-[#FEF3C7] text-[#D97706] flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-500">Pending Approvals</span>
                <div class="text-3xl font-extrabold text-slate-900 mt-1">5</div>
            </div>
        </div>

        <!-- Card 3: Total Budget Used (YTD) -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs flex flex-col justify-between">
            <div class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#16A34A] flex items-center justify-center mb-4">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="14" x="2" y="5" rx="2" />
                    <line x1="2" x2="22" y1="10" y2="10" />
                    <circle cx="12" cy="15" r="2" />
                </svg>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-500">Total Budget Used (YTD)</span>
                <div class="flex items-baseline gap-1.5 mt-1">
                    <span class="text-xl md:text-2xl font-extrabold text-slate-900">Rp. 268.000.000</span>
                    <span class="text-[11px] font-medium text-slate-400">/ 1M limit</span>
                </div>
                <!-- Progress Bar -->
                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-3 overflow-hidden">
                    <div class="bg-[#0A2558] h-1.5 rounded-full" style="width: 27%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Travel Requests Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-xs mb-8">
        <!-- Table Header Title with View All Link -->
        <div class="px-6 py-5 flex items-center justify-between border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-900">Recent Travel Requests</h2>
            <a href="{{ route('requests.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#0A2558] hover:text-sky-700 transition">
                <span>View All</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="text-[11px] uppercase tracking-wider text-slate-400 font-semibold border-b border-slate-100 bg-slate-50/40">
                    <tr>
                        <th class="px-6 py-3.5 font-medium">TRIP ID</th>
                        <th class="px-6 py-3.5 font-medium">DESTINATION</th>
                        <th class="px-6 py-3.5 font-medium">DATES</th>
                        <th class="px-6 py-3.5 font-medium">STATUS</th>
                        <th class="px-6 py-3.5 font-medium text-right">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- Row 1: TRQ-8902 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8902</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            Singapore (Q3 Review)
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-normal">
                            Oct 12 - Oct 15
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#DCFCE7] text-[#15803D] border border-[#BBF7D0]">
                                Approved
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="1.75" />
                                    <circle cx="12" cy="12" r="1.75" />
                                    <circle cx="12" cy="19" r="1.75" />
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2: TRQ-8905 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8905</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            Jakarta (Client Pitch)
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-normal">
                            Nov 02 - Nov 04
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FEF9C3] text-[#A16207] border border-[#FEF08A]">
                                Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="1.75" />
                                    <circle cx="12" cy="12" r="1.75" />
                                    <circle cx="12" cy="19" r="1.75" />
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3: TRQ-8891 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8891</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            Kuala Lumpur (Tech Conf)
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-normal">
                            Sep 20 - Sep 22
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#FEE2E2] text-[#B91C1C] border border-[#FECACA]">
                                Rejected
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="1.75" />
                                    <circle cx="12" cy="12" r="1.75" />
                                    <circle cx="12" cy="19" r="1.75" />
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 4: TRQ-8870 -->
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4 font-bold text-[#0A2558]">
                            <a href="{{ route('requests.show') }}" class="hover:underline">TRQ-8870</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            Tokyo (Annual Summit)
                        </td>
                        <td class="px-6 py-4 text-slate-500 font-normal">
                            Aug 10 - Aug 16
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#DCFCE7] text-[#15803D] border border-[#BBF7D0]">
                                Approved
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="1.75" />
                                    <circle cx="12" cy="12" r="1.75" />
                                    <circle cx="12" cy="19" r="1.75" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    <div class="flex justify-end">
        <a href="{{ route('requests.index') }}" class="px-6 py-2.5 text-sm font-semibold text-white bg-[#0A2558] hover:bg-[#071d47] rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
            Back
        </a>
    </div>
</x-app-travel-layout>
