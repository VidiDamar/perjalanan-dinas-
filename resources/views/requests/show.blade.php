<x-app-travel-layout>
    <!-- Top Action / Back Button -->
    <div class="mb-4">
        <a href="{{ route('requests.index') }}" class="inline-flex items-center px-4 py-1.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition shadow-xs">
            Back
        </a>
    </div>

    <!-- Main Title & Action Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl md:text-[28px] font-bold text-[#0A2558] tracking-tight">TRQ-2023-0891</h1>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#DCFCE7] text-[#15803D] border border-[#BBF7D0]">
                    Approved
                </span>
            </div>
            <p class="text-sm text-slate-500 font-medium mt-1">Client Meeting - TechCorp Infra</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition shadow-xs">
                Back
            </a>
            <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition shadow-xs">
                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Download PDF</span>
            </button>
        </div>
    </div>

    <!-- Grid 2 Kolom (Kiri: Itinerary & Expenses | Kanan: Traveler, Timeline, Documents) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- KOLOM KIRI (2 Col Span) -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            
            <!-- Card 1: Itinerary Details -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg mb-6">
                    <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z" />
                    </svg>
                    <span>Itinerary Details</span>
                </div>

                <!-- Timeline Flight List -->
                <div class="relative pl-6 space-y-8 before:absolute before:left-2 before:top-2.5 before:bottom-3 before:w-[2px] before:bg-slate-200">
                    <!-- Departure -->
                    <div class="relative">
                        <div class="absolute -left-[29px] top-1.5 w-3 h-3 rounded-full bg-[#0A2558] ring-4 ring-white"></div>
                        <div class="text-[11px] font-semibold text-slate-400 tracking-wider uppercase mb-0.5">
                            DEPARTURE &bull; OCT 26, 2023
                        </div>
                        <div class="font-bold text-slate-800 text-[15px]">
                            Jakarta (CGK)
                        </div>
                        <div class="text-xs text-slate-500 font-medium mt-0.5">
                            Garuda Indonesia GA-312 &bull; 08:30 AM
                        </div>
                    </div>

                    <!-- Return -->
                    <div class="relative">
                        <div class="absolute -left-[29px] top-1.5 w-3 h-3 rounded-full bg-[#0A2558] ring-4 ring-white"></div>
                        <div class="text-[11px] font-semibold text-slate-400 tracking-wider uppercase mb-0.5">
                            RETURN &bull; OCT 28, 2023
                        </div>
                        <div class="font-bold text-slate-800 text-[15px]">
                            Surabaya (SUB)
                        </div>
                        <div class="text-xs text-slate-500 font-medium mt-0.5">
                            Garuda Indonesia GA-325 &bull; 16:45 PM
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Estimated Expenses -->
            <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-xs">
                <div class="p-6 pb-4">
                    <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg">
                        <svg class="w-5 h-5 text-[#0A2558]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="5" rx="2" />
                            <line x1="2" x2="22" y1="10" y2="10" />
                            <circle cx="12" cy="15" r="2" />
                        </svg>
                        <span>Estimated Expenses</span>
                    </div>
                </div>

                <!-- Table Expenses -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs text-slate-400 font-medium border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-3 font-normal">Category</th>
                                <th class="px-6 py-3 font-normal">Description</th>
                                <th class="px-6 py-3 font-normal text-right">Amount (IDR)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <!-- Flight -->
                            <tr>
                                <td class="px-6 py-4 flex items-center gap-2.5 font-medium text-slate-800">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                                    </svg>
                                    <span>Flight</span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">Roundtrip CGK-SUB</td>
                                <td class="px-6 py-4 font-semibold text-slate-800 text-right">3,500,000</td>
                            </tr>
                            <!-- Accommodation -->
                            <tr>
                                <td class="px-6 py-4 flex items-center gap-2.5 font-medium text-slate-800">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                    </svg>
                                    <span>Accommodation</span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">2 Nights at Marriott Surabaya</td>
                                <td class="px-6 py-4 font-semibold text-slate-800 text-right">2,800,000</td>
                            </tr>
                            <!-- Transport -->
                            <tr>
                                <td class="px-6 py-4 flex items-center gap-2.5 font-medium text-slate-800">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25V3.75m0 0a1.125 1.125 0 00-1.125-1.125H5.625a1.125 1.125 0 00-1.125 1.125v10.5" />
                                    </svg>
                                    <span>Transport</span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">Airport transfers & local</td>
                                <td class="px-6 py-4 font-semibold text-slate-800 text-right">500,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Total Estimate Footer -->
                <div class="bg-[#F8FAFC]/80 px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-12">
                    <span class="text-sm font-semibold text-slate-700">Total Estimate</span>
                    <span class="text-lg md:text-xl font-bold text-[#0A2558]">6,800,000</span>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN (1 Col Span) -->
        <div class="flex flex-col gap-6">
            
            <!-- Card 1: Traveler -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <div class="flex items-center gap-2 text-slate-800 font-bold text-[15px] mb-4">
                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span>Traveler</span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-lg bg-[#E0E7FF] text-[#3730A3] flex items-center justify-center font-bold text-sm tracking-wider shadow-xs">
                        BS
                    </div>
                    <div>
                        <div class="font-bold text-slate-800 text-[15px]">Budi Santoso</div>
                        <div class="text-xs text-slate-500 font-medium">Senior Engineer</div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Approval Timeline -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <div class="flex items-center gap-2 text-slate-800 font-bold text-[15px] mb-5">
                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Approval Timeline</span>
                </div>

                <div class="relative pl-6 space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-[2px] before:bg-[#22C55E]/30">
                    <!-- Step 1 -->
                    <div class="relative">
                        <div class="absolute -left-[27px] top-0.5 w-4 h-4 rounded-full bg-[#10B981] text-white flex items-center justify-center ring-4 ring-white shadow-xs">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <div class="font-semibold text-slate-800 text-xs">Submitted by Traveler</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Budi Santoso &bull; Oct 10, 09:15 AM</div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative">
                        <div class="absolute -left-[27px] top-0.5 w-4 h-4 rounded-full bg-[#10B981] text-white flex items-center justify-center ring-4 ring-white shadow-xs">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <div class="font-semibold text-slate-800 text-xs">Manager Approval</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Siti Aminah &bull; Oct 11, 14:30 PM</div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative">
                        <div class="absolute -left-[27px] top-0.5 w-4 h-4 rounded-full bg-[#10B981] text-white flex items-center justify-center ring-4 ring-white shadow-xs">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <div class="font-semibold text-slate-800 text-xs">Finance Approval</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Agus Pratama &bull; Oct 12, 10:00 AM</div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Documents -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <div class="flex items-center gap-2 text-slate-800 font-bold text-[15px] mb-4">
                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.373L8.552 18.32a1.5 1.5 0 01-2.121-2.121l7.693-7.693" />
                    </svg>
                    <span>Documents</span>
                </div>

                <!-- Document Item -->
                <div class="flex items-center justify-between p-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50/70 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                            </svg>
                        </div>
                        <div class="overflow-hidden">
                            <div class="font-semibold text-slate-800 text-xs truncate max-w-[140px] md:max-w-[160px]">
                                Surat_Tugas_Budi.pdf
                            </div>
                            <div class="text-[11px] text-slate-400 mt-0.5">245 KB &bull; PDF</div>
                        </div>
                    </div>
                    
                    <button type="button" class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition" title="Download Document">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>

    </div>
</x-app-travel-layout>
