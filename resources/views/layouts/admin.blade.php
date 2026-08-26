<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'PT Bersih Sebagian Dari Iman' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full bg-slate-100 text-slate-900 antialiased selection:bg-emerald-600 selection:text-white flex overflow-hidden" id="app-body">

    <!-- Accessibility Skip Link (WCAG 2.1 AA) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-emerald-700 focus:text-white focus:font-bold focus:rounded-xl focus:shadow-2xl focus:outline-none focus:ring-4 focus:ring-emerald-400">
        Lewati ke Konten Utama
    </a>

    <!-- Mobile Sidebar Backdrop -->
    <div id="mobile-sidebar-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden hidden transition-opacity duration-300 opacity-0" aria-hidden="true"></div>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" role="complementary" aria-label="Sidebar Navigasi Utama" class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-slate-900 text-slate-100 flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 border-r border-slate-800 shrink-0 shadow-2xl lg:shadow-none">
        
        <!-- Sidebar Top: Brand & Close (on mobile) -->
        <div>
            <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80 bg-slate-950/40">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400 rounded-xl p-1" aria-label="Dashboard Beranda">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center text-white shadow-md shadow-emerald-600/30 group-hover:scale-105 transition-transform">
                        <x-heroicon-o-sparkles class="w-5 h-5" aria-hidden="true" />
                    </div>
                    <div class="min-w-0">
                        <span class="block text-base font-extrabold tracking-tight text-white group-hover:text-emerald-400 transition-colors truncate">
                            Bersih Sebagian
                        </span>
                        <span class="block text-[11px] font-semibold text-emerald-400 uppercase tracking-wider">
                            Admin Control
                        </span>
                    </div>
                </a>
                <!-- Close Button (Mobile Only) -->
                <button id="close-sidebar-btn" type="button" class="lg:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400 cursor-pointer" aria-label="Tutup menu navigasi">
                    <x-heroicon-o-x-mark class="w-6 h-6" aria-hidden="true" />
                </button>
            </div>

            <!-- Navigation Links -->
            <nav role="navigation" aria-label="Menu Utama" class="px-4 py-6 space-y-1.5 overflow-y-auto max-h-[calc(100vh-160px)]">
                
                <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Menu Utama
                </div>

                <!-- Dashboard (All) -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }} focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400" @if(request()->routeIs('dashboard')) aria-current="page" @endif>
                    <x-heroicon-o-squares-2x2 class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400' }}" aria-hidden="true" />
                    <span>Dashboard</span>
                </a>

                <!-- Content Management (Admin, Owner, Super Admin) -->
                @can('content.view')
                    <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Manajemen Konten
                    </div>
                    <a href="#content" class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold text-slate-300 hover:bg-slate-800/80 hover:text-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400">
                        <div class="flex items-center gap-3">
                            <x-heroicon-o-document-text class="w-5 h-5 text-slate-400" aria-hidden="true" />
                            <span>Konten & Layanan</span>
                        </div>
                        <span class="text-[10px] bg-slate-800 text-slate-400 px-2 py-0.5 rounded-md font-mono">Modul</span>
                    </a>
                @endcan

                <!-- Menu Management (Owner, Super Admin) -->
                @can('menu.view')
                    <a href="#menus" class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold text-slate-300 hover:bg-slate-800/80 hover:text-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400">
                        <div class="flex items-center gap-3">
                            <x-heroicon-o-list-bullet class="w-5 h-5 text-slate-400" aria-hidden="true" />
                            <span>Struktur Menu</span>
                        </div>
                    </a>
                @endcan

                <!-- System & User Management (Owner, Super Admin) -->
                @if(auth()->user()->can('user.view') || auth()->user()->can('role.view') || auth()->user()->can('setting.view'))
                    <div class="pt-4 px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Sistem & Kontrol
                    </div>

                    @can('user.view')
                        <a href="#users" class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold text-slate-300 hover:bg-slate-800/80 hover:text-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400">
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-users class="w-5 h-5 text-slate-400" aria-hidden="true" />
                                <span>Manajemen User</span>
                            </div>
                        </a>
                    @endcan

                    @can('role.view')
                        <a href="#roles" class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold text-slate-300 hover:bg-slate-800/80 hover:text-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400">
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-shield-check class="w-5 h-5 text-slate-400" aria-hidden="true" />
                                <span>Roles & Permissions</span>
                            </div>
                            <span class="text-[10px] bg-rose-950/80 text-rose-300 border border-rose-800 px-1.5 py-0.5 rounded font-bold">Teknis</span>
                        </a>
                    @endcan

                    @can('setting.view')
                        <a href="#settings" class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold text-slate-300 hover:bg-slate-800/80 hover:text-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400">
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-slate-400" aria-hidden="true" />
                                <span>Pengaturan Sistem</span>
                            </div>
                        </a>
                    @endcan
                @endif

            </nav>
        </div>

        <!-- Sidebar Bottom: User Profile Info -->
        <div class="p-4 border-t border-slate-800/80 bg-slate-950/60">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-600/30 border border-emerald-500/40 text-emerald-400 font-extrabold flex items-center justify-center text-sm shrink-0">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <span class="block text-sm font-bold text-white truncate">{{ Auth::user()->name }}</span>
                    <span class="inline-block text-[11px] font-semibold text-emerald-400 uppercase tracking-wider truncate">
                        {{ Auth::user()->roles->pluck('name')->first() ?? 'User' }}
                    </span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Header / Topbar -->
        <header role="banner" class="h-20 bg-white border-b border-slate-200/80 px-4 sm:px-6 lg:px-8 flex items-center justify-between shrink-0 sticky top-0 z-30 shadow-sm">
            
            <!-- Left Header: Mobile Toggle & Page Header -->
            <div class="flex items-center gap-4">
                <!-- Hamburger Button (Mobile) -->
                <button id="open-sidebar-btn" type="button" class="lg:hidden p-2.5 rounded-xl text-slate-700 hover:text-slate-900 hover:bg-slate-100 border border-slate-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 cursor-pointer" aria-label="Buka navigasi samping" aria-expanded="false" aria-controls="sidebar">
                    <x-heroicon-o-bars-3-bottom-left class="w-6 h-6" aria-hidden="true" />
                </button>

                <div>
                    <h1 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight leading-none">
                        @yield('header-title', 'Dashboard')
                    </h1>
                    <p class="text-xs text-slate-600 mt-1 hidden sm:block">
                        @yield('header-subtitle', 'Sistem Manajemen Operasional Cleaning Service')
                    </p>
                </div>
            </div>

            <!-- Right Header: Actions & User Dropdown -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 border border-slate-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 transition-colors" aria-label="Lihat Halaman Depan Portal (Buka di tab baru)">
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 text-emerald-600" aria-hidden="true" />
                    <span>Lihat Portal</span>
                </a>

                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold text-rose-700 hover:text-white bg-rose-50 hover:bg-rose-600 border border-rose-200 hover:border-rose-600 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-600 cursor-pointer" aria-label="Keluar dari sistem">
                        <x-heroicon-o-power class="w-4 h-4" aria-hidden="true" />
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Scrollable Main View Container -->
        <main id="main-content" role="main" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 focus:outline-none">
            
            <!-- Global Flash Messages -->
            @if (session('status'))
                <div role="status" aria-live="polite" class="mb-6 rounded-xl bg-emerald-50 border border-emerald-300 p-4 text-sm font-medium text-emerald-900 flex items-center gap-3 shadow-sm">
                    <x-heroicon-o-check-circle class="w-5 h-5 text-emerald-700 shrink-0" aria-hidden="true" />
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer role="contentinfo" class="bg-white border-t border-slate-200/80 px-6 py-3 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 shrink-0">
            <span>&copy; {{ date('Y') }} {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'PT Bersih Sebagian Dari Iman' }}. All rights reserved.</span>
            <span class="mt-1 sm:mt-0 font-medium text-emerald-700">WCAG 2.1 Level AA Compliant</span>
        </footer>

    </div>

    <!-- Script for Accessible Mobile Sidebar Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const openBtn = document.getElementById('open-sidebar-btn');
            const closeBtn = document.getElementById('close-sidebar-btn');
            const backdrop = document.getElementById('mobile-sidebar-backdrop');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
                openBtn.setAttribute('aria-expanded', 'true');
                closeBtn.focus();
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('opacity-0');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
                openBtn.setAttribute('aria-expanded', 'false');
                openBtn.focus();
            }

            if (openBtn) openBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (backdrop) backdrop.addEventListener('click', closeSidebar);

            // Escape key handler for accessible modal/drawer
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full') && window.innerWidth < 1024) {
                    closeSidebar();
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
