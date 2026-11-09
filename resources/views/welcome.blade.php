<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <link href="https://cdn.prod.website-files.com" rel="preconnect" crossorigin="anonymous"/>
    <title>Jaya Abadi — Corporate Travel Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('logo_perusahaan.png') }}"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link href="{{ asset('vita/vita-travel.webflow.shared.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">
        WebFont.load({
            google: {
                families: ["Inter:300,400,500,600,700"]
            }
        });
    </script>
    <script type="text/javascript">
        !function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);
    </script>
</head>
<body class="body">
    <div class="w-embed">
        <style>
            /* Fluid responsive */
            html {
                font-size: calc(16 * (100vw / 1440));
            }

            @media (max-width: 479px) {
                html {
                    font-size: calc(16 * (100vw / 375));
                }
            }

            @media (min-width: 1440px) {
                html {
                    font-size: 16px;
                }
            }

            @media (min-width: 1920px) {
                html {
                    font-size: calc(16 * (100vw / 1920));
                }
            }

            @media (min-width: 1024px) and (max-height: 800px) {
                html {
                    font-size: calc(14 * (100vw / 1440));
                }
            }
        </style>
        <link rel="stylesheet" href="{{ asset('vita/app.min.css') }}">
    </div>

    <!-- Header Navigation (Exact Vita Travel Structure) -->
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="header w-nav">
        <div class="header__in">
            <a href="{{ url('/') }}" aria-current="page" class="header__l w-inline-block w--current">
                <div data-anim="fade-down" class="header-logo" style="display: flex; align-items: center; gap: 0.75rem;">
                    <img src="{{ asset('logo_perusahaan.png') }}" alt="Logo PT Jaya Abadi" class="header-logo__icon" style="width: 38px; height: 38px; object-fit: contain;">
                    <div class="header-logo__title">Jaya Abadi</div>
                </div>
                <div class="header__dec header__dec--2"></div>
            </a>

            <div class="header__r">
                <ul role="list" class="header-nav">
                    <li data-anim-delay="0.1" data-anim="fade-down" class="header-nav__item">
                        <a href="#retreats" class="button-sm color-white header-nav__link"><span class="color-white-40 mobile-visible-inline">+</span>5 Role Workspace</a>
                    </li>
                    <li data-anim-delay="0.2" data-anim="fade-down" class="header-nav__item">
                        <a href="{{ route('login') }}" class="button-sm color-white header-nav__link"><span class="color-white-40 mobile-visible-inline">+</span>Login</a>
                    </li>
                </ul>
                <a href="{{ route('login') }}" class="header__accent mobile-hidden w-inline-block">
                    <div data-anim-delay="0.3" data-anim="fade-down" class="button-sm color-white">Masuk Sistem</div>
                    <div class="header__dec header__dec--3"></div>
                </a>
                <div class="header__button mobile-visible">
                    <a data-wf--button-primary--variant="full-width-mobile" href="{{ route('login') }}" class="btn-primary w-variant-a8690625-644e-5667-ae83-53408c6b0c16 w-inline-block">
                        <div class="button-sm color-brand-green">Masuk ke Sistem</div>
                        <div class="btn-icon w-embed">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="#0D2E37"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <div class="header__burger">
                <a href="#" class="btn-burger w-inline-block">
                    <div class="btn-burger__in">
                        <div class="btn-burger__line btn-burger__line--1"></div>
                        <div class="btn-burger__line btn-burger__line--2"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="mobile-menu">
            <ul role="list" class="header-nav">
                <li class="header-nav__item">
                    <a href="#retreats" class="button-sm color-white header-nav__link"><span class="color-white-40 mobile-visible-inline">+</span>5 Role Workspace</a>
                </li>
                <li class="header-nav__item">
                    <a href="{{ route('login') }}" class="button-sm color-white header-nav__link"><span class="color-white-40 mobile-visible-inline">+</span>Login</a>
                </li>
            </ul>
            <div class="header__button mobile-visible">
                <a data-wf--button-primary--variant="full-width-mobile" href="{{ route('login') }}" class="btn-primary w-variant-a8690625-644e-5667-ae83-53408c6b0c16 w-inline-block">
                    <div class="button-sm color-brand-green">Masuk ke Sistem</div>
                    <div class="btn-icon w-embed">
                        <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="#0D2E37"/>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
        <div class="header__dec header__dec--1"></div>
    </div>

    <div class="page-wrapper">
        <div class="main-wrapper">
            <!-- Section 1: Hero Intro (Exact Vita Travel 2-Layer Cutout Sandwich) -->
            <section class="intro">
                <div class="container">
                    <div class="intro__in">
                        <div class="intro__text">
                            <div data-anim="fade-up-big" class="h1 mobile-margin-bottom-16 intro__headline">Travel</div>
                            <div class="margin-bottom-32 z-index-3">
                                <div data-anim-delay="0.1" data-anim="fade-up" class="body-xxl">Command Center PT Jaya Abadi. Kelola SPPD, <br/>approval, tiket, dan settlement di satu dashboard.</div>
                            </div>
                            <div data-anim-delay="0.2" data-anim="fade-up" class="intro__button mobile-hidden z-index-3">
                                <a data-wf--button-primary--variant="full-width-mobile" href="#retreats" class="btn-primary w-variant-a8690625-644e-5667-ae83-53408c6b0c16 w-inline-block">
                                    <div class="button-sm color-brand-green">Jelajahi Isi Dashboard</div>
                                    <div class="btn-icon w-embed">
                                        <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="#0D2E37"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="intro__button mobile-visible z-index-3">
                    <a data-wf--button-primary--variant="full-width-mobile" href="#retreats" class="btn-primary w-variant-a8690625-644e-5667-ae83-53408c6b0c16 w-inline-block">
                        <div class="button-sm color-brand-green">Jelajahi Isi Dashboard</div>
                        <div class="btn-icon w-embed">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="#0D2E37"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69b131f7e83fd36f79be5b78_bg-part-1.webp" loading="eager" alt="" class="intro-bg-part intro-bg-part--1 mobile-hidden"/>
                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69b13422ebe5cda64625a488_mobile-bg-part-1.webp" loading="eager" alt="" class="intro-bg-part intro-bg-part--1 mobile-visible"/>
                <div class="intro-bg-dark"></div>
                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69b131f75b251dd705fc8bb9_bg-part-2.webp" loading="eager" alt="" class="intro-bg-part intro-bg-part--2 mobile-hidden"/>
                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69b134223848489eddf4f3cf_mobile-bg-part-2.webp" loading="eager" alt="" class="intro-bg-part intro-bg-part--2 mobile-visible"/>
            </section>

            <!-- Section 2: Statistic Section (3 Pillars of the CTMS Dashboard) -->
            <section class="statistic-section padding-global">
                <div class="container">
                    <div class="head">
                        <div class="row mobile-column">
                            <div class="column column-3">
                                <div data-anim="statistic-head-title" class="head__title mobile-margin-bottom-24">
                                    <img src="{{ asset('logo_perusahaan.png') }}" loading="lazy" alt="Logo PT Jaya Abadi" class="logo-mini" style="object-fit: contain;"/>
                                    <div class="body-md">Arsitektur Dashboard</div>
                                </div>
                            </div>
                            <div class="column column-9">
                                <div class="head__description">
                                    <div data-anim="statistic-h2" class="h2 mobile-font-size-36 mobile-no-br">Tiga pilar kendali utama di dalam <br/>ekosistem Dashboard CTMS <br/>Lihat cara kerjanya</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="statistic__wrapper">
                    <div class="statistic__items">
                        <div data-anim="statistic-item-1" class="statistic-item">
                            <div class="statistic-item__head">
                                <div data-anim="statistic-item-title" class="body-lg-semibold">Smart SPPD &amp; Plafon</div>
                                <div data-anim="statistic-item-subtitle" class="body-md color-white-50">/ 4 Grade Jabatan</div>
                            </div>
                            <div class="statistic-item__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/6971da641fb15bbf6432e993_statistic-1.webp" loading="lazy" data-anim="statistic-item-illustration" alt="" class="statistic-item__illustration"/>
                            </div>
                            <div data-anim="statistic-border-right-1" class="statistic__border statistic__border--right"></div>
                        </div>
                        <div data-anim="statistic-item-2" class="statistic-item">
                            <div class="statistic-item__head">
                                <div data-anim="statistic-item-title" class="body-lg-semibold">Approval &amp; Delegasi</div>
                                <div data-anim="statistic-item-subtitle" class="body-md color-white-50">/ Otorisasi Berjenjang</div>
                            </div>
                            <div class="statistic-item__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/6971da644ade29a121769faf_statistic-2.webp" loading="lazy" data-anim="statistic-item-illustration" alt="" class="statistic-item__illustration"/>
                            </div>
                            <div data-anim="statistic-border-right-2" class="statistic__border statistic__border--right"></div>
                        </div>
                        <div data-anim="statistic-item-3" class="statistic-item">
                            <div class="statistic-item__head">
                                <div data-anim="statistic-item-title" class="body-lg-semibold">Tiket, Kasbon &amp; Audit</div>
                                <div data-anim="statistic-item-subtitle" class="body-md color-white-50">/ Settlement Otomatis</div>
                            </div>
                            <div class="statistic-item__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/6971da64c60674c148d40058_statistic-3.webp" loading="lazy" data-anim="statistic-item-illustration" alt="" class="statistic-item__illustration"/>
                            </div>
                        </div>
                    </div>
                    <div data-anim="statistic-border-top" class="statistic__border statistic__border--top"></div>
                    <div data-anim="statistic-border-bottom" class="statistic__border statistic__border--bottom"></div>
                </div>
            </section>

            <!-- Section 3: About Section (Editorial Overview of Dashboard Capabilities) -->
            <section class="about-section padding-global">
                <div class="container">
                    <div class="head">
                        <div class="row mobile-column">
                            <div class="column column-3">
                                <div data-anim="about-section-head" class="head__title mobile-margin-bottom-24">
                                    <img src="{{ asset('logo_perusahaan.png') }}" loading="lazy" alt="Logo PT Jaya Abadi" class="logo-mini" style="object-fit: contain;"/>
                                    <div class="body-md">Tentang Dashboard</div>
                                </div>
                            </div>
                            <div class="column column-9">
                                <div class="head__description">
                                    <div data-anim="about-head-description" class="h2 mobile-font-size-36 mobile-no-br">Bukan sekadar pencatatan SPPD <br/>melainkan kendali penuh anggaran</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about">
                        <div class="about__visual">
                            <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/6979a5eeee86150be7247f79_illustration-about.jpg" loading="lazy" data-animation="about-illustration" alt="" class="about__illustration"/>
                        </div>
                        <div class="about__content">
                            <div class="about__head">
                                <div data-animation="about-head" class="body-xl mobile-font-size-22 mobile-no-br">          Dashboard CTMS PT Jaya Abadi menyatukan perencanaan <br/>perjalanan dinas, kalkulator plafon otomatis, persetujuan <br/>atasan, penerbitan kode PNR &amp; hotel, hingga rekonsiliasi <br/>nota settlement dalam satu sistem terintegrasi.</div>
                            </div>
                            <div class="about__items">
                                <div class="about-item">
                                    <div class="about-item__head">
                                        <div data-animation="about-item-head-1" class="h3">5 Role</div>
                                        <div data-animation="about-item-description-1" class="body-l">Workspace khusus <br/>lintas divisi</div>
                                    </div>
                                    <div class="about-item__footer">
                                        <div data-animation="about-item-footer" class="body-md color-white-60">Menghubungkan Karyawan, Atasan, Travel Desk, Finance, dan Super Admin secara real-time.</div>
                                    </div>
                                </div>
                                <div class="about-item">
                                    <div class="about-item__head">
                                        <div data-animation="about-item-head-2" class="h3">100%</div>
                                        <div data-animation="about-item-description-2" class="body-l">Kepatuhan plafon <br/>&amp; jejak audit</div>
                                    </div>
                                    <div class="about-item__footer">
                                        <div data-animation="about-item-footer-logos" class="about-item__logos">
                                            <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/6979c88e48ff7d66e04b4f57_logo-1.svg" loading="lazy" alt="" class="about-item__logo"/>
                                            <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/6979c88e6cc38feb34058869_logo-2.svg" loading="lazy" alt="" class="about-item__logo"/>
                                            <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/6979c88e719c9487a173c80a_logo-3.svg" loading="lazy" alt="" class="about-item__logo mobile-hidden"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section 4: Featured Section (Detailed Breakdown of What is Inside Each Dashboard Module) -->
            <section id="retreats" class="featured-section padding-global">
                <div class="container">
                    <div class="head">
                        <div class="row align-end mobile-column">
                            <div class="column column-6">
                                <div class="head__description mobile-margin-bottom-16">
                                    <div data-animation="featured-head" class="h2 mobile-h3">5 Role <span class="mobile-fw">Workspace</span></div>
                                </div>
                            </div>
                            <div class="column column-6">
                                <div class="featured-section__head">
                                    <div data-animation="featured-head-description" class="body-md color-white-60 mobile-no-br">Pelajari indikator KPI, tabel pemantauan, dan tombol aksi <br/>yang tersedia di dalam masing-masing dashboard pengguna.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="featured">
                        <div class="featured__items">
                            <!-- Item 1: Dashboard Karyawan -->
                            <div class="featured-item">
                                <div class="featured-item__text">
                                    <div class="featured-item__head">
                                        <div data-animation="featured-item-head" class="h4">Dashboard Karyawan &amp; Pengajuan SPPD</div>
                                        <div data-animation="featured-item-cost" class="featured-item__cost">
                                            <div class="body-md color-white-60">modul</div>
                                            <div class="body-lg-semibold">Role 01</div>
                                        </div>
                                    </div>
                                    <div class="featured-item__visual mobile-visible">
                                        <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b0f75d450e622eb69bbb9_1.webp" loading="lazy" alt="" class="featured-item__illustration"/>
                                    </div>
                                    <div class="featured-item__body">
                                        <div class="featured-item__properties">
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">KPI Perjalanan Aktif, Menunggu Approval &amp; Total SPPD</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0cfc7c0ffb4594ddd_200b069e26d5dbf25e7efe28a16ac85b_pin.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Form SPPD Cerdas <span class="color-white-60">(Kalkulator Plafon Otomatis)</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d013c40d035e576fc8_calendar.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Check-in Lokasi Dinas &amp; Unduh E-SPPD / E-Ticket</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0b38d158447cd2f5b_users.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Pelaporan Nota Settlement <span class="color-white-60">&amp; Klaim Reimburse</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b13a6c05aa0554867732d_stars.svg" loading="lazy" alt="" class="featured-item-property__icon size-l"/>
                                            </div>
                                        </div>
                                        <div data-animation="featured-item-button" class="featured-item__button">
                                            <a data-wf--button-secondary--variant="full-width" href="{{ route('login') }}" class="btn-secondary w-variant-28eadc15-d435-4480-c473-16eb53816cbc w-inline-block">
                                                <div class="button-sm color-white">Masuk ke Sistem</div>
                                                <div class="btn-icon w-embed">
                                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="white"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-item__visual mobile-hidden">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b0f75d450e622eb69bbb9_1.webp" loading="lazy" data-animation="featured-item-illustration" alt="" class="featured-item__illustration"/>
                                </div>
                            </div>

                            <!-- Item 2: Dashboard Atasan -->
                            <div class="featured-item">
                                <div class="featured-item__text">
                                    <div class="featured-item__head">
                                        <div data-animation="featured-item-head" class="h4">Dashboard Atasan <br/>&amp; Otorisasi Berjenjang</div>
                                        <div data-animation="featured-item-cost" class="featured-item__cost">
                                            <div class="body-md color-white-60">modul</div>
                                            <div class="body-lg-semibold">Role 02</div>
                                        </div>
                                    </div>
                                    <div class="featured-item__visual mobile-visible">
                                        <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b0f759c0200e2421e8d01_2.webp" loading="lazy" alt="" class="featured-item__illustration"/>
                                    </div>
                                    <div class="featured-item__body">
                                        <div class="featured-item__properties">
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Antrean Persetujuan SPPD Anggota Departemen</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0cfc7c0ffb4594ddd_200b069e26d5dbf25e7efe28a16ac85b_pin.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Audit Plafon Otomatis <span class="color-white-60">(Sesuai / Melebihi Plafon)</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d013c40d035e576fc8_calendar.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Keputusan 3-Aksi: Setujui, Minta Revisi, atau Tolak</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0b38d158447cd2f5b_users.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Pengaturan Delegasi Wewenang <span class="color-white-60">saat Cuti / Dinas</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b13a6c05aa0554867732d_stars.svg" loading="lazy" alt="" class="featured-item-property__icon size-l"/>
                                            </div>
                                        </div>
                                        <div data-animation="featured-item-button" class="featured-item__button">
                                            <a data-wf--button-secondary--variant="full-width" href="{{ route('login') }}" class="btn-secondary w-variant-28eadc15-d435-4480-c473-16eb53816cbc w-inline-block">
                                                <div class="button-sm color-white">Masuk ke Sistem</div>
                                                <div class="btn-icon w-embed">
                                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="white"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-item__visual mobile-hidden">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b0f759c0200e2421e8d01_2.webp" loading="lazy" data-animation="featured-item-illustration" alt="" class="featured-item__illustration"/>
                                </div>
                            </div>

                            <!-- Item 3: Dashboard Travel Desk -->
                            <div class="featured-item">
                                <div class="featured-item__text">
                                    <div class="featured-item__head">
                                        <div data-animation="featured-item-head" class="h4">Dashboard Admin Travel &amp; Penerbitan PNR</div>
                                        <div data-animation="featured-item-cost" class="featured-item__cost">
                                            <div class="body-md color-white-60">modul</div>
                                            <div class="body-lg-semibold">Role 03</div>
                                        </div>
                                    </div>
                                    <div class="featured-item__body">
                                        <div class="featured-item__visual mobile-visible">
                                            <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b0f75e8fb56ed1c7f7c90_3.webp" loading="lazy" alt="" class="featured-item__illustration"/>
                                        </div>
                                        <div class="featured-item__properties">
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Antrean SPPD Disetujui yang Siap Dipesankan Tiket</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0cfc7c0ffb4594ddd_200b069e26d5dbf25e7efe28a16ac85b_pin.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Input Kode Booking PNR <span class="color-white-60">&amp; Nomor E-Ticket</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d013c40d035e576fc8_calendar.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Input Kode Voucher Hotel &amp; Realisasi Biaya Aktual</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0b38d158447cd2f5b_users.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Direktori Mitra Vendor <span class="color-white-60">&amp; Ekspor Katalog CSV</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b13a6c05aa0554867732d_stars.svg" loading="lazy" alt="" class="featured-item-property__icon size-l"/>
                                            </div>
                                        </div>
                                        <div data-animation="featured-item-button" class="featured-item__button">
                                            <a data-wf--button-secondary--variant="full-width" href="{{ route('login') }}" class="btn-secondary w-variant-28eadc15-d435-4480-c473-16eb53816cbc w-inline-block">
                                                <div class="button-sm color-white">Masuk ke Sistem</div>
                                                <div class="btn-icon w-embed">
                                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="white"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-item__visual mobile-hidden">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b0f75e8fb56ed1c7f7c90_3.webp" loading="lazy" data-animation="featured-item-illustration" alt="" class="featured-item__illustration"/>
                                </div>
                            </div>

                            <!-- Item 4: Dashboard Finance -->
                            <div class="featured-item">
                                <div class="featured-item__text">
                                    <div class="featured-item__head">
                                        <div data-animation="featured-item-head" class="h4">Dashboard Keuangan, Kasbon &amp; Audit Nota</div>
                                        <div data-animation="featured-item-cost" class="featured-item__cost">
                                            <div class="body-md color-white-60">modul</div>
                                            <div class="body-lg-semibold">Role 04</div>
                                        </div>
                                    </div>
                                    <div class="featured-item__visual mobile-visible">
                                        <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b0f75cd93fd313dfcc0bd_4.webp" loading="lazy" alt="" class="featured-item__illustration"/>
                                    </div>
                                    <div class="featured-item__body">
                                        <div class="featured-item__properties">
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Pencairan Uang Muka (Cash Advance) via Transfer Bank</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0cfc7c0ffb4594ddd_200b069e26d5dbf25e7efe28a16ac85b_pin.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Verifikasi Struk &amp; Nota <span class="color-white-60">(Audit Settlement)</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d013c40d035e576fc8_calendar.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Kalkulasi Otomatis Selisih Refund vs Reimburse</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0b38d158447cd2f5b_users.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Laporan Buku Besar <span class="color-white-60">&amp; Ekspor General Ledger CSV</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b13a6c05aa0554867732d_stars.svg" loading="lazy" alt="" class="featured-item-property__icon size-l"/>
                                            </div>
                                        </div>
                                        <div data-animation="featured-item-button" class="featured-item__button">
                                            <a data-wf--button-secondary--variant="full-width" href="{{ route('login') }}" class="btn-secondary w-variant-28eadc15-d435-4480-c473-16eb53816cbc w-inline-block">
                                                <div class="button-sm color-white">Masuk ke Sistem</div>
                                                <div class="btn-icon w-embed">
                                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="white"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-item__visual mobile-hidden">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b0f75cd93fd313dfcc0bd_4.webp" loading="lazy" data-animation="featured-item-illustration" alt="" class="featured-item__illustration"/>
                                </div>
                            </div>

                            <!-- Item 5: Executive Dashboard Super Admin -->
                            <div class="featured-item">
                                <div class="featured-item__text">
                                    <div class="featured-item__head">
                                        <div data-animation="featured-item-head" class="h4">Executive Dashboard &amp; Travel Policy Engine</div>
                                        <div data-animation="featured-item-cost" class="featured-item__cost">
                                            <div class="body-md color-white-60">modul</div>
                                            <div class="body-lg-semibold">Role 05</div>
                                        </div>
                                    </div>
                                    <div class="featured-item__visual mobile-visible">
                                        <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b162748ae928115f5f8ee_5.webp" loading="lazy" alt="" class="featured-item__illustration"/>
                                    </div>
                                    <div class="featured-item__body">
                                        <div class="featured-item__properties">
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Monitoring Serapan Anggaran Korporat &amp; Radar Lokasi</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0cfc7c0ffb4594ddd_200b069e26d5dbf25e7efe28a16ac85b_pin.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Master Plafon Hotel &amp; Per Diem <span class="color-white-60">(Grade 1 - 4)</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d013c40d035e576fc8_calendar.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Manajemen Akun Pegawai &amp; Struktur Hirarki Approval</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0b38d158447cd2f5b_users.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Pencatatan Jejak Audit <span class="color-white-60">(Audit Logs &amp; CSV Export)</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b13a6c05aa0554867732d_stars.svg" loading="lazy" alt="" class="featured-item-property__icon size-l"/>
                                            </div>
                                        </div>
                                        <div data-animation="featured-item-button" class="featured-item__button">
                                            <a data-wf--button-secondary--variant="full-width" href="{{ route('login') }}" class="btn-secondary w-variant-28eadc15-d435-4480-c473-16eb53816cbc w-inline-block">
                                                <div class="button-sm color-white">Masuk ke Sistem</div>
                                                <div class="btn-icon w-embed">
                                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="white"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-item__visual mobile-hidden">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b162748ae928115f5f8ee_5.webp" loading="lazy" data-animation="featured-item-illustration" alt="" class="featured-item__illustration"/>
                                </div>
                            </div>

                            <!-- Item 6: Portal Login Multi-Role -->
                            <div class="featured-item">
                                <div class="featured-item__text">
                                    <div class="featured-item__head">
                                        <div data-animation="featured-item-head" class="h4">Portal Autentikasi &amp; Akses Multi-Role</div>
                                        <div data-animation="featured-item-cost" class="featured-item__cost">
                                            <div class="body-md color-white-60">akses</div>
                                            <div class="body-lg-semibold">SSO</div>
                                        </div>
                                    </div>
                                    <div class="featured-item__visual mobile-visible">
                                        <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b16276a09f35cfb31e223_6.webp" loading="lazy" alt="" class="featured-item__illustration"/>
                                    </div>
                                    <div class="featured-item__body">
                                        <div class="featured-item__properties">
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Pengalihan Otomatis ke Dashboard Sesuai Jabatan</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0cfc7c0ffb4594ddd_200b069e26d5dbf25e7efe28a16ac85b_pin.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Karyawan | Atasan | Travel | Finance <span class="color-white-60">(5 Role)</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d013c40d035e576fc8_calendar.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Dilengkapi Tombol Quick-Fill Akun Demo</div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b12d0b38d158447cd2f5b_users.svg" loading="lazy" alt="" class="featured-item-property__icon opacity-20"/>
                                            </div>
                                            <div data-animation="featured-item-property" class="featured-item-property">
                                                <div class="featured-item-property__title">
                                                    <div class="title-xs">Keamanan Sesi Terproteksi <span class="color-white-60">&amp; Role Switcher</span></div>
                                                </div>
                                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b13a6c05aa0554867732d_stars.svg" loading="lazy" alt="" class="featured-item-property__icon size-l"/>
                                            </div>
                                        </div>
                                        <div data-animation="featured-item-button" class="featured-item__button">
                                            <a data-wf--button-secondary--variant="full-width" href="{{ route('login') }}" class="btn-secondary w-variant-28eadc15-d435-4480-c473-16eb53816cbc w-inline-block">
                                                <div class="button-sm color-white">Buka Halaman Login</div>
                                                <div class="btn-icon w-embed">
                                                    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 0C8 0 7.32057 2.41553 7.32057 4C7.32057 5.58447 8 8 8 8C8 8 5.58447 7.32057 4 7.32057C2.41553 7.32057 0 8 0 8C0 8 0.679427 5.58447 0.679427 4C0.679427 2.41553 0 0 0 0C0 0 2.41553 0.679426 4 0.679426C5.58447 0.679426 8 0 8 0Z" fill="white"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="featured-item__visual mobile-hidden">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b16276a09f35cfb31e223_6.webp" loading="lazy" data-animation="featured-item-illustration" alt="" class="featured-item__illustration"/>
                                </div>
                            </div>

                            <div class="featured__dec featured__dec--1"></div>
                            <div class="featured__dec featured__dec--2"></div>
                            <div class="featured__dec featured__dec--3"></div>
                            <div class="featured__dec featured__dec--4"></div>
                            <div class="featured__dec featured__dec--5"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section 5: Combine Section (Workflow Steps 01 - 04) -->
            <section class="combine-section">
                <div class="combine">
                    <div class="container">
                        <div class="head margin-bottom-40 mobile-margin-bottom-24">
                            <div class="row align-end">
                                <div class="column column-12">
                                    <div class="head__description">
                                        <div data-animation="combine-headline" class="h2 mobile-h3">Integrasi SPPD</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="combine__items">
                            <div class="combine__item">
                                <div data-animation="combine-title-item-1" class="h3 mobile-h4"><span class="color-white-40">+</span>Approval</div>
                            </div>
                            <div class="combine__item">
                                <div data-animation="combine-title-item-2" class="h3 mobile-h4"><span class="color-white-40">+</span>Tiket PNR</div>
                            </div>
                            <div class="combine__item">
                                <div data-animation="combine-title-item-3" class="h3 mobile-h4"><span class="color-white-40">+</span>Settlement</div>
                            </div>
                        </div>
                    </div>
                    <div class="combine__steps">
                        <div id="w-node-_0fd1fee5-61de-d397-8ba0-18cea3a58873-a5f18ca8" class="combine-step sizel-l">
                            <div data-animation="combine-description" class="body-xl">Seluruh tahapan perjalanan dinas terhubung <br/>otomatis lintas dashboard. Tanpa berkas fisik, <br/>dengan validasi plafon instan dan pelacakan <br/>status real-time.</div>
                        </div>
                        <div data-animation="combine-step-1" id="w-node-_069708ba-15da-f97a-0c87-ca2ec9682d77-a5f18ca8" class="combine-step">
                            <div class="combine-step__head">
                                <div class="h3 mobile-font-size-36">01</div>
                                <div class="combine-step__subtitle"><div class="title-xs color-white-50">Step</div></div>
                            </div>
                            <div class="combine-step__body">
                                <div class="body-lg mobile-body-md">Ajukan SPPD &amp; <br/>Cek Plafon</div>
                            </div>
                            <div class="combine-step__dec combine-step__dec--1"></div>
                            <div class="combine-step__dec combine-step__dec--5"></div>
                        </div>
                        <div data-animation="combine-step-2" id="w-node-_542f5ae5-7f95-7107-681a-6ad6bf18a198-a5f18ca8" class="combine-step">
                            <div class="combine-step__head">
                                <div class="h3 mobile-font-size-36">02</div>
                                <div class="combine-step__subtitle"><div class="title-xs color-white-50">Step</div></div>
                            </div>
                            <div class="combine-step__body">
                                <div class="body-lg mobile-body-md">Otorisasi <br/>Atasan</div>
                            </div>
                            <div class="combine-step__dec combine-step__dec--2"></div>
                        </div>
                        <div data-animation="combine-step-3" id="w-node-_290ee084-ace8-d734-505b-e738ddd5143c-a5f18ca8" class="combine-step">
                            <div class="combine-step__head">
                                <div class="h3 mobile-font-size-36">03</div>
                                <div class="combine-step__subtitle"><div class="title-xs color-white-50">Step</div></div>
                            </div>
                            <div class="combine-step__body">
                                <div class="body-lg mobile-body-md">Terbit Tiket &amp; <br/>Cair Kasbon</div>
                            </div>
                            <div class="combine-step__dec combine-step__dec--3"></div>
                            <div class="combine-step__dec combine-step__dec--6"></div>
                        </div>
                        <div data-animation="combine-step-4" id="w-node-d39ba3e3-aab0-1a5f-b2eb-5058ac200fc0-a5f18ca8" class="combine-step">
                            <div class="combine-step__head">
                                <div class="h3 mobile-font-size-36">04</div>
                                <div class="combine-step__subtitle"><div class="title-xs color-white-50">Step</div></div>
                            </div>
                            <div class="combine-step__body">
                                <div class="body-lg mobile-body-md">Audit Nota &amp; <br/>Settlement</div>
                            </div>
                            <div class="combine-step__dec combine-step__dec--4"></div>
                        </div>
                        <div class="combine__dec combine__dec--1"></div>
                        <div class="combine__dec combine__dec--2"></div>
                    </div>
                </div>
            </section>

            <!-- Section 6: Destination Section (Radar Check-in & Glowing SVG Dots) -->
            <section class="destination-section">
                <div class="destination">
                    <div class="container">
                        <div class="head">
                            <div class="row mobile-column">
                                <div class="column column-3">
                                    <div data-animation="destination-head-title" class="head__title mobile-margin-bottom-24">
                                        <img src="{{ asset('logo_perusahaan.png') }}" loading="lazy" alt="Logo PT Jaya Abadi" class="logo-mini" style="object-fit: contain;"/>
                                        <div class="body-md">Radar Lokasi</div>
                                    </div>
                                </div>
                                <div class="column column-9">
                                    <div class="head__description">
                                        <div data-animation="destination-h2" class="h2 mobile-font-size-36">Pemantauan Destinasi Dinas </div>
                                        <div data-animation="destination-description" class="body-xl mobile-lg mobile-no-br">Pantau pergerakan tim secara langsung! <br/>Dashboard menampilkan titik check-in karyawan di berbagai kota <br/>cabang, status penerbangan aktif, serta realisasi anggaran <br/>per wilayah operasional.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="destination-mobile">
                            <div class="destination-mobile-item">
                                <div class="destination-mobile-item__head">
                                    <div class="body-lg">Jawa &amp; Bali</div>
                                    <div class="body-sm color-white-50">/ Operasional Inti</div>
                                </div>
                                <div class="destination-mobile-item__visual">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/698b68bbc6de4b51a55a64b3_destination-1.webp" loading="lazy" alt="" class="destination-mobile-item__illustration"/>
                                </div>
                            </div>
                            <div class="destination-mobile-item">
                                <div class="destination-mobile-item__head">
                                    <div class="body-lg">Sumatera &amp; Kalimantan</div>
                                    <div class="body-sm color-white-50">/ Cabang Proyek</div>
                                </div>
                                <div class="destination-mobile-item__visual">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/698b68bb48fceacc9f67c522_destination-2.webp" loading="lazy" alt="" class="destination-mobile-item__illustration"/>
                                </div>
                            </div>
                            <div class="destination-mobile-item">
                                <div class="destination-mobile-item__head">
                                    <div class="body-lg">Regional Asia</div>
                                    <div class="body-sm color-white-50">/ Kunjungan Mitra</div>
                                </div>
                                <div class="destination-mobile-item__visual">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/698b68bb7277bdbc67c88cd3_destination-3.webp" loading="lazy" alt="" class="destination-mobile-item__illustration"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="destination__code w-embed">
                        <svg class="destination__dots" width="1312" height="287" viewBox="0 0 1312 287" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.15" filter="url(#filter0_f_6030_14160)"><circle cx="787" cy="92.3335" r="14" fill="url(#paint0_radial_6030_14160)"/></g>
                            <circle cx="787" cy="92.3335" r="2" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter1_f_6030_14160)"><circle cx="682" cy="87.3335" r="28" fill="url(#paint1_radial_6030_14160)"/></g>
                            <circle cx="682" cy="87.3335" r="4" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter2_f_6030_14160)"><circle cx="650" cy="143.333" r="14" fill="url(#paint2_radial_6030_14160)"/></g>
                            <circle cx="650" cy="143.333" r="2" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter3_f_6030_14160)"><circle cx="590" cy="125.333" r="14" fill="url(#paint3_radial_6030_14160)"/></g>
                            <circle cx="590" cy="125.333" r="2" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter4_f_6030_14160)"><circle cx="559" cy="51.3335" r="28" fill="url(#paint4_radial_6030_14160)"/></g>
                            <circle cx="559" cy="51.3335" r="4" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter5_f_6030_14160)"><circle cx="708" cy="149.333" r="28" fill="url(#paint5_radial_6030_14160)"/></g>
                            <circle cx="708" cy="149.333" r="4" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter6_f_6030_14160)"><circle cx="609" cy="65.3335" r="14" fill="url(#paint6_radial_6030_14160)"/></g>
                            <circle cx="609" cy="65.3335" r="2" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter7_f_6030_14160)"><circle cx="744" cy="131.333" r="14" fill="url(#paint7_radial_6030_14160)"/></g>
                            <circle cx="744" cy="131.333" r="2" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter8_f_6030_14160)"><circle cx="755" cy="171.333" r="14" fill="url(#paint8_radial_6030_14160)"/></g>
                            <circle cx="755" cy="171.333" r="2" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter9_f_6030_14160)"><circle cx="734" cy="199.333" r="14" fill="url(#paint9_radial_6030_14160)"/></g>
                            <circle cx="734" cy="199.333" r="2" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter10_f_6030_14160)"><circle cx="39.9998" cy="41.3333" r="37.3333" fill="url(#paint10_radial_6030_14160)"/></g>
                            <circle cx="39.9998" cy="41.3333" r="5.33333" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter11_f_6030_14160)"><circle cx="542" cy="196.333" r="28" fill="url(#paint11_radial_6030_14160)"/></g>
                            <circle cx="542" cy="196.333" r="4" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter12_f_6030_14160)"><circle cx="530" cy="268.333" r="14" fill="url(#paint12_radial_6030_14160)"/></g>
                            <circle cx="530" cy="268.333" r="2" fill="#FBA13A"/>
                            <g opacity="0.15" filter="url(#filter13_f_6030_14160)"><circle cx="1280" cy="210.333" r="28" fill="url(#paint13_radial_6030_14160)"/></g>
                            <circle cx="1280" cy="210.333" r="4" fill="#FBA13A"/>
                            <defs>
                                <filter id="filter0_f_6030_14160" x="769" y="74.3335" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter1_f_6030_14160" x="650" y="55.3335" width="64" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter2_f_6030_14160" x="632" y="125.333" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter3_f_6030_14160" x="572" y="107.333" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter4_f_6030_14160" x="527" y="19.3335" width="64" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter5_f_6030_14160" x="676" y="117.333" width="64" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter6_f_6030_14160" x="591" y="47.3335" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter7_f_6030_14160" x="726" y="113.333" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter8_f_6030_14160" x="737" y="153.333" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter9_f_6030_14160" x="716" y="181.333" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter10_f_6030_14160" x="-1.3335" y="0" width="82.6665" height="82.6665" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter11_f_6030_14160" x="510" y="164.333" width="64" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter12_f_6030_14160" x="512" y="250.333" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <filter id="filter13_f_6030_14160" x="1248" y="178.333" width="64" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/><feGaussianBlur stdDeviation="2" result="effect1_foregroundBlur_6030_14160"/></filter>
                                <radialGradient id="paint0_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(787 92.3335) rotate(90) scale(14)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint1_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(682 87.3335) rotate(90) scale(28)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint2_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(650 143.333) rotate(90) scale(14)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint3_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(590 125.333) rotate(90) scale(14)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint4_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(559 51.3335) rotate(90) scale(28)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint5_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(708 149.333) rotate(90) scale(28)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint6_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(609 65.3335) rotate(90) scale(14)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint7_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(744 131.333) rotate(90) scale(14)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint8_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(755 171.333) rotate(90) scale(14)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint9_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(734 199.333) rotate(90) scale(14)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint10_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(39.9998 41.3333) rotate(90) scale(37.3333)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint11_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(542 196.333) rotate(90) scale(28)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint12_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(530 268.333) rotate(90) scale(14)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                                <radialGradient id="paint13_radial_6030_14160" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(1280 210.333) rotate(90) scale(28)"><stop stop-color="#FBA13A"/><stop offset="1" stop-color="#071418"/></radialGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
            </section>

            <!-- Section 7: How Works Section (01 - 04) -->
            <section class="how-works-section padding-global">
                <div class="container">
                    <div class="head">
                        <div class="row align-end mobile-column">
                            <div class="column column-6">
                                <div class="head__description mobile-margin-bottom-16">
                                    <div data-animation="how-works-headline" class="h2 mobile-h3">Cara Kerja Dashboard</div>
                                </div>
                            </div>
                            <div class="column column-6">
                                <div class="featured-section__head">
                                    <div data-animation="how-works-description" class="body-md color-white-60">Alur terstandarisasi dari pengajuan karyawan <br/>hingga penutupan buku oleh tim keuangan.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="how-works">
                        <div data-animation="how-works-item-1" class="how-works-item">
                            <div data-animation="how-works-item-head-1" class="how-works-item__head">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b4ca99831f5d3ba3e38ac_icon-1.svg" loading="lazy" alt="" class="how-works-item__icon"/>
                                <div class="how-works-item__count">01</div>
                            </div>
                            <div class="how-works-item__body">
                                <div data-animation="how-works-item-title-1" class="body-md"><span class="mobile-fw">Isi agenda </span>&amp; tujuan</div>
                                <div data-animation="how-works-item-description-1" class="body-md color-white-50 mobile-no-br">Sistem memvalidasi plafon hotel dan <br/>uang harian sesuai grade jabatan.</div>
                            </div>
                        </div>
                        <div data-animation="how-works-item-2" class="how-works-item">
                            <div data-animation="how-works-item-head-2" class="how-works-item__head">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b4caacaa12fec64081c6c_icon-2.svg" loading="lazy" alt="" class="how-works-item__icon"/>
                                <div class="how-works-item__count">02</div>
                            </div>
                            <div class="how-works-item__body">
                                <div data-animation="how-works-item-title-2" class="body-md"><span class="mobile-fw">Persetujuan</span> berjenjang</div>
                                <div data-animation="how-works-item-description-2" class="body-md color-white-50 mobile-no-br">Atasan memeriksa kepatuhan plafon <br/>dan memberikan otorisasi instan.</div>
                            </div>
                        </div>
                        <div data-animation="how-works-item-3" class="how-works-item">
                            <div data-animation="how-works-item-head-3" class="how-works-item__head">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b4caae3cc55404d552d02_icon-3.svg" loading="lazy" alt="" class="how-works-item__icon"/>
                                <div class="how-works-item__count">03</div>
                            </div>
                            <div class="how-works-item__body">
                                <div data-animation="how-works-item-title-3" class="body-md"><span class="mobile-fw">Penerbitan PNR</span> &amp; kasbon</div>
                                <div data-animation="how-works-item-description-3" class="body-md color-white-50 mobile-no-br">Travel Desk menerbitkan tiket dan <br/>Finance mencairkan uang muka.</div>
                            </div>
                        </div>
                        <div data-animation="how-works-item-4" class="how-works-item">
                            <div data-animation="how-works-item-head-4" class="how-works-item__head">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b4caa7fe5ce94a391888e_icon-4.svg" loading="lazy" alt="" class="how-works-item__icon"/>
                                <div class="how-works-item__count">04</div>
                            </div>
                            <div class="how-works-item__body">
                                <div data-animation="how-works-item-title-4" class="body-md"><span class="mobile-fw">Check-in &amp;</span> settlement</div>
                                <div data-animation="how-works-item-description-4" class="body-md color-white-50 mobile-no-br">Unggah struk pengeluaran riil untuk <br/>rekonsiliasi akhir di dashboard.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section 8: Practitioners Section (Interactive Hover Cards for Role Actors) -->
            <section class="practitioners-section padding-global">
                <div class="practitioners">
                    <div class="practitioners__list mobile-hidden">
                        <div class="coaches-person">
                            <div class="coaches-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6cc589808c226f0cd7_ea8e8b2e1274331d29db4f187ea3aebb_1.webp" loading="lazy" alt="" class="coaches-person__photo"/>
                                <div class="coaches-person__head">
                                    <div class="body-lg">Ahmad Pegawai</div>
                                    <div class="body-sm">Karyawan (Pemohon)</div>
                                </div>
                            </div>
                            <div class="coaches-person-info">
                                <div class="coaches-person-info__location"><div class="body-sm">Role 01</div></div>
                                <div class="coaches-person-info__body">
                                    <div class="coaches-person-info__head">
                                        <div class="coaches-person-info__headline">
                                            <div class="body-lg">Ahmad Pegawai</div>
                                            <div class="body-sm">Karyawan (Pemohon)</div>
                                        </div>
                                        <div class="body-sm color-white-60">Menggunakan Dashboard Karyawan untuk membuat pengajuan SPPD, mengecek estimasi plafon hotel dan uang saku, mengunduh dokumen surat tugas &amp; e-ticket, melakukan check-in lokasi, serta melaporkan nota settlement.</div>
                                    </div>
                                    <div class="coaches-person-info__footer">
                                        <div class="coaches-person-info__items">
                                            <div class="coaches-person-info__item">
                                                <div class="body-sm">Akun Demo:</div>
                                                <div class="coaches-person-info__item-icon earth"><div class="body-sm">user</div></div>
                                            </div>
                                            <div class="coaches-person-info__item">
                                                <div class="body-sm">Grade:</div>
                                                <div class="coaches-person-info__item-icon yoga"><div class="body-sm">G2</div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="coaches-person">
                            <div class="coaches-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6ccb670b10285a47bf_12.webp" loading="lazy" alt="" class="coaches-person__photo"/>
                                <div class="coaches-person__head">
                                    <div class="body-lg">Budi Santoso</div>
                                    <div class="body-sm">Atasan (Approver)</div>
                                </div>
                            </div>
                            <div class="coaches-person-info">
                                <div class="coaches-person-info__location"><div class="body-sm">Role 02</div></div>
                                <div class="coaches-person-info__body">
                                    <div class="coaches-person-info__head">
                                        <div class="coaches-person-info__headline">
                                            <div class="body-lg">Budi Santoso</div>
                                            <div class="body-sm">Atasan (Approver)</div>
                                        </div>
                                        <div class="body-sm color-white-60">Meninjau urgensi pengajuan perjalanan dinas anggota tim, memeriksa indikator kepatuhan plafon, memberikan keputusan persetujuan/revisi/penolakan, serta mengatur delegasi wewenang saat cuti.</div>
                                    </div>
                                    <div class="coaches-person-info__footer">
                                        <div class="coaches-person-info__items">
                                            <div class="coaches-person-info__item">
                                                <div class="body-sm">Akun Demo:</div>
                                                <div class="coaches-person-info__item-icon earth"><div class="body-sm">atasan</div></div>
                                            </div>
                                            <div class="coaches-person-info__item">
                                                <div class="body-sm">Grade:</div>
                                                <div class="coaches-person-info__item-icon yoga"><div class="body-sm">G3</div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="coaches-person">
                            <div class="coaches-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6c6400b1ebc3956333_43c66f9116f860d81fe61e822e465e88_10.webp" loading="lazy" alt="" class="coaches-person__photo"/>
                                <div class="coaches-person__head">
                                    <div class="body-lg">Siti Rahma</div>
                                    <div class="body-sm">Admin Travel Desk</div>
                                </div>
                            </div>
                            <div class="coaches-person-info">
                                <div class="coaches-person-info__location"><div class="body-sm">Role 03</div></div>
                                <div class="coaches-person-info__body">
                                    <div class="coaches-person-info__head">
                                        <div class="coaches-person-info__headline">
                                            <div class="body-lg">Siti Rahma</div>
                                            <div class="body-sm">Admin Travel Desk</div>
                                        </div>
                                        <div class="body-sm color-white-60">Memproses pemesanan transportasi dan akomodasi untuk seluruh SPPD yang telah disetujui, menginput kode booking PNR maskapai/kereta, voucher hotel, serta mengelola direktori mitra vendor.</div>
                                    </div>
                                    <div class="coaches-person-info__footer">
                                        <div class="coaches-person-info__items">
                                            <div class="coaches-person-info__item">
                                                <div class="body-sm">Akun Demo:</div>
                                                <div class="coaches-person-info__item-icon earth"><div class="body-sm">travel</div></div>
                                            </div>
                                            <div class="coaches-person-info__item">
                                                <div class="body-sm">Divisi:</div>
                                                <div class="coaches-person-info__item-icon yoga"><div class="body-sm">GA</div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="coaches-person">
                            <div class="coaches-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6cb4387b1312d7ae14_9.webp" loading="lazy" alt="" class="coaches-person__photo"/>
                                <div class="coaches-person__head">
                                    <div class="body-lg">Hendra Wijaya</div>
                                    <div class="body-sm">Finance &amp; Super Admin</div>
                                </div>
                            </div>
                            <div class="coaches-person-info">
                                <div class="coaches-person-info__location"><div class="body-sm">Role 04 &amp; 05</div></div>
                                <div class="coaches-person-info__body">
                                    <div class="coaches-person-info__head">
                                        <div class="coaches-person-info__headline">
                                            <div class="body-lg">Hendra Wijaya</div>
                                            <div class="body-sm">Finance &amp; Governance</div>
                                        </div>
                                        <div class="body-sm color-white-60">Mencairkan uang muka perjalanan (Cash Advance), mengaudit bukti pengeluaran riil pada laporan settlement untuk menghitung Refund/Reimburse, serta memantau seluruh jejak audit dan plafon korporat.</div>
                                    </div>
                                    <div class="coaches-person-info__footer">
                                        <div class="coaches-person-info__items">
                                            <div class="coaches-person-info__item">
                                                <div class="body-sm">Akun Demo:</div>
                                                <div class="coaches-person-info__item-icon earth"><div class="body-sm">finance</div></div>
                                            </div>
                                            <div class="coaches-person-info__item">
                                                <div class="body-sm">Admin:</div>
                                                <div class="coaches-person-info__item-icon yoga"><div class="body-sm">admin</div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="practitioners-person is-hidden">
                            <div data-animation="practitioners-illustration-1" class="practitioners-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6cc589808c226f0cd7_ea8e8b2e1274331d29db4f187ea3aebb_1.webp" loading="lazy" alt="" class="practitioners-person__photo"/>
                                <div class="practitioners-person__text">
                                    <div data-animation="practitioners-person-title-1" class="body-lg">Ahmad Pegawai</div>
                                    <div data-animation="practitioners-person-description-1" class="body-sm">Karyawan (Pemohon)</div>
                                </div>
                            </div>
                        </div>
                        <div class="practitioners-person is-hidden">
                            <div data-animation="practitioners-illustration-2" class="practitioners-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6ccb670b10285a47bf_12.webp" loading="lazy" alt="" class="practitioners-person__photo"/>
                                <div class="practitioners-person__text">
                                    <div data-animation="practitioners-person-title-2" class="body-lg">Budi Santoso</div>
                                    <div data-animation="practitioners-person-description-2" class="body-sm">Atasan (Approver)</div>
                                </div>
                            </div>
                        </div>
                        <div class="practitioners-person is-hidden">
                            <div data-animation="practitioners-illustration-3" class="practitioners-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6c6400b1ebc3956333_43c66f9116f860d81fe61e822e465e88_10.webp" loading="lazy" alt="" class="practitioners-person__photo"/>
                                <div class="practitioners-person__text">
                                    <div data-animation="practitioners-person-title-3" class="body-lg">Siti Rahma</div>
                                    <div data-animation="practitioners-person-description-3" class="body-sm">Admin Travel Desk</div>
                                </div>
                            </div>
                        </div>
                        <div class="practitioners-person is-hidden">
                            <div data-animation="practitioners-illustration-4" class="practitioners-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6cb4387b1312d7ae14_9.webp" loading="lazy" alt="" class="practitioners-person__photo"/>
                                <div class="practitioners-person__text">
                                    <div data-animation="practitioners-person-title-4" class="body-lg">Hendra Wijaya</div>
                                    <div data-animation="practitioners-person-description-4" class="body-sm">Finance &amp; Super Admin</div>
                                </div>
                            </div>
                        </div>
                        <div class="practitioners__dec practitioners__dec--4"></div>
                        <div class="practitioners__dec practitioners__dec--5"></div>
                        <div class="practitioners__dec practitioners__dec--6 is-hidden"></div>
                    </div>

                    <div class="practitioners__list mobile-visible">
                        <div class="practitioners-person">
                            <div data-animation="practitioners-illustration-1" class="practitioners-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6cc589808c226f0cd7_ea8e8b2e1274331d29db4f187ea3aebb_1.webp" loading="lazy" alt="" class="practitioners-person__photo"/>
                                <div class="practitioners-person__text">
                                    <div data-animation="practitioners-person-title-1" class="body-lg">Ahmad Pegawai</div>
                                    <div data-animation="practitioners-person-description-1" class="body-sm">Karyawan (Pemohon)</div>
                                </div>
                            </div>
                        </div>
                        <div class="practitioners-person">
                            <div data-animation="practitioners-illustration-2" class="practitioners-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6ccb670b10285a47bf_12.webp" loading="lazy" alt="" class="practitioners-person__photo"/>
                                <div class="practitioners-person__text">
                                    <div data-animation="practitioners-person-title-2" class="body-lg">Budi Santoso</div>
                                    <div data-animation="practitioners-person-description-2" class="body-sm">Atasan (Approver)</div>
                                </div>
                            </div>
                        </div>
                        <div class="practitioners-person">
                            <div data-animation="practitioners-illustration-3" class="practitioners-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6c6400b1ebc3956333_43c66f9116f860d81fe61e822e465e88_10.webp" loading="lazy" alt="" class="practitioners-person__photo"/>
                                <div class="practitioners-person__text">
                                    <div data-animation="practitioners-person-title-3" class="body-lg">Siti Rahma</div>
                                    <div data-animation="practitioners-person-description-3" class="body-sm">Admin Travel Desk</div>
                                </div>
                            </div>
                        </div>
                        <div class="practitioners-person">
                            <div data-animation="practitioners-illustration-4" class="practitioners-person__visual">
                                <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/69897f6cb4387b1312d7ae14_9.webp" loading="lazy" alt="" class="practitioners-person__photo"/>
                                <div class="practitioners-person__text">
                                    <div data-animation="practitioners-person-title-4" class="body-lg">Hendra Wijaya</div>
                                    <div data-animation="practitioners-person-description-4" class="body-sm">Finance &amp; Super Admin</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="practitioners__text">
                        <div class="practitioners__row">
                            <div class="head head--column">
                                <div data-animation="practitioners-title" class="head__title">
                                    <img src="{{ asset('logo_perusahaan.png') }}" loading="lazy" alt="Logo PT Jaya Abadi" class="logo-mini" style="object-fit: contain;"/>
                                    <div class="body-md">Otorisasi &amp; Hak Akses</div>
                                </div>
                                <div class="head__description">
                                    <div data-animation="practitioners-headline" class="h2 mobile-font-size-36">5 Peran Utama <br/>di Balik CTMS</div>
                                </div>
                            </div>
                        </div>
                        <div class="practitioners__row padding-top-0">
                            <div class="practitioners__items">
                                <div class="practitioners-item">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b60b6b733ce8488627354_plus.svg" loading="lazy" data-animation="practitioners-plus-1" alt="" class="practitioners-item__icon"/>
                                    <div class="practitioners-item__content">
                                        <div data-animation="practitioners-item-title-1" class="body-lg">Pemisahan Wewenang yang Tegas</div>
                                        <div data-animation="practitioners-item-description-1" class="body-md color-white-60">Setiap peran hanya melihat antrean tugas <br/>dan metrik yang relevan dengan tanggung <br/>jawab divisinya masing-masing.</div>
                                    </div>
                                </div>
                                <div class="practitioners-item">
                                    <img src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b60b6b733ce8488627354_plus.svg" loading="lazy" data-animation="practitioners-plus-2" alt="" class="practitioners-item__icon"/>
                                    <div class="practitioners-item__content">
                                        <div data-animation="practitioners-item-description-2" class="body-xl mobile-font-size-22">Di PT Jaya Abadi kami menyatukan <br/>seluruh alur kerja dari pemohon, <br/>approver, travel desk, finance, <br/>hingga super admin.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="practitioners__dec practitioners__dec--1"></div>
                    <div class="practitioners__dec practitioners__dec--2"></div>
                    <div class="practitioners__dec practitioners__dec--3"></div>
                </div>
            </section>

            <!-- Footer (Exact Vita Travel Structure) -->
            <div data-wf--footer--variant="base" class="footer">
                <div class="container">
                    <div class="footer__in">
                        <div class="footer__visual">
                            <img loading="eager" src="https://cdn.prod.website-files.com/696eeb61714a6c90a5f18c9e/697b6310adee6f369b84c520_illustration.webp" alt="" class="footer__illustration"/>
                            <div class="footer__layer"></div>
                        </div>
                        <div class="footer-top">
                            <div class="row mobile-column mobile-gap-56">
                                <div class="column column-4">
                                    <a href="{{ url('/') }}" aria-current="page" class="footer-logo w-inline-block w--current" style="display: flex; align-items: center; gap: 0.75rem;">
                                        <img src="{{ asset('logo_perusahaan.png') }}" alt="Logo PT Jaya Abadi" class="footer-logo__icon" style="width: 38px; height: 38px; object-fit: contain;">
                                        <div class="footer-logo__title">Jaya Abadi</div>
                                    </a>
                                </div>
                                <div class="column column-8">
                                    <div class="row mobile-column mobile-gap-56">
                                        <div class="column column-6">
                                            <div class="footer-top__links">
                                                <div class="footer-top__link">
                                                    <a href="#retreats" class="h3 color-white"><span class="color-white-40">+</span>5 Role</a>
                                                </div>
                                                <div class="footer-top__link">
                                                    <a href="{{ route('login') }}" class="h3 color-white"><span class="color-white-40">+</span>Login</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column column-6">
                                            <div class="footer-top__contacts">
                                                <div class="footer-top__contact">
                                                    <a href="{{ route('login') }}" class="body-lg color-white">Portal CTMS PT Jaya Abadi</a>
                                                </div>
                                                <div class="footer-top__contact">
                                                    <a href="mailto:travel-desk@jayaabadi.co.id" class="body-lg color-white">travel-desk@jayaabadi.co.id</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="footer-bottom__in">
                        <div class="footer__l">
                            <div class="footer__copy">
                                <div class="button-sm color-white-60">&copy;All Rights Reserved. PT Jaya Abadi CTMS, {{ date('Y') }}</div>
                                <div class="footer__copy-dec"></div>
                            </div>
                            <a href="{{ route('login') }}" class="footer-made-by mobile-hidden w-inline-block">
                                <div class="button-sm color-white-60">Enterprise</div>
                                <div class="footer-made-by__visual"><div class="button-sm color-white-60">Travel Management System</div></div>
                            </a>
                        </div>
                        <div class="footer-bottom__links">
                            <div class="footer-bottom__link"><a href="#retreats" class="button-sm color-white-60">5 Role Workspace</a></div>
                            <div class="footer-bottom__link"><a href="{{ route('login') }}" class="button-sm color-white-60">Portal Login</a></div>
                        </div>
                        <div class="footer-made-by mobile-visible">
                            <div class="button-sm color-white-60">Enterprise</div>
                            <div class="footer-made-by__visual"><div class="button-sm color-white-60">Travel Management System</div></div>
                        </div>
                    </div>
                    <div class="footer-bottom__dec"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts (GSAP + ScrollSmoother + SplitText Stack, without Webflow Badge Script) -->
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/SplitText.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollSmoother.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollToPlugin.min.js"></script>
    <script src="{{ asset('vita/libs.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vita/app.min.js') }}" type="text/javascript"></script>

    <style>
        .w-webflow-badge {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
        .footer__copy .button-sm {
            line-height: 125%;
        }
        @media screen and (max-width: 479px) {
            .h4 {
                line-height: 125%;
            }
        }
    </style>
</body>
</html>
