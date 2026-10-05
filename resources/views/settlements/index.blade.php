<x-app-travel-layout>
    <!-- Header Title & Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Trip Settlements</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Manage and reconcile completed business travel expenses.</p>
        </div>

        <div class="flex items-center gap-3">
            <button type="button" class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-2xs">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18m-14 5h10m-7 5h4" />
                </svg>
                <span>Filter</span>
            </button>
            <button type="button" class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-2xs">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Export</span>
            </button>
        </div>
    </div>

    <!-- Main Grid 2 Kolom (Kiri: Awaiting Settlement List | Kanan: Settlement Details Panel) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start" x-data="{
        selectedTrip: 'TRP-2023-089'
    }">
        
        <!-- KOLOM KIRI (1 Col Span: Awaiting Settlement List) -->
        <div class="lg:col-span-1 flex flex-col gap-4">
            <h2 class="font-bold text-slate-900 text-base">Awaiting Settlement</h2>

            <div class="space-y-3">
                <!-- Item 1: TRP-2023-089 (Selected Active) -->
                <div 
                    @click="selectedTrip = 'TRP-2023-089'"
                    class="p-4 rounded-xl border border-slate-200 bg-white hover:border-[#0A2558] cursor-pointer transition relative before:absolute before:left-0 before:top-3 before:bottom-3 before:w-1 before:bg-[#0A2558] before:rounded-r shadow-2xs"
                >
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-[#E0E7FF] text-[#3730A3]">
                            TRP-2023-089
                        </span>
                        <span class="text-slate-400 text-[11px]">Oct 12 - 15</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-bold text-slate-900 text-sm">Jakarta - Surabaya</div>
                            <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span>Budi Santoso</span>
                            </div>
                            <div class="text-[11px] text-slate-400 mt-2">Estimated Advance</div>
                            <div class="font-bold text-slate-900 text-xs">Rp 4.500.000</div>
                        </div>

                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Item 2: TRP-2023-092 -->
                <div 
                    @click="selectedTrip = 'TRP-2023-092'"
                    class="p-4 rounded-xl border border-slate-200/80 bg-white hover:border-slate-300 cursor-pointer transition shadow-2xs"
                >
                    <div class="flex items-center justify-between text-xs mb-1.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-slate-100 text-slate-600">
                            TRP-2023-092
                        </span>
                        <span class="text-slate-400 text-[11px]">Oct 18 - 20</span>
                    </div>

                    <div>
                        <div class="font-bold text-slate-900 text-sm">Bandung Branch Visit</div>
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-1">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span>Anita Wijaya</span>
                        </div>
                        <div class="text-[11px] text-slate-400 mt-2">Estimated Advance</div>
                        <div class="font-bold text-slate-900 text-xs">Rp 2.100.000</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (2 Col Span: Settlement Details Panel) -->
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-slate-900 text-base">Settlement Details</h2>
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#FEF3C7] text-[#D97706] border border-[#FDE68A]">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    <span>Draft</span>
                </span>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
                
                <!-- Trip Summary Header -->
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 pb-6 border-b border-slate-100">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-[#0A2558]">TRP-2023-089</h2>
                        <p class="text-xs text-slate-500 font-medium mt-1">
                            Jakarta - Surabaya (Client Meeting)
                        </p>
                    </div>

                    <div class="text-right">
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400">TRAVELER</div>
                        <div class="font-bold text-slate-900 text-sm">Budi Santoso</div>
                        <div class="text-[11px] text-slate-400 font-medium">Sales Dept</div>
                    </div>
                </div>

                <!-- Expense Line Items & Financial Summary Box -->
                <div class="my-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="font-bold text-slate-800 text-sm">Expense Line Items</span>
                        <button type="button" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0A2558] hover:text-sky-700 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m-4-4h8" />
                            </svg>
                            <span>Add Row</span>
                        </button>
                    </div>

                    <!-- 3 Metric Columns Container -->
                    <div class="border border-slate-200 rounded-xl p-5 bg-slate-50/40 grid grid-cols-1 md:grid-cols-3 gap-6 divide-y md:divide-y-0 md:divide-x divide-slate-200">
                        <!-- Total Advance (A) -->
                        <div class="pt-3 md:pt-0">
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                TOTAL ADVANCE (A)
                            </div>
                            <div class="text-lg font-bold text-slate-900 mt-1">
                                Rp 4.500.000
                            </div>
                        </div>

                        <!-- Actual Expenses (B) -->
                        <div class="pt-3 md:pt-0 md:pl-6">
                            <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                ACTUAL EXPENSES (B)
                            </div>
                            <div class="text-lg font-bold text-slate-900 mt-1">
                                Rp 4.750.000
                            </div>
                        </div>

                        <!-- Balance (B - A) -->
                        <div class="pt-3 md:pt-0 md:pl-6 flex flex-col justify-between">
                            <div>
                                <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                    BALANCE (B - A)
                                </div>
                                <div class="text-lg font-bold text-slate-900 mt-1">
                                    Rp 4.750.000
                                </div>
                            </div>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-1.5 py-0.5 text-[9px] font-extrabold uppercase tracking-tight text-red-600 bg-red-50 border border-red-200 rounded">
                                    INSUFFICIENT PAYMENT
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Remarks / Justification -->
                <div class="mb-8">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Remarks / Justification (Optional)</label>
                    <textarea 
                        rows="3" 
                        placeholder="E.g., Flight ticket price increased due to late booking..." 
                        class="w-full bg-white border border-slate-200 rounded-xl p-3.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs resize-none"
                    ></textarea>
                </div>

                <!-- Action Button Footer -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('requests.index') }}" class="px-5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition shadow-2xs">
                        Back
                    </a>
                    <button type="button" class="px-5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition shadow-2xs">
                        Save Draft
                    </button>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 text-xs font-semibold text-white bg-[#0A2558] hover:bg-[#071d47] rounded-lg shadow-2xs transition duration-150 active:scale-[0.99]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        <span>Submit Settlement</span>
                    </button>
                </div>

            </div>
        </div>

    </div>
</x-app-travel-layout>
