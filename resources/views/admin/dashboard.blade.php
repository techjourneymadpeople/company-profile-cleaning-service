@extends('layouts.admin')

@section('title', 'Dashboard Utama')
@section('header-title', 'General Dashboard')
@section('header-subtitle', 'Ringkasan operasional dan status kendali sistem')

@section('content')
<div class="space-y-6">

    <!-- Viho Welcome Greeting Banner -->
    <section aria-labelledby="welcome-heading" class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#24695c] via-[#2a7a6b] to-[#1c554a] p-6 sm:p-8 text-white shadow-[0_10px_30px_rgba(36,105,92,0.2)] border border-[#3aa290]/40">
        <!-- Abstract decorative circular background (Viho style) -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-white/5 blur-2xl pointer-events-none" aria-hidden="true"></div>
        <div class="absolute top-0 right-1/3 w-32 h-32 rounded-full bg-teal-300/10 blur-xl pointer-events-none" aria-hidden="true"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-sm text-[#e2f4f1] text-[11px] font-bold uppercase tracking-wider mb-3 font-heading border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse" aria-hidden="true"></span>
                    Portal Operasional Cleaning Service
                </div>
                <h2 id="welcome-heading" class="text-2xl sm:text-3xl font-black font-heading tracking-tight">
                    Selamat Datang, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-teal-100 max-w-2xl leading-relaxed">
                    Sistem siap digunakan. Anda memiliki hak akses level <span class="font-bold text-white bg-black/20 px-2 py-0.5 rounded-md">{{ Auth::user()->roles->pluck('name')->first() ?? 'Pengguna' }}</span> untuk mengelola operasional perusahaan cleaning service.
                </p>
            </div>
            
            <div class="flex items-center gap-3 shrink-0 bg-black/15 p-4 rounded-2xl border border-white/10">
                <div class="text-right">
                    <div class="text-[10px] uppercase font-bold tracking-wider text-teal-200 font-heading">Waktu Sistem</div>
                    <div class="text-sm font-extrabold font-mono text-white">{{ date('d M Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Viho Content & Stat Metric Cards Grid -->
    <section aria-label="Statistik Ringkas" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Total Services -->
        <div class="bg-[#e2f4f1]/60 border border-[#a2ded5]/80 p-5 rounded-3xl shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-[#24695c] font-heading">Solusi & Layanan</span>
                <div class="w-11 h-11 rounded-2xl bg-white text-[#24695c] flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                    <x-heroicon-o-sparkles class="w-6 h-6" aria-hidden="true" />
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900 font-heading">{{ \App\Models\Service::count() }}</span>
                <span class="text-xs font-semibold text-[#24695c]">Layanan Aktif</span>
            </div>
        </div>

        <!-- Total Projects -->
        <div class="bg-sky-50/70 border border-sky-200/80 p-5 rounded-3xl shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-700 font-heading">Galeri Proyek</span>
                <div class="w-11 h-11 rounded-2xl bg-white text-sky-600 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                    <x-heroicon-o-photo class="w-6 h-6" aria-hidden="true" />
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900 font-heading">{{ \App\Models\Project::count() }}</span>
                <span class="text-xs font-semibold text-sky-700">Before & After</span>
            </div>
        </div>

        <!-- Leads & Inquiries -->
        <div class="bg-rose-50/70 border border-rose-200/80 p-5 rounded-3xl shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-rose-700 font-heading">Permintaan Penawaran</span>
                <div class="w-11 h-11 rounded-2xl bg-white text-rose-600 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                    <x-heroicon-o-inbox-arrow-down class="w-6 h-6" aria-hidden="true" />
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900 font-heading">{{ \App\Models\Inquiry::count() }}</span>
                <span class="text-xs font-semibold text-rose-700">Leads Masuk</span>
            </div>
        </div>

        <!-- Clients & Partners -->
        <div class="bg-amber-50/70 border border-amber-200/80 p-5 rounded-3xl shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700 font-heading">Klien & Mitra</span>
                <div class="w-11 h-11 rounded-2xl bg-white text-amber-600 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                    <x-heroicon-o-building-office-2 class="w-6 h-6" aria-hidden="true" />
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900 font-heading">{{ \App\Models\Client::count() }}</span>
                <span class="text-xs font-semibold text-amber-700">Trusted By Mitra</span>
            </div>
        </div>
    </section>

    <!-- Two Columns Details Section (Viho Style Cards) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left 2 Cols: Brand & Operational Settings Snapshot -->
        <section aria-labelledby="brand-snapshot-heading" class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#e2f4f1] text-[#24695c] flex items-center justify-center">
                        <x-heroicon-o-building-office class="w-5 h-5" aria-hidden="true" />
                    </div>
                    <div>
                        <h3 id="brand-snapshot-heading" class="text-base font-bold text-slate-900 font-heading">Informasi Identitas & Kontak Perusahaan</h3>
                        <p class="text-xs text-slate-400">Konfigurasi dinamis aktif dari Spatie Laravel Settings</p>
                    </div>
                </div>
                @can('setting.view')
                    <span class="text-[11px] font-bold text-[#24695c] bg-[#e2f4f1] px-3 py-1 rounded-full border border-[#a2ded5]/60 font-heading uppercase">
                        Settings Aktif
                    </span>
                @endcan
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <!-- Brand Info -->
                <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100">
                    <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider font-heading">Nama Perusahaan / Brand</span>
                    <p class="mt-1 font-bold text-slate-900">{{ app(\App\Settings\BrandSettings::class)->site_name }}</p>
                    <p class="mt-0.5 text-xs text-slate-500">{{ app(\App\Settings\BrandSettings::class)->site_tagline }}</p>
                </div>

                <!-- Contact Info -->
                <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100">
                    <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider font-heading">Kontak & WhatsApp</span>
                    <p class="mt-1 font-bold text-slate-900">{{ app(\App\Settings\ContactSettings::class)->whatsapp }}</p>
                    <p class="mt-0.5 text-xs text-slate-500">{{ app(\App\Settings\ContactSettings::class)->email }}</p>
                </div>

                <!-- Address -->
                <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100">
                    <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider font-heading">Alamat Kantor & Operasional</span>
                    <p class="mt-1 text-xs text-slate-800 leading-relaxed">{{ app(\App\Settings\ContactSettings::class)->address }}</p>
                    <p class="mt-1 text-[11px] font-bold text-[#24695c]">{{ app(\App\Settings\ContactSettings::class)->operating_hours }}</p>
                </div>

                <!-- SEO Meta -->
                <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100">
                    <span class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider font-heading">SEO Title Tag</span>
                    <p class="mt-1 text-xs font-semibold text-slate-800 truncate">{{ app(\App\Settings\SeoSettings::class)->meta_title }}</p>
                    <p class="mt-1 text-[11px] text-slate-500 truncate">{{ app(\App\Settings\SeoSettings::class)->meta_description }}</p>
                </div>
            </div>
        </section>

        <!-- Right Col: Permissions Matrix of Current User (Viho Style) -->
        <section aria-labelledby="permissions-heading" class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-[#e2f4f1] text-[#24695c] flex items-center justify-center">
                        <x-heroicon-o-key class="w-5 h-5" aria-hidden="true" />
                    </div>
                    <div>
                        <h3 id="permissions-heading" class="text-base font-bold text-slate-900 font-heading">Daftar Hak Akses</h3>
                        <p class="text-xs text-slate-400">Permissions aktif untuk akun Anda</p>
                    </div>
                </div>

                <div class="mt-5 space-y-2 max-h-72 overflow-y-auto pr-1 viho-scrollbar">
                    @forelse(Auth::user()->getAllPermissions() as $perm)
                        <div class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl bg-slate-50/80 border border-slate-100 text-xs font-medium text-slate-800 hover:bg-[#e2f4f1]/50 transition-colors">
                            <div class="flex items-center gap-2">
                                <x-heroicon-s-check-circle class="w-4 h-4 text-[#24695c] shrink-0" aria-hidden="true" />
                                <span class="font-mono text-[11px] font-semibold text-slate-700">{{ $perm->name }}</span>
                            </div>
                            <span class="text-[9px] font-bold uppercase text-[#24695c] bg-[#e2f4f1] px-2 py-0.5 rounded-md">Granted</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic p-3">Belum ada permission khusus.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Peran: <strong class="text-slate-900 font-heading">{{ Auth::user()->roles->pluck('name')->first() ?? '-' }}</strong></span>
                <span class="font-semibold text-[#24695c]">{{ Auth::user()->getAllPermissions()->count() }} Permissions</span>
            </div>
        </section>

    </div>

</div>
@endsection
