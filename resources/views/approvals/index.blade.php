<x-app-travel-layout>
    <!-- Header Title & Subtitle -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Approval Center</h1>
        <p class="text-sm text-slate-500 font-medium mt-1">Review and manage pending travel requests.</p>
    </div>

    <!-- Main Grid 2 Kolom (Kiri: Pending Reviews List | Kanan: Detail & Action Approval) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{
        selectedId: 'TRV-2023-0891'
    }">
        
        <!-- KOLOM KIRI (1 Col Span: Pending Reviews List) -->
        <div class="lg:col-span-1 flex flex-col gap-4">
            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-slate-900 text-base">Pending Reviews</h2>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-semibold bg-[#FEF3C7] text-[#D97706]">
                        3 Requests
                    </span>
                </div>

                <div class="space-y-3">
                    <!-- Item 1: TRV-2023-0891 (Selected Active) -->
                    <div 
                        @click="selectedId = 'TRV-2023-0891'"
                        class="p-4 rounded-xl border border-slate-200 bg-white hover:border-[#0A2558] cursor-pointer transition relative before:absolute before:left-0 before:top-3 before:bottom-3 before:w-1 before:bg-[#0A2558] before:rounded-r shadow-2xs"
                    >
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="text-slate-400 font-medium">TRV-2023-0891</span>
                            <span class="text-slate-400 text-[11px] bg-slate-100 px-1.5 py-0.5 rounded">2 hrs ago</span>
                        </div>
                        <div class="font-bold text-slate-900 text-sm">Eko Widodo</div>
                        <div class="text-xs text-slate-500 mt-0.5">Client Meeting - TechCorp Infra</div>
                        <div class="flex items-center justify-between text-xs mt-3 pt-2 border-t border-slate-100">
                            <div class="flex items-center gap-1.5 text-slate-500 font-medium">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Jakarta &rarr; Surabaya</span>
                            </div>
                            <span class="font-bold text-[#0A2558]">Rp 4.500.000</span>
                        </div>
                    </div>

                    <!-- Item 2: TRV-2023-0892 -->
                    <div 
                        @click="selectedId = 'TRV-2023-0892'"
                        class="p-4 rounded-xl border border-slate-200/80 bg-white hover:border-slate-300 cursor-pointer transition shadow-2xs"
                    >
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="text-slate-400 font-medium">TRV-2023-0892</span>
                            <span class="text-slate-400 text-[11px] bg-slate-100 px-1.5 py-0.5 rounded">5 hrs ago</span>
                        </div>
                        <div class="font-bold text-slate-900 text-sm">Abdullah</div>
                        <div class="text-xs text-slate-500 mt-0.5">Annual Sales Conference</div>
                        <div class="flex items-center justify-between text-xs mt-3 pt-2 border-t border-slate-100">
                            <div class="flex items-center gap-1.5 text-slate-500 font-medium">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Jakarta &rarr; Bali</span>
                            </div>
                            <span class="font-bold text-[#0A2558]">Rp 8.200.000</span>
                        </div>
                    </div>

                    <!-- Item 3: TRV-2023-0895 -->
                    <div 
                        @click="selectedId = 'TRV-2023-0895'"
                        class="p-4 rounded-xl border border-slate-200/80 bg-white hover:border-slate-300 cursor-pointer transition shadow-2xs"
                    >
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="text-slate-400 font-medium">TRV-2023-0895</span>
                            <span class="text-slate-400 text-[11px] bg-slate-100 px-1.5 py-0.5 rounded">1 day ago</span>
                        </div>
                        <div class="font-bold text-slate-900 text-sm truncate max-w-[190px]">Firmansyahhhhhhhhhh</div>
                        <div class="text-xs text-slate-500 mt-0.5">Site Inspection Factory C</div>
                        <div class="flex items-center justify-between text-xs mt-3 pt-2 border-t border-slate-100">
                            <div class="flex items-center gap-1.5 text-slate-500 font-medium">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span>Bandung &rarr; Semarang</span>
                            </div>
                            <span class="font-bold text-[#0A2558]">Rp 2.100.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (2 Col Span: Review Detail Panel) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
                
                <!-- Detail Header -->
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 pb-6 border-b border-slate-100">
                    <div>
                        <div class="flex items-center gap-3">
                            <h2 class="text-xl md:text-2xl font-bold text-[#0A2558]">Client Meeting - TechCorp Infra</h2>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-[#FEF3C7] text-[#B45309]">
                                Pending Approval
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 font-medium mt-1">
                            Request ID: TRV-2023-0891 &bull; Submitted on 24 Oct 2023
                        </p>
                    </div>

                    <div class="text-right shrink-0">
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400">TOTAL REQUESTED</div>
                        <div class="text-2xl md:text-3xl font-extrabold text-[#0A2558]">
                            <span class="text-base font-bold align-top">Rp </span>4.500.000
                        </div>
                    </div>
                </div>

                <!-- 2 Cards Info: Employee Details & Itinerary Summary -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 my-6">
                    <!-- Card Employee Details -->
                    <div class="p-5 rounded-xl border border-slate-200/80 bg-white">
                        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-4">
                            EMPLOYEE DETAILS
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-full overflow-hidden bg-slate-200 shrink-0">
                                <img 
                                    src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=150" 
                                    alt="Eko Widodo" 
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <div>
                                <div class="font-bold text-slate-800 text-sm">Eko Widodo</div>
                                <div class="text-xs text-slate-500">Senior Sales Engineer</div>
                            </div>
                        </div>

                        <div class="space-y-1.5 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Department:</span>
                                <span class="font-semibold text-slate-800">Enterprise Sales</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Cost Center:</span>
                                <span class="font-semibold text-slate-800">CC-SAL-004</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Itinerary Summary -->
                    <div class="p-5 rounded-xl border border-slate-200/80 bg-white">
                        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-4">
                            ITINERARY SUMMARY
                        </div>

                        <div class="relative pl-5 space-y-4 before:absolute before:left-1.5 before:top-2 before:bottom-2 before:w-[1.5px] before:bg-slate-200">
                            <!-- Departure -->
                            <div class="relative">
                                <div class="absolute -left-[18.5px] top-1 w-2.5 h-2.5 rounded-full bg-[#0A2558]"></div>
                                <div class="text-[11px] text-slate-500 font-medium">26 Oct 2023 - 08:00</div>
                                <div class="font-bold text-slate-800 text-xs">Jakarta (CGK)</div>
                            </div>

                            <!-- Return -->
                            <div class="relative">
                                <div class="absolute -left-[18.5px] top-1 w-2.5 h-2.5 rounded-full border-2 border-[#0A2558] bg-white"></div>
                                <div class="text-[11px] text-slate-500 font-medium">26 Oct 2023 - 18:00</div>
                                <div class="font-bold text-slate-800 text-xs">Surabaya (SUB)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estimated Cost Breakdown Table -->
                <div class="mb-6">
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-3">
                        ESTIMATED COST BREAKDOWN
                    </div>
                    <div class="border border-slate-200/80 rounded-xl overflow-hidden">
                        <table class="w-full text-left text-xs">
                            <thead class="text-slate-400 font-medium bg-slate-50/60 border-b border-slate-200/80">
                                <tr>
                                    <th class="px-5 py-3 font-normal">Category</th>
                                    <th class="px-5 py-3 font-normal">Description</th>
                                    <th class="px-5 py-3 font-normal text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                <tr>
                                    <td class="px-5 py-3 flex items-center gap-2 font-medium text-slate-800">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                                        </svg>
                                        <span>Flight</span>
                                    </td>
                                    <td class="px-5 py-3 text-slate-600">Roundtrip CGK-SUB (Garuda)</td>
                                    <td class="px-5 py-3 text-right font-semibold text-slate-800">Rp 2.800.000</td>
                                </tr>
                                <tr>
                                    <td class="px-5 py-3 flex items-center gap-2 font-medium text-slate-800">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                        </svg>
                                        <span>Accommodation</span>
                                    </td>
                                    <td class="px-5 py-3 text-slate-600">2 Nights at Bumi Surabaya</td>
                                    <td class="px-5 py-3 text-right font-semibold text-slate-800">Rp 1.400.000</td>
                                </tr>
                                <tr>
                                    <td class="px-5 py-3 flex items-center gap-2 font-medium text-slate-800">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25V3.75m0 0a1.125 1.125 0 00-1.125-1.125H5.625a1.125 1.125 0 00-1.125 1.125v10.5" />
                                        </svg>
                                        <span>Transport</span>
                                    </td>
                                    <td class="px-5 py-3 text-slate-600">Airport Transfers</td>
                                    <td class="px-5 py-3 text-right font-semibold text-slate-800">Rp 300.000</td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-slate-50/70 border-t border-slate-200/80 font-bold text-slate-800">
                                <tr>
                                    <td colspan="2" class="px-5 py-3 text-right">Total Estimate</td>
                                    <td class="px-5 py-3 text-right text-[#0A2558] font-bold">Rp 4.500.000</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Workflow Status Stepper -->
                <div class="mb-8">
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-3">
                        WORKFLOW STATUS
                    </div>
                    <div class="p-5 rounded-xl border border-slate-200/80 bg-white">
                        <div class="relative pl-6 space-y-5 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-[1.5px] before:bg-slate-200">
                            <!-- Step 1 Done -->
                            <div class="relative">
                                <div class="absolute -left-[23px] top-0.5 w-3.5 h-3.5 rounded-full bg-[#10B981] text-white flex items-center justify-center ring-2 ring-white">
                                    <svg class="w-2 h-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </div>
                                <div class="font-bold text-slate-800 text-xs">Submitted by Budi Santoso</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">24 Oct 2023, 10:15 AM</div>
                            </div>

                            <!-- Step 2 In Progress -->
                            <div class="relative">
                                <div class="absolute -left-[23px] top-0.5 w-3.5 h-3.5 rounded-full border-2 border-amber-500 bg-white ring-2 ring-white"></div>
                                <div class="font-bold text-slate-800 text-xs">Pending Direct Manager Approval</div>
                                <div class="text-[11px] text-amber-600 font-medium mt-0.5">Currently with You</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button Bar -->
                <div class="flex items-center justify-between flex-wrap gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('requests.index') }}" class="px-5 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-2xs transition">
                        Back
                    </a>

                    <div class="flex items-center gap-3">
                        <button type="button" class="px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition shadow-2xs">
                            Request Revision
                        </button>
                        <button type="button" class="px-5 py-2 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-2xs transition">
                            Reject
                        </button>
                        <button type="button" class="px-6 py-2 text-xs font-semibold text-white bg-[#0A2558] hover:bg-[#071d47] rounded-lg shadow-2xs transition">
                            Approve
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-travel-layout>
