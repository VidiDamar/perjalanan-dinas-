<x-app-travel-layout>
    <!-- Header Title & Subtitle -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Request Center</h1>
        <p class="text-sm text-slate-500 font-medium mt-1">Review and manage pending travel requests.</p>
    </div>

    <form action="#" method="POST" onsubmit="event.preventDefault();" class="space-y-6">
        @csrf

        <!-- CARD 1: Trip Details -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
            <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg mb-6 pb-4 border-b border-slate-100">
                <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>
                <span>Trip Details</span>
            </div>

            <div class="space-y-5">
                <!-- Trip Purpose -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Trip Purpose</label>
                    <input 
                        type="text" 
                        placeholder="e.g., Q3 Client Onboarding" 
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                    />
                </div>

                <!-- Destination City & Transport Mode -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Destination City</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </span>
                            <input 
                                type="text" 
                                placeholder="Search city..." 
                                class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Transport Mode</label>
                        <div class="relative">
                            <select class="w-full appearance-none bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10 shadow-2xs">
                                <option selected>Flight</option>
                                <option>Train</option>
                                <option>Company Car</option>
                                <option>Rental Car</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Departure Date & Return Date -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Departure Date</label>
                        <input 
                            type="text" 
                            placeholder="mm/dd/yyyy" 
                            onfocus="(this.type='date')" 
                            onblur="if(!this.value)this.type='text'"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Return Date</label>
                        <input 
                            type="text" 
                            placeholder="mm/dd/yyyy" 
                            onfocus="(this.type='date')" 
                            onblur="if(!this.value)this.type='text'"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: Estimated Expenses -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs" x-data="{
            expenses: [
                { type: 'Transport (Flight/Train)', amount: '0' },
                { type: 'Accommodation (Hotel)', amount: '0' },
                { type: 'Per Diem / Meals', amount: '0' }
            ],
            addRow() {
                this.expenses.push({ type: 'Other', amount: '0' });
            }
        }">
            <div class="flex items-center justify-between flex-wrap gap-3 pb-4 mb-6 border-b border-slate-100">
                <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg">
                    <svg class="w-5 h-5 text-[#0A2558]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                        <circle cx="12" cy="15" r="2" />
                    </svg>
                    <span>Estimated Expenses</span>
                </div>

                <!-- Policy Badge -->
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-[#DCFCE7] text-[#15803D] border border-[#BBF7D0]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <span>Policy check: Within budget limit</span>
                </div>
            </div>

            <!-- Expense Rows -->
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-semibold text-slate-500">
                    <div>Expense Type</div>
                    <div>Estimated Amount (IDR)</div>
                </div>

                <template x-for="(expense, index) in expenses" :key="index">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                        <!-- Expense Type Dropdown -->
                        <div class="relative">
                            <select x-model="expense.type" class="w-full appearance-none bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10 shadow-2xs">
                                <option>Transport (Flight/Train)</option>
                                <option>Accommodation (Hotel)</option>
                                <option>Per Diem / Meals</option>
                                <option>Local Transport</option>
                                <option>Other</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </div>

                        <!-- Estimated Amount Input -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 text-sm font-semibold">
                                Rp
                            </div>
                            <input 
                                type="text" 
                                x-model="expense.amount"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-800 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 transition shadow-2xs"
                            />
                        </div>
                    </div>
                </template>

                <!-- Add Row Button -->
                <div class="pt-2 flex justify-end">
                    <button 
                        type="button" 
                        @click="addRow()"
                        class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0A2558] hover:text-sky-700 transition"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m-4-4h8" />
                        </svg>
                        <span>Add Row</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- CARD 3: Supporting Documents -->
        <div class="bg-white rounded-2xl border border-slate-200/90 p-6 md:p-8 shadow-xs">
            <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-lg mb-6 pb-4 border-b border-slate-100">
                <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                <span>Supporting Documents</span>
            </div>

            <!-- Upload Area Drag and Drop -->
            <div class="border-2 border-dashed border-slate-300 rounded-2xl p-8 flex flex-col items-center justify-center text-center hover:bg-slate-50/60 transition cursor-pointer group">
                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 group-hover:scale-110 group-hover:text-sky-600 transition mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                </div>
                <div class="text-sm font-semibold text-slate-700">
                    Drag and drop files here or <span class="text-[#0A2558] underline hover:text-sky-700">browse</span>
                </div>
                <div class="text-[11px] text-slate-400 mt-1">
                    Upload 'Surat Tugas', Invitations, or reference materials (PDF, JPG, PNG up to 10MB)
                </div>
                <input type="file" class="hidden" />
            </div>
        </div>

        <!-- Footer Action Buttons (Back & Submit Request) -->
        <div class="pt-2 flex items-center justify-end gap-3">
            <a href="{{ route('requests.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 shadow-2xs transition">
                Back
            </a>
            <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-[#0A2558] hover:bg-[#081c42] rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
                Submit Request
            </button>
        </div>
    </form>
</x-app-travel-layout>
