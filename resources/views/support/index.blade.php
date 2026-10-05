<x-app-travel-layout>
    <!-- Header Title & Subtitle -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-[28px] font-bold text-slate-900 tracking-tight">Support & Help Center</h1>
        <p class="text-sm text-slate-500 font-medium mt-1">Find answers, get help, or contact our support teams.</p>
    </div>

    <!-- Main Grid (Kiri: Search & FAQ | Kanan: Ticket, Contacts, Manual Book) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- KOLOM KIRI (2 Col Span) -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            
            <!-- Card 1: How can we help you today? -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <h2 class="text-lg font-bold text-slate-900 mb-4">How can we help you today?</h2>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        placeholder="Search for 'claim reimbursement' or 'travel limits'..." 
                        class="w-full pl-11 pr-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder-slate-400 transition"
                    />
                </div>
            </div>

            <!-- Card 2: Frequently Asked Questions -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs" x-data="{ openFaq: null }">
                <div class="flex items-center gap-2.5 text-[#0A2558] font-bold text-base mb-6">
                    <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                    <span>Frequently Asked Questions</span>
                </div>

                <!-- Accordion Items -->
                <div class="divide-y divide-slate-100 text-sm">
                    <!-- FAQ 1 -->
                    <div class="py-4 first:pt-0">
                        <button 
                            type="button" 
                            @click="openFaq = openFaq === 1 ? null : 1" 
                            class="w-full flex items-center justify-between text-left font-semibold text-slate-800 hover:text-slate-900 transition"
                        >
                            <span>How to claim reimbursement?</span>
                            <svg 
                                class="w-4 h-4 text-slate-500 transition-transform duration-200" 
                                :class="{ 'rotate-180': openFaq === 1 }"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="openFaq === 1" x-collapse x-cloak class="mt-3 text-slate-600 text-xs leading-relaxed">
                            To claim reimbursement, submit your original receipt and proof of travel under the Settlements module within 7 business days after returning from your trip.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="py-4">
                        <button 
                            type="button" 
                            @click="openFaq = openFaq === 2 ? null : 2" 
                            class="w-full flex items-center justify-between text-left font-semibold text-slate-800 hover:text-slate-900 transition"
                        >
                            <span>What are the travel policy limits?</span>
                            <svg 
                                class="w-4 h-4 text-slate-500 transition-transform duration-200" 
                                :class="{ 'rotate-180': openFaq === 2 }"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="openFaq === 2" x-collapse x-cloak class="mt-3 text-slate-600 text-xs leading-relaxed">
                            Domestic flights should be booked in economy class. Accommodation allowance is up to IDR 1,500,000/night for staff and IDR 2,500,000/night for managerial level.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="py-4 last:pb-0">
                        <button 
                            type="button" 
                            @click="openFaq = openFaq === 3 ? null : 3" 
                            class="w-full flex items-center justify-between text-left font-semibold text-slate-800 hover:text-slate-900 transition"
                        >
                            <span>How do I cancel a pending request?</span>
                            <svg 
                                class="w-4 h-4 text-slate-500 transition-transform duration-200" 
                                :class="{ 'rotate-180': openFaq === 3 }"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="openFaq === 3" x-collapse x-cloak class="mt-3 text-slate-600 text-xs leading-relaxed">
                            You can cancel any request that has not yet received final finance approval by opening the request details and selecting "Cancel Request".
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div>
                <a href="{{ route('requests.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition shadow-xs">
                    Back
                </a>
            </div>

        </div>

        <!-- KOLOM KANAN (1 Col Span) -->
        <div class="flex flex-col gap-6">
            
            <!-- Card 1: Submit a Ticket -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <div class="flex items-center gap-2.5 text-slate-900 font-bold text-base mb-5">
                    <svg class="w-5 h-5 text-[#0A2558]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>
                    <span>Submit a Ticket</span>
                </div>

                <form action="#" method="POST" class="space-y-4" onsubmit="event.preventDefault();">
                    <!-- Issue Category -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Issue Category</label>
                        <div class="relative">
                            <select class="w-full appearance-none bg-slate-50/70 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 font-medium focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 cursor-pointer pr-10">
                                <option>System Error</option>
                                <option>Policy & Limits</option>
                                <option>Reimbursement Issue</option>
                                <option>Account & Access</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Description</label>
                        <textarea 
                            rows="4" 
                            placeholder="Describe your issue..." 
                            class="w-full bg-slate-50/70 border border-slate-200 rounded-xl p-3.5 text-sm text-slate-700 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 placeholder-slate-400 resize-none transition"
                        ></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full bg-[#0A2558] hover:bg-[#081c42] text-white font-medium text-sm py-2.5 px-4 rounded-xl shadow-xs transition duration-150 active:scale-[0.99]">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>

            <!-- Card 2: Direct Contacts -->
            <div class="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs">
                <div class="text-[11px] font-bold text-slate-400 tracking-wider uppercase mb-4">
                    DIRECT CONTACTS
                </div>

                <div class="space-y-4">
                    <!-- Contact 1: Travel Admin Team -->
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-lg bg-[#E0F2FE] text-[#0284C7] flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-slate-800 text-xs">Travel Admin Team</div>
                            <div class="text-[11px] text-slate-500 mt-0.5">Ext: 4402 &bull; travel@jayaabadi.co.id</div>
                        </div>
                    </div>

                    <!-- Contact 2: Finance & Approvals -->
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 rounded-lg bg-[#78350F] text-amber-200 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5M4.5 21V10.5M3 21h18" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-slate-800 text-xs">Finance & Approvals</div>
                            <div class="text-[11px] text-slate-500 mt-0.5">Ext: 5110 &bull; finance@jayaabadi.co.id</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: User Manual Book -->
            <div class="bg-[#EEF2F6] rounded-2xl p-6 text-center shadow-xs">
                <div class="w-10 h-10 mx-auto text-[#0A2558] mb-2 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <h3 class="font-bold text-slate-800 text-sm">User Manual Book</h3>
                <p class="text-[11px] text-slate-500 mt-1 mb-4 font-normal">Complete guide to using CTMS v2.1</p>
                
                <button type="button" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold rounded-xl border border-slate-200/90 shadow-2xs transition">
                    <svg class="w-3.5 h-3.5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <span>Download PDF</span>
                </button>
            </div>

        </div>

    </div>
</x-app-travel-layout>
