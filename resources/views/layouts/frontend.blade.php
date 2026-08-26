<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0B3B60">

    <!-- Artesaos SEO Tools Header Tags -->
    {!! SEO::generate() !!}

    <!-- Favicon -->
    @php
        $brand = app(\App\Settings\BrandSettings::class);
        $contact = app(\App\Settings\ContactSettings::class);
        $social = app(\App\Settings\SocialMediaSettings::class);
    @endphp
    <link rel="icon" type="image/png" href="{{ $brand->site_favicon ? asset('storage/' . $brand->site_favicon) : asset('favicon.ico') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-heading {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-slate-700 antialiased selection:bg-[#0B3B60] selection:text-white flex flex-col min-h-screen">

    <!-- Top Announcement / Quick Contact Bar -->
    <div class="bg-[#07243B] text-slate-300 text-xs py-2 px-4 sm:px-8 border-b border-white/10 hidden md:block">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-6">
                <span class="inline-flex items-center gap-1.5 text-slate-300">
                    <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-teal-400" aria-hidden="true" />
                    <span>{{ $contact->address ?: 'Bandung, Jawa Barat' }}</span>
                </span>
                <span class="inline-flex items-center gap-1.5 text-slate-300">
                    <x-heroicon-o-clock class="w-3.5 h-3.5 text-teal-400" aria-hidden="true" />
                    <span>{{ $contact->operating_hours ?: 'Senin - Sabtu: 08:00 - 17:00 WIB' }}</span>
                </span>
            </div>
            <div class="flex items-center gap-5">
                @if($contact->phone)
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" class="hover:text-white transition-colors flex items-center gap-1">
                        <x-heroicon-o-phone class="w-3.5 h-3.5 text-teal-400" aria-hidden="true" />
                        <span>{{ $contact->phone }}</span>
                    </a>
                @endif
                @if($contact->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" target="_blank" class="hover:text-white transition-colors flex items-center gap-1 font-semibold text-teal-300">
                        <span>WA: {{ $contact->whatsapp }}</span>
                    </a>
                @endif
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-amber-300 hover:text-amber-200 ml-2 border-l border-white/20 pl-3">
                        ⚡ Portal Admin
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all" id="site-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo -->
                <a href="{{ route('public.home') }}" class="flex items-center gap-3 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#0B3B60] rounded-xl p-1" aria-label="Beranda BersihPrima">
                    @if($brand->site_logo)
                        <img src="{{ asset('storage/' . $brand->site_logo) }}" alt="{{ $brand->site_name }}" class="h-11 w-auto object-contain">
                    @else
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#0B3B60] to-[#17629b] flex items-center justify-center text-white shadow-md shadow-[#0B3B60]/20 group-hover:scale-105 transition-transform">
                            <x-heroicon-o-sparkles class="w-6 h-6 text-cyan-300" aria-hidden="true" />
                        </div>
                    @endif
                    <div>
                        <span class="block text-xl sm:text-2xl font-black tracking-tight text-[#0B3B60] font-heading leading-none">
                            {{ $brand->site_name ?: 'BersihPrima' }}
                        </span>
                        <span class="block text-[10px] sm:text-[11px] font-extrabold uppercase tracking-widest text-[#17629b] font-heading mt-0.5">
                            {{ $brand->site_tagline ?: 'FACILITY & CLEANING SERVICE' }}
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden lg:flex items-center gap-1" aria-label="Menu Utama">
                    <a href="{{ route('public.home') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('public.home') ? 'text-[#0B3B60] bg-[#e6f1f8]' : 'text-slate-600 hover:text-[#0B3B60] hover:bg-slate-50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('public.services') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('public.services*') ? 'text-[#0B3B60] bg-[#e6f1f8]' : 'text-slate-600 hover:text-[#0B3B60] hover:bg-slate-50' }}">
                        Layanan
                    </a>
                    <a href="{{ route('public.portfolio') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('public.portfolio*') ? 'text-[#0B3B60] bg-[#e6f1f8]' : 'text-slate-600 hover:text-[#0B3B60] hover:bg-slate-50' }}">
                        Mitra & Portofolio
                    </a>
                    <a href="{{ route('public.articles') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('public.articles*') ? 'text-[#0B3B60] bg-[#e6f1f8]' : 'text-slate-600 hover:text-[#0B3B60] hover:bg-slate-50' }}">
                        Artikel
                    </a>
                    <a href="{{ route('public.contact') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('public.contact*') ? 'text-[#0B3B60] bg-[#e6f1f8]' : 'text-slate-600 hover:text-[#0B3B60] hover:bg-slate-50' }}">
                        Kontak Kami
                    </a>
                </nav>

                <!-- Desktop Action Button -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('public.contact') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-extrabold uppercase tracking-wider text-white bg-[#0B3B60] hover:bg-[#07243B] shadow-md shadow-[#0B3B60]/20 hover:shadow-lg transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#0B3B60] font-heading">
                        <span>Hubungi Kami</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 text-cyan-300" aria-hidden="true" />
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex items-center lg:hidden">
                    <button id="mobile-menu-btn" type="button" class="p-2.5 rounded-2xl text-slate-700 hover:text-[#0B3B60] hover:bg-slate-100 border border-slate-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#0B3B60]" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-nav">
                        <x-heroicon-o-bars-3 class="w-6 h-6" aria-hidden="true" />
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobile-nav" class="hidden lg:hidden border-t border-slate-100 bg-white px-4 pt-3 pb-6 space-y-2 shadow-xl">
            <a href="{{ route('public.home') }}" class="block px-4 py-3 rounded-2xl text-base font-bold {{ request()->routeIs('public.home') ? 'bg-[#e6f1f8] text-[#0B3B60]' : 'text-slate-700 hover:bg-slate-50' }}">
                Beranda
            </a>
            <a href="{{ route('public.services') }}" class="block px-4 py-3 rounded-2xl text-base font-bold {{ request()->routeIs('public.services*') ? 'bg-[#e6f1f8] text-[#0B3B60]' : 'text-slate-700 hover:bg-slate-50' }}">
                Layanan
            </a>
            <a href="{{ route('public.portfolio') }}" class="block px-4 py-3 rounded-2xl text-base font-bold {{ request()->routeIs('public.portfolio*') ? 'bg-[#e6f1f8] text-[#0B3B60]' : 'text-slate-700 hover:bg-slate-50' }}">
                Mitra & Portofolio
            </a>
            <a href="{{ route('public.articles') }}" class="block px-4 py-3 rounded-2xl text-base font-bold {{ request()->routeIs('public.articles*') ? 'bg-[#e6f1f8] text-[#0B3B60]' : 'text-slate-700 hover:bg-slate-50' }}">
                Artikel & Berita
            </a>
            <a href="{{ route('public.contact') }}" class="block px-4 py-3 rounded-2xl text-base font-bold {{ request()->routeIs('public.contact*') ? 'bg-[#e6f1f8] text-[#0B3B60]' : 'text-slate-700 hover:bg-slate-50' }}">
                Kontak Kami
            </a>
            <div class="pt-4 border-t border-slate-100">
                <a href="{{ route('public.contact') }}" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-extrabold uppercase text-white bg-[#0B3B60] font-heading tracking-wider">
                    <span>Minta Penawaran (RFQ)</span>
                    <x-heroicon-o-arrow-right class="w-4 h-4" aria-hidden="true" />
                </a>
            </div>
        </div>
    </header>

    <!-- Main Dynamic Content -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating WhatsApp Action Button -->
    @if($contact->whatsapp)
        <a 
            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}?text={{ urlencode('Halo ' . ($brand->site_name ?: 'BersihPrima') . ', saya tertarik dengan layanan cleaning service dan ingin meminta penawaran harga.') }}" 
            target="_blank" 
            rel="noopener noreferrer"
            class="fixed bottom-6 right-6 z-50 inline-flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3.5 rounded-full shadow-2xl hover:shadow-emerald-500/50 hover:-translate-y-1 transition-all duration-300 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-emerald-300 group"
            aria-label="Konsultasi WhatsApp Sekarang"
        >
            <span class="w-6 h-6 flex items-center justify-center font-bold">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/>
                </svg>
            </span>
            <span class="text-xs font-black uppercase tracking-wider font-heading hidden sm:inline">Konsultasi WA</span>
        </a>
    @endif

    <!-- Semantic Footer -->
    <footer class="bg-[#07243B] text-slate-300 mt-auto border-t border-white/10 pt-16 pb-8" role="contentinfo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">
                
                <!-- Col 1: Brand Info & Bio -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-2xl bg-white/10 flex items-center justify-center text-white">
                            <x-heroicon-o-sparkles class="w-5 h-5 text-cyan-300" aria-hidden="true" />
                        </div>
                        <span class="text-xl font-black text-white font-heading tracking-tight">
                            {{ $brand->site_name ?: 'BersihPrima' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        {{ $brand->site_description ?: 'Penyedia solusi cleaning service, sanitasi, dan alih daya fasilitas profesional dengan standar mutu ISO 9001:2015.' }}
                    </p>
                    <div class="pt-2 flex items-center gap-3">
                        @if($social->facebook)
                            <a href="{{ $social->facebook }}" target="_blank" class="w-8 h-8 rounded-full bg-white/5 hover:bg-[#0B3B60] text-slate-300 hover:text-white flex items-center justify-center transition-colors text-xs" aria-label="Facebook">FB</a>
                        @endif
                        @if($social->instagram)
                            <a href="{{ $social->instagram }}" target="_blank" class="w-8 h-8 rounded-full bg-white/5 hover:bg-[#0B3B60] text-slate-300 hover:text-white flex items-center justify-center transition-colors text-xs" aria-label="Instagram">IG</a>
                        @endif
                        @if($social->linkedin)
                            <a href="{{ $social->linkedin }}" target="_blank" class="w-8 h-8 rounded-full bg-white/5 hover:bg-[#0B3B60] text-slate-300 hover:text-white flex items-center justify-center transition-colors text-xs" aria-label="LinkedIn">IN</a>
                        @endif
                        @if($social->tiktok)
                            <a href="{{ $social->tiktok }}" target="_blank" class="w-8 h-8 rounded-full bg-white/5 hover:bg-[#0B3B60] text-slate-300 hover:text-white flex items-center justify-center transition-colors text-xs" aria-label="TikTok">TT</a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-white font-heading mb-4 border-l-2 border-cyan-400 pl-3">
                        Navigasi Cepat
                    </h3>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="{{ route('public.home') }}" class="hover:text-cyan-300 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('public.services') }}" class="hover:text-cyan-300 transition-colors">Solusi & Layanan Kami</a></li>
                        <li><a href="{{ route('public.portfolio') }}" class="hover:text-cyan-300 transition-colors">Mitra Klien & Portofolio</a></li>
                        <li><a href="{{ route('public.articles') }}" class="hover:text-cyan-300 transition-colors">Artikel & Edukasi Kebersihan</a></li>
                        <li><a href="{{ route('public.contact') }}" class="hover:text-cyan-300 transition-colors">Kontak & Form RFQ</a></li>
                        <li><a href="{{ route('public.sitemap') }}" target="_blank" class="hover:text-cyan-300 transition-colors">XML Sitemap</a></li>
                    </ul>
                </div>

                <!-- Col 3: Services List -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-white font-heading mb-4 border-l-2 border-cyan-400 pl-3">
                        Layanan Utama
                    </h3>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="{{ route('public.services') }}" class="hover:text-cyan-300 transition-colors">Cleaning Service Perkantoran</a></li>
                        <li><a href="{{ route('public.services') }}" class="hover:text-cyan-300 transition-colors">Deep Cleaning Kasur & Sofa</a></li>
                        <li><a href="{{ route('public.services') }}" class="hover:text-cyan-300 transition-colors">Pembersihan Kaca Gedung Ketinggian</a></li>
                        <li><a href="{{ route('public.services') }}" class="hover:text-cyan-300 transition-colors">Pest Control & Pengasapan Hama</a></li>
                        <li><a href="{{ route('public.services') }}" class="hover:text-cyan-300 transition-colors">Facility Management Outsourcing</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Operating Hours -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-white font-heading mb-4 border-l-2 border-cyan-400 pl-3">
                        Kantor Operasional
                    </h3>
                    <div class="space-y-3 text-xs text-slate-400">
                        <p class="leading-relaxed">{{ $contact->address ?: 'Jl. Kebersihan No. 10, Sukajadi, Bandung, Jawa Barat 40161' }}</p>
                        <p><strong class="text-white">Telepon:</strong> {{ $contact->phone ?: '(022) 1234 5678' }}</p>
                        <p><strong class="text-white">Email:</strong> {{ $contact->email ?: 'info@bersihprima.co.id' }}</p>
                        <p><strong class="text-white">Jam Kerja:</strong> {{ $contact->operating_hours ?: 'Senin - Sabtu: 08.00 - 17.00 WIB' }}</p>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright & Compliance -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                <p>
                    Copyright &copy; {{ date('Y') }} {{ $brand->site_name ?: 'PT Bersih Sebagian Dari Iman' }}. All Right Reserved. | Developed by <a href="{{ config('app.developer_url', env('DEVELOPER_URL', 'https://techjourneymadpeople.com')) }}" target="_blank" rel="noopener noreferrer" class="text-cyan-400 hover:text-cyan-300 font-semibold underline underline-offset-2 transition-colors">{{ config('app.developer_name', env('DEVELOPER_NAME', 'Tech Journey Mad People')) }}</a>
                </p>
                <div class="flex items-center gap-4 text-[11px]">
                    <span class="text-teal-400 font-semibold">ISO 9001:2015 Certified</span>
                    <span>•</span>
                    <span>ASPPHAMI Licensed</span>
                    <span>•</span>
                    <span>WCAG 2.1 AA</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-nav');
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    const isExpanded = btn.getAttribute('aria-expanded') === 'true';
                    btn.setAttribute('aria-expanded', !isExpanded);
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
