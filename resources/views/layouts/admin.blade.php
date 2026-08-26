<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f5f7fb]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'PT Bersih Sebagian Dari Iman' }}</title>

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
        /* Custom scrollbar for sidebar */
        .admin-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .admin-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .admin-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(36, 105, 92, 0.15);
            border-radius: 10px;
        }
        .admin-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(36, 105, 92, 0.35);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full bg-[#f5f7fb] text-slate-800 antialiased selection:bg-[#24695c] selection:text-white flex overflow-hidden">

    <!-- Accessibility Skip Link (WCAG 2.1 AA) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-[#24695c] focus:text-white focus:font-bold focus:rounded-xl focus:shadow-2xl focus:outline-none focus:ring-4 focus:ring-[#a2ded5]">
        Lewati ke Konten Utama
    </a>

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="mobile-sidebar-backdrop" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 lg:hidden hidden transition-opacity duration-300 opacity-0" aria-hidden="true"></div>

    <!-- Main Sidebar Navigation -->
    <aside id="sidebar" role="complementary" aria-label="Sidebar Navigasi Admin" class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-white text-slate-700 flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 border-r border-slate-200/80 shrink-0 shadow-[0_0_25px_rgba(8,21,66,0.04)] lg:shadow-none">
        
        <!-- Sidebar Content Top -->
        <div class="flex-1 overflow-y-auto admin-scrollbar flex flex-col">
            
            <!-- Brand Header -->
            <div class="h-20 px-6 flex items-center justify-between border-b border-slate-100 bg-white sticky top-0 z-10">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] rounded-xl p-1" aria-label="Dashboard Beranda">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#24695c] to-[#3a9686] flex items-center justify-center text-white shadow-md shadow-[#24695c]/25 group-hover:scale-105 transition-transform">
                        <x-heroicon-o-sparkles class="w-6 h-6" aria-hidden="true" />
                    </div>
                    <div class="min-w-0">
                        <span class="block text-base font-black tracking-tight text-slate-900 font-heading truncate">
                            Bersih Sebagian
                        </span>
                        <span class="block text-[10px] font-bold text-[#24695c] uppercase tracking-wider">
                            Admin Control Panel
                        </span>
                    </div>
                </a>
                
                <!-- Close Button (Mobile Only) -->
                <button id="close-sidebar-btn" type="button" class="lg:hidden p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer" aria-label="Tutup navigasi">
                    <x-heroicon-o-x-mark class="w-6 h-6" aria-hidden="true" />
                </button>
            </div>

            <!-- Sidebar User Profile Widget -->
            <div class="p-6 text-center border-b border-slate-100 bg-gradient-to-b from-slate-50/70 to-white">
                <div class="relative inline-block mx-auto mb-3">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-[#24695c] to-[#4aa897] text-white flex items-center justify-center text-xl font-black font-heading shadow-md ring-4 ring-[#e2f4f1]">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <span class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-emerald-500 ring-2 ring-white" title="Status Online" aria-label="Online"></span>
                </div>
                <h2 class="text-sm font-bold text-slate-900 font-heading truncate">
                    {{ Auth::user()->name }}
                </h2>
                <div class="mt-1">
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-[10px] font-bold bg-[#e2f4f1] text-[#24695c] border border-[#a2ded5]/60 uppercase tracking-wider">
                        {{ Auth::user()->roles->pluck('name')->first() ?? 'User' }}
                    </span>
                </div>

                <!-- Mini User Stats -->
                <!-- <div class="mt-4 pt-3 border-t border-slate-100 grid grid-cols-3 text-center text-xs">
                    <div>
                        <span class="block font-bold text-slate-900 font-heading">Aktif</span>
                        <span class="text-[10px] text-slate-400">Status</span>
                    </div>
                    <div>
                        <span class="block font-bold text-[#24695c] font-heading">{{ Auth::user()->roles->count() }}</span>
                        <span class="text-[10px] text-slate-400">Role</span>
                    </div>
                    <div>
                        <span class="block font-bold text-slate-900 font-heading">{{ Auth::user()->getAllPermissions()->count() }}</span>
                        <span class="text-[10px] text-slate-400">Hak Akses</span>
                    </div>
                </div> -->
            </div>

            <!-- Dynamic Menu Section with 4 Clear Categories -->
            <nav role="navigation" aria-label="Navigasi Menu Utama" class="px-4 py-4 space-y-1">
                
                @php
                    $sidebarMenus = \App\Models\Menu::active()->ordered()->get();
                    $currentGroup = null;
                @endphp

                @forelse($sidebarMenus as $menu)
                    @if(empty($menu->permission_name) || auth()->user()->can($menu->permission_name))
                        @php
                            $group = match(true) {
                                $menu->order <= 1 => 'Dashboard',
                                $menu->order <= 5 => 'User dan Akses Kontrol',
                                $menu->order <= 13 => 'Content',
                                default => 'Pengaturan',
                            };
                        @endphp

                        @if($currentGroup !== $group)
                            @php $currentGroup = $group; @endphp
                            <div class="px-3 pt-4 pb-1.5 text-[10px] font-extrabold uppercase tracking-widest text-slate-400 font-heading first:pt-1">
                                {{ $group }}
                            </div>
                        @endif

                        @php
                            $isCurrent = false;
                            $targetUrl = '#';
                            if (!empty($menu->route)) {
                                if (\Illuminate\Support\Facades\Route::has($menu->route)) {
                                    $targetUrl = route($menu->route);
                                    $parts = explode('.', $menu->route);
                                    if (count($parts) >= 2 && $parts[0] === 'admin') {
                                        $resource = $parts[1];
                                        if ($resource === 'dashboard') {
                                            $isCurrent = request()->routeIs('admin.dashboard') || request()->routeIs('dashboard');
                                        } else {
                                            $isCurrent = request()->routeIs("admin.{$resource}.*") || request()->routeIs($menu->route);
                                        }
                                    } else {
                                        $isCurrent = request()->routeIs($menu->route);
                                    }
                                } else {
                                    $targetUrl = url($menu->route);
                                    $isCurrent = request()->is(trim($menu->route, '/'));
                                }
                            }
                        @endphp
                        <a href="{{ $targetUrl }}" class="group flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition-all duration-200 {{ $isCurrent ? 'bg-[#24695c] text-white shadow-md shadow-[#24695c]/25 font-bold' : 'text-slate-600 hover:bg-[#e2f4f1]/60 hover:text-[#24695c]' }} focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" @if($isCurrent) aria-current="page" @endif>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ $isCurrent ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-[#e2f4f1] group-hover:text-[#24695c]' }}">
                                    @if($menu->icon && str_starts_with($menu->icon, 'heroicon-'))
                                        <x-dynamic-component :component="$menu->icon" class="w-4 h-4" aria-hidden="true" />
                                    @else
                                        <x-heroicon-o-folder class="w-4 h-4" aria-hidden="true" />
                                    @endif
                                </div>
                                <span class="font-medium {{ $isCurrent ? 'font-bold' : '' }} text-xs sm:text-sm">{{ $menu->title }}</span>
                            </div>
                            
                            @if($menu->permission_name && in_array($menu->permission_name, ['role.view', 'permission.view']))
                                <span class="text-[9px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded-md {{ $isCurrent ? 'bg-white/20 text-white' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                    Teknis
                                </span>
                            @endif
                        </a>
                    @endif
                @empty
                    <div class="px-3 py-2 text-xs text-slate-400 italic">
                        Tidak ada menu yang aktif.
                    </div>
                @endforelse

            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-100 bg-slate-50/80 text-center text-xs text-slate-400">
            <span class="block font-semibold text-slate-600">PT Bersih Sebagian Dari Iman</span>
            <span class="text-[10px]">Admin Panel v1.0</span>
        </div>
    </aside>

    <!-- Main Container -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Main Topbar / Header -->
        <header role="banner" class="h-20 bg-white border-b border-slate-200/80 px-4 sm:px-6 lg:px-8 flex items-center justify-between shrink-0 sticky top-0 z-30 shadow-[0_2px_15px_rgba(8,21,66,0.03)]">
            
            <!-- Left Side: Mobile Toggle & Quick Search -->
            <div class="flex items-center gap-4">
                <!-- Hamburger Button (Mobile) -->
                <button id="open-sidebar-btn" type="button" class="lg:hidden p-2.5 rounded-2xl text-slate-700 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="sidebar">
                    <x-heroicon-o-bars-3-bottom-left class="w-6 h-6" aria-hidden="true" />
                </button>

                <!-- Breadcrumbs & Title -->
                <div>
                    <h1 class="text-lg sm:text-xl font-black text-slate-900 font-heading tracking-tight leading-none">
                        @yield('header-title', 'Dashboard')
                    </h1>
                    <p class="text-xs text-slate-500 mt-1 hidden sm:block">
                        @yield('header-subtitle', 'Sistem Manajemen Operasional & Layanan Cleaning')
                    </p>
                </div>
            </div>

            <!-- Right Side: Header Utilities & User Profile Menu -->
            <div class="flex items-center gap-2.5 sm:gap-3.5">
                
                <!-- Portal Link -->
                <a href="{{ url('/') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-2xl text-xs font-bold text-[#24695c] bg-[#e2f4f1]/80 hover:bg-[#e2f4f1] border border-[#a2ded5]/60 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" aria-label="Buka halaman depan portal (Tab Baru)">
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 text-[#24695c]" aria-hidden="true" />
                    <span>Lihat Portal</span>
                </a>

                <!-- Notification Bell Indicator -->
                <!-- <button type="button" class="relative p-2.5 rounded-2xl text-slate-600 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200/80 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" aria-label="Notifikasi sistem">
                    <x-heroicon-o-bell class="w-5 h-5" aria-hidden="true" />
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-white animate-pulse" aria-hidden="true"></span>
                </button> -->

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-xs font-bold text-rose-700 hover:text-white bg-rose-50 hover:bg-rose-600 border border-rose-200 hover:border-rose-600 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer font-heading uppercase tracking-wider" aria-label="Keluar dari sesi">
                        <x-heroicon-o-power class="w-4 h-4" aria-hidden="true" />
                        <span class="hidden sm:inline">Log out</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Scrollable Main Content -->
        <main id="main-content" role="main" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 focus:outline-none">
            
            <!-- Global Flash Messages -->
            @if (session('status'))
                <div role="status" aria-live="polite" class="mb-6 rounded-2xl bg-[#e2f4f1] border border-[#a2ded5] p-4 text-sm font-semibold text-[#164f45] flex items-center gap-3 shadow-sm">
                    <x-heroicon-s-check-circle class="w-5 h-5 text-[#24695c] shrink-0" aria-hidden="true" />
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer role="contentinfo" class="bg-white border-t border-slate-200/80 px-6 py-3.5 text-center sm:text-left flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 shrink-0">
            <span>&copy; {{ date('Y') }} {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'PT Bersih Sebagian Dari Iman' }}. All rights reserved.</span>
            <span class="mt-1 sm:mt-0 font-bold text-[#24695c]">WCAG 2.1 Level AA Compliant</span>
        </footer>

    </div>

    <!-- Accessible Mobile Sidebar Toggle Script -->
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

            // Escape key support
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full') && window.innerWidth < 1024) {
                    closeSidebar();
                }
            });

            // Global DataTable Auto-initialization
            if (typeof $ !== 'undefined' && $.fn.DataTable) {
                $('.datatable').each(function() {
                    if (!$.fn.DataTable.isDataTable(this)) {
                        $(this).DataTable({
                            language: {
                                search: "Cari Data:",
                                lengthMenu: "Tampilkan _MENU_ data",
                                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                                infoFiltered: "(disaring dari _MAX_ data)",
                                zeroRecords: "Tidak ada data yang cocok ditemukan",
                                paginate: {
                                    first: "Awal",
                                    last: "Akhir",
                                    next: "Berikutnya",
                                    previous: "Sebelumnya"
                                }
                            },
                            responsive: true,
                            pageLength: 10
                        });
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
