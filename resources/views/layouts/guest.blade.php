<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PT Jaya Abadi — Travel Management') }}</title>

        <!-- Google Fonts: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            .diagonal-dark-backdrop {
                clip-path: polygon(0 0, 66% 0, 57% 100%, 0 100%);
            }
            @media (max-width: 1023px) {
                .diagonal-dark-backdrop {
                    clip-path: polygon(0 0, 100% 0, 100% 45%, 0 55%);
                }
            }
        </style>
    </head>
    <body class="bg-[#eff1f5] text-slate-800 antialiased font-sans selection:bg-[#eb4634] selection:text-white">
        <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-10 overflow-hidden">

            <!-- Outer Left Diagonal Dark Cosmic Mountain Backdrop (Matching Reference Image) -->
            <div class="diagonal-dark-backdrop absolute inset-0 bg-[#060a12] z-0 overflow-hidden pointer-events-none">
                <!-- Ambient Orange/Amber Cliff & Horizon Glow -->
                <div class="absolute -top-24 -left-24 w-[520px] h-[680px] rounded-full bg-gradient-to-br from-[#d95b26]/35 via-[#8c2d19]/20 to-transparent blur-3xl"></div>
                <div class="absolute bottom-0 left-[28%] w-[460px] h-[260px] rounded-full bg-gradient-to-t from-[#eb6b34]/30 via-[#eb4634]/10 to-transparent blur-2xl"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_25%_30%,rgba(28,45,78,0.35),rgba(6,10,18,0.95))]"></div>
            </div>

            <!-- Main Centered Floating Split Card -->
            <div
                x-data="{
                    slide: 0,
                    slides: [
                        { author: 'JayaAbadi.ui', role: 'UI & Travel Illustration', badge: 'Selected Works' },
                        { author: 'Smart SPPD', role: 'Auto Plafon & Policy Engine', badge: 'Dashboard 01' },
                        { author: 'Multi-Role', role: '5 Integrated Workspaces', badge: 'Dashboard 02' }
                    ],
                    nextSlide() { this.slide = (this.slide + 1) % this.slides.length },
                    prevSlide() { this.slide = (this.slide - 1 + this.slides.length) % this.slides.length }
                }"
                class="relative z-10 w-full max-w-[1040px] bg-white rounded-[34px] shadow-[0_30px_90px_-20px_rgba(6,10,18,0.45)] p-3 sm:p-4 grid grid-cols-1 lg:grid-cols-12 min-h-[620px]"
            >
                <!-- Left Illustrated Cosmic Mountain Panel -->
                <div class="lg:col-span-6 relative rounded-[26px] overflow-hidden min-h-[420px] lg:min-h-[588px] flex flex-col justify-between p-6 sm:p-8 text-white bg-[#070b14] select-none">

                    <!-- Layered Cosmic Cliff & Mountain Vector/Photo Artwork -->
                    <div class="absolute inset-0 z-0 overflow-hidden">
                        <!-- Deep Starfield & Night Sky Base -->
                        <div class="absolute inset-0 bg-gradient-to-b from-[#070c17] via-[#0c1626] to-[#121a24]"></div>

                        <!-- Stars -->
                        <svg class="absolute inset-0 w-full h-full opacity-70" viewBox="0 0 600 700" fill="none" preserveAspectRatio="xMidYMid slice">
                            <circle cx="210" cy="80" r="1" fill="#ffffff" opacity="0.8"/>
                            <circle cx="280" cy="140" r="1.4" fill="#ffffff" opacity="0.6"/>
                            <circle cx="340" cy="95" r="0.9" fill="#ffffff" opacity="0.7"/>
                            <circle cx="245" cy="210" r="1.2" fill="#ffd8b8" opacity="0.8"/>
                            <circle cx="190" cy="290" r="1" fill="#ffffff" opacity="0.5"/>
                            <circle cx="320" cy="255" r="1.1" fill="#ffffff" opacity="0.7"/>
                            <circle cx="390" cy="180" r="1" fill="#ffffff" opacity="0.4"/>
                            <circle cx="155" cy="360" r="1.3" fill="#ffffff" opacity="0.6"/>
                            <circle cx="265" cy="340" r="0.8" fill="#ffffff" opacity="0.5"/>

                            <!-- Giant Dark Cosmic Planet on Right -->
                            <circle cx="520" cy="260" r="240" fill="url(#darkPlanetGrad)" />
                            <circle cx="520" cy="260" r="240" stroke="url(#planetRimGrad)" stroke-width="1.5" opacity="0.6" />

                            <!-- Crescent Illuminated Small Planet in Center-Left Sky -->
                            <g transform="translate(215, 225)">
                                <circle cx="0" cy="0" r="22" fill="#0d1b2e" />
                                <path d="M0 -22 A22 22 0 0 1 22 0 A22 22 0 0 1 0 22 A15 22 0 0 0 0 -22 Z" fill="url(#crescentGrad)" />
                            </g>

                            <!-- Warm Sunset Horizon Glow (Bottom Right) -->
                            <ellipse cx="470" cy="545" rx="190" ry="75" fill="url(#horizonGlow)" />

                            <!-- Distant Jagged Mountain Range -->
                            <path d="M90 580 L195 390 L245 455 L310 355 L385 480 L435 430 L515 545 L600 520 L600 700 L0 700 L0 540 Z" fill="url(#farMountainGrad)" />

                            <!-- Foreground Sharp Illuminated Mountain Peaks -->
                            <path d="M120 620 L215 415 L250 475 L295 385 L360 510 L405 460 L485 585 L600 585 L600 700 L0 700 Z" fill="url(#nearMountainGrad)" />
                            <!-- Warm Rim Light on Mountain Ridges -->
                            <path d="M215 415 L232 475 L202 530 Z" fill="url(#ridgeHighlight)" opacity="0.75" />
                            <path d="M295 385 L318 465 L285 510 Z" fill="url(#ridgeHighlight)" opacity="0.85" />
                            <path d="M405 460 L430 525 L395 555 Z" fill="url(#ridgeHighlight)" opacity="0.65" />

                            <!-- Left Dramatic Orange-Lit Vertical Rock Cliff Formation -->
                            <path d="M0 0 L245 0 L210 75 L165 135 L180 190 L135 260 L145 335 L95 405 L130 475 L105 535 L45 585 L0 630 Z" fill="url(#leftCliffBase)" />
                            <path d="M0 0 L195 0 L165 70 L125 130 L145 185 L95 255 L115 330 L65 395 L105 470 L75 520 L0 570 Z" fill="url(#leftCliffGlow)" opacity="0.9" />

                            <!-- Foreground Dark Slope Base -->
                            <path d="M0 530 Q180 575 410 645 L600 675 L600 700 L0 700 Z" fill="#060911" />

                            <defs>
                                <linearGradient id="darkPlanetGrad" x1="280" y1="120" x2="620" y2="440" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#132238" />
                                    <stop offset="45%" stop-color="#09111e" />
                                    <stop offset="100%" stop-color="#04070d" />
                                </linearGradient>
                                <linearGradient id="planetRimGrad" x1="280" y1="180" x2="480" y2="420" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#5688c7" />
                                    <stop offset="50%" stop-color="#e87a48" />
                                    <stop offset="100%" stop-color="#070c17" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="crescentGrad" x1="0" y1="-22" x2="22" y2="22" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#f99c52" />
                                    <stop offset="60%" stop-color="#5da9e9" />
                                    <stop offset="100%" stop-color="#1d3557" />
                                </linearGradient>
                                <radialGradient id="horizonGlow" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(470 545) scale(190 75)">
                                    <stop offset="0%" stop-color="#ff7b39" stop-opacity="0.75" />
                                    <stop offset="55%" stop-color="#d94e28" stop-opacity="0.3" />
                                    <stop offset="100%" stop-color="#09111e" stop-opacity="0" />
                                </radialGradient>
                                <linearGradient id="farMountainGrad" x1="300" y1="355" x2="300" y2="650" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#2a3546" />
                                    <stop offset="60%" stop-color="#141c29" />
                                    <stop offset="100%" stop-color="#070a12" />
                                </linearGradient>
                                <linearGradient id="nearMountainGrad" x1="300" y1="385" x2="300" y2="680" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#3c4657" />
                                    <stop offset="45%" stop-color="#1b222e" />
                                    <stop offset="100%" stop-color="#060911" />
                                </linearGradient>
                                <linearGradient id="ridgeHighlight" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0%" stop-color="#ff9e66" />
                                    <stop offset="60%" stop-color="#c86446" />
                                    <stop offset="100%" stop-color="#1b222e" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="leftCliffBase" x1="0" y1="0" x2="240" y2="550" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#2b1818" />
                                    <stop offset="45%" stop-color="#4e261e" />
                                    <stop offset="85%" stop-color="#1e1822" />
                                    <stop offset="100%" stop-color="#080c14" />
                                </linearGradient>
                                <linearGradient id="leftCliffGlow" x1="20" y1="40" x2="195" y2="520" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#e25b2d" stop-opacity="0.65" />
                                    <stop offset="35%" stop-color="#f0783c" stop-opacity="0.85" />
                                    <stop offset="70%" stop-color="#a83d24" stop-opacity="0.55" />
                                    <stop offset="100%" stop-color="#16131c" stop-opacity="0.1" />
                                </linearGradient>
                            </defs>
                        </svg>

                        <!-- Subtle Vignette Overlay for Text Contrast -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/35 via-transparent to-black/65"></div>
                    </div>

                    <!-- Top Bar Inside Left Panel -->
                    <div class="relative z-10 flex items-center justify-between gap-4">
                        <a href="{{ url('/') }}" class="text-sm font-semibold tracking-tight text-white hover:text-[#ff9e66] transition" x-text="slides[slide].badge">
                            Selected Works
                        </a>

                        <div class="flex items-center gap-4">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-xs font-medium text-white/90 hover:text-white transition">
                                    Sign Up
                                </a>
                            @endif
                            <a href="{{ url('/') }}" class="rounded-full border border-white/60 hover:border-white px-5 py-1.5 text-xs font-medium text-white hover:bg-white/10 transition">
                                Join Us
                            </a>
                        </div>
                    </div>

                    <!-- Bottom Bar Inside Left Panel -->
                    <div class="relative z-10 flex items-center justify-between gap-4 pt-6">
                        <div class="flex items-center gap-3.5">
                            <!-- Illustrated Character Avatar Circle (Matching Reference Image) -->
                            <div class="w-11 h-11 rounded-full bg-[#1e90ff] border-2 border-white/25 shadow-lg flex items-center justify-center overflow-hidden shrink-0">
                                <svg class="w-9 h-9 mt-1" viewBox="0 0 64 64" fill="none">
                                    <!-- Shoulders / Red Hoodie -->
                                    <path d="M12 62 C12 48 52 48 52 62" fill="#e63946"/>
                                    <!-- Neck -->
                                    <rect x="27" y="40" width="10" height="8" rx="4" fill="#fca387"/>
                                    <!-- Face -->
                                    <circle cx="32" cy="29" r="12" fill="#ffbfa8"/>
                                    <!-- Blonde Stylized Hair -->
                                    <path d="M19 27 C19 16 28 13 35 14 C42 15 45 20 44 27 C42 22 36 20 30 21 C24 22 21 25 19 27 Z" fill="#ffd166"/>
                                    <!-- Eyes & Smile -->
                                    <circle cx="28" cy="28" r="1.5" fill="#1d3557"/>
                                    <circle cx="36" cy="28" r="1.5" fill="#1d3557"/>
                                    <path d="M29 34 Q32 37 35 34" stroke="#e63946" stroke-width="1.8" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-white leading-tight" x-text="slides[slide].author">JayaAbadi.ui</div>
                                <div class="text-xs text-white/75 mt-0.5" x-text="slides[slide].role">UI &amp; Travel Illustration</div>
                            </div>
                        </div>

                        <!-- Left / Right Circular Navigation Arrows -->
                        <div class="flex items-center gap-2.5">
                            <button
                                type="button"
                                @click="prevSlide()"
                                aria-label="Previous slide"
                                class="w-9 h-9 rounded-full border border-white/35 flex items-center justify-center text-white/90 hover:bg-white/15 hover:border-white transition cursor-pointer"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m0 0l6-6m-6 6l6 6" />
                                </svg>
                            </button>
                            <button
                                type="button"
                                @click="nextSlide()"
                                aria-label="Next slide"
                                class="w-9 h-9 rounded-full border border-white/35 flex items-center justify-center text-white/90 hover:bg-white/15 hover:border-white transition cursor-pointer"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m0 0l-6-6m6 6l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right White Form Panel -->
                <div class="lg:col-span-6 bg-white px-6 py-7 sm:px-11 sm:py-8 flex flex-col justify-between">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
