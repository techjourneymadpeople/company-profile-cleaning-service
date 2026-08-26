<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Admin Cleaning Service - {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'PT Bersih Sebagian Dari Iman' }}</title>

    <!-- Google Fonts: Montserrat & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Montserrat', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-[#0d1b2a] text-slate-100 antialiased selection:bg-[#24695c] selection:text-white flex flex-col justify-between">

    <!-- Accessibility Skip Link (WCAG 2.1 AA) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-[#24695c] focus:text-white focus:font-bold focus:rounded-xl focus:shadow-xl focus:outline-none">
        Lewati ke Konten Utama
    </a>

    <!-- Top Navigation Bar -->
    <header class="w-full border-b border-slate-800/80 bg-slate-950/70 backdrop-blur-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand -->
            <a href="{{ url('/') }}" class="flex items-center gap-3.5 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] rounded-xl p-1" aria-label="Beranda Portal Admin">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-[#24695c] to-[#3a9686] flex items-center justify-center text-white shadow-lg shadow-[#24695c]/30 group-hover:scale-105 transition-transform duration-200">
                    <x-heroicon-o-sparkles class="w-6 h-6" aria-hidden="true" />
                </div>
                <div>
                    <span class="block text-lg font-black tracking-tight text-white group-hover:text-[#3a9686] transition-colors font-heading">
                        {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'PT Bersih Sebagian Dari Iman' }}
                    </span>
                    <span class="block text-[11px] font-bold text-teal-400 tracking-wider uppercase">
                        Sistem Informasi & Manajemen Operasional
                    </span>
                </div>
            </a>

            <!-- Navigation Auth Buttons -->
            <nav aria-label="Navigasi Autentikasi" class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 border border-[#3a9686]/30 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                        <span>Masuk</span>
                    </a>
                @else
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex flex-col text-right">
                            <span class="text-xs font-bold text-white font-heading">{{ Auth::user()->name }}</span>
                            <span class="text-[11px] font-semibold text-teal-400">
                                {{ Auth::user()->roles->pluck('name')->first() ?? 'Pengguna' }}
                            </span>
                        </div>
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/30 border border-[#3a9686]/30 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading">
                            <x-heroicon-o-squares-2x2 class="w-5 h-5" aria-hidden="true" />
                            <span>Buka Dashboard</span>
                        </a>
                    </div>
                @endguest
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content" class="flex-1">
        <!-- Hero Section -->
        <section aria-labelledby="hero-title" class="relative py-20 lg:py-28 overflow-hidden">
            <!-- Background Glow Elements -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#24695c]/20 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <!-- Badge Notification -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#24695c]/30 border border-[#3a9686]/40 text-teal-200 text-xs font-bold uppercase tracking-wider mb-6 shadow-sm font-heading">
                    <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse" aria-hidden="true"></span>
                    Portal Administrasi & Kontrol Terpusat
                </div>

                <!-- Headline -->
                <h1 id="hero-title" class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white max-w-4xl mx-auto leading-tight sm:leading-none font-heading">
                    Admin Panel Resmi <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 via-emerald-400 to-cyan-300">
                        Perusahaan Cleaning Service
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="mt-6 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                    Platform kendali operasional, manajemen pengguna dengan Role-Based Access Control, pengelolaan konten, dynamic system settings, dan optimasi SEO terintegrasi.
                </p>

                <!-- CTA Action Area based on Auth State -->
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2.5 px-8 py-4 rounded-2xl text-base font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-xl shadow-[#24695c]/30 hover:scale-[1.02] active:scale-[0.98] transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" aria-hidden="true" />
                            <span>Masuk ke Admin Panel</span>
                        </a>
                    @else
                        <div class="bg-slate-950/80 border border-slate-800 rounded-3xl p-6 max-w-md w-full shadow-2xl backdrop-blur-md">
                            <div class="flex items-center gap-4 text-left">
                                <div class="w-14 h-14 rounded-2xl bg-[#24695c]/30 border border-[#3a9686]/40 flex items-center justify-center text-teal-300 font-extrabold text-2xl shrink-0 font-heading">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-semibold text-teal-400 uppercase tracking-wider">Sedang Masuk Sebagai:</div>
                                    <div class="text-lg font-bold text-white truncate font-heading">{{ Auth::user()->name }}</div>
                                    <div class="inline-flex items-center px-2.5 py-0.5 mt-1 rounded-full text-xs font-bold bg-[#e2f4f1] text-[#24695c]">
                                        {{ Auth::user()->roles->pluck('name')->first() ?? 'Pengguna' }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex gap-3">
                                <a href="{{ url('/dashboard') }}" class="flex-1 inline-flex justify-center items-center gap-2 py-3.5 px-4 rounded-2xl text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/30 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading">
                                    <x-heroicon-o-squares-2x2 class="w-5 h-5" aria-hidden="true" />
                                    <span>Buka Dashboard</span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                                    @csrf
                                    <button type="submit" class="py-3.5 px-4 rounded-2xl text-sm font-bold text-rose-300 hover:text-white bg-rose-950/40 hover:bg-rose-900/60 border border-rose-800/60 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" aria-label="Keluar dari akun">
                                        <x-heroicon-o-power class="w-5 h-5" aria-hidden="true" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Features Grid -->
                <div class="mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left">
                    <div class="p-6 rounded-3xl bg-slate-950/60 border border-slate-800/80 backdrop-blur-sm hover:border-[#3a9686]/60 transition-colors">
                        <div class="w-12 h-12 rounded-2xl bg-[#24695c]/20 border border-[#3a9686]/30 text-teal-300 flex items-center justify-center mb-4">
                            <x-heroicon-o-shield-check class="w-6 h-6" aria-hidden="true" />
                        </div>
                        <h2 class="text-base font-bold text-white font-heading">Role & Permission Matrix</h2>
                        <p class="mt-2 text-xs text-slate-400 leading-relaxed">
                            Hierarki hak akses berjenjang untuk Super Admin, Owner, dan Admin Content.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-950/60 border border-slate-800/80 backdrop-blur-sm hover:border-[#3a9686]/60 transition-colors">
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/20 border border-teal-500/30 text-teal-300 flex items-center justify-center mb-4">
                            <x-heroicon-o-cog-6-tooth class="w-6 h-6" aria-hidden="true" />
                        </div>
                        <h2 class="text-base font-bold text-white font-heading">Dynamic Spatie Settings</h2>
                        <p class="mt-2 text-xs text-slate-400 leading-relaxed">
                            Konfigurasi dinamis Identitas Brand, Kontak Operasional, Medsos, dan SEO langsung dari database.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-950/60 border border-slate-800/80 backdrop-blur-sm hover:border-[#3a9686]/60 transition-colors">
                        <div class="w-12 h-12 rounded-2xl bg-sky-500/20 border border-sky-500/30 text-sky-300 flex items-center justify-center mb-4">
                            <x-heroicon-o-device-phone-mobile class="w-6 h-6" aria-hidden="true" />
                        </div>
                        <h2 class="text-base font-bold text-white font-heading">Mobile Responsive & WCAG AA</h2>
                        <p class="mt-2 text-xs text-slate-400 leading-relaxed">
                            Antarmuka responsif ramah layar sentuh dengan kontras warna dan aksesibilitas ramah pembaca layar.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-950/60 border border-slate-800/80 backdrop-blur-sm hover:border-[#3a9686]/60 transition-colors">
                        <div class="w-12 h-12 rounded-2xl bg-[#24695c]/20 border border-[#3a9686]/30 text-teal-300 flex items-center justify-center mb-4">
                            <x-heroicon-o-photo class="w-6 h-6" aria-hidden="true" />
                        </div>
                        <h2 class="text-base font-bold text-white font-heading">Public Asset Storage</h2>
                        <p class="mt-2 text-xs text-slate-400 leading-relaxed">
                            Manajemen gambar terintegrasi dengan Symlink Storage Publik dan Intervention Image.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/80 bg-slate-950/90 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'PT Bersih Sebagian Dari Iman' }}. All rights reserved.</p>
            <p class="flex items-center gap-2">
                <span>Management System Engine</span>
                <span aria-hidden="true">•</span>
                <span class="text-teal-400 font-semibold">WCAG 2.1 AA Compliant</span>
            </p>
        </div>
    </footer>

</body>
</html>
