@extends('layouts.admin')

@section('title', 'Dashboard Utama')
@section('header-title', 'Dashboard Utama')
@section('header-subtitle', 'Ringkasan operasional dan status kendali sistem')

@section('content')
<div class="space-y-6">

    <!-- Welcome Hero Banner -->
    <section aria-labelledby="welcome-heading" class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-emerald-950 p-6 sm:p-8 text-white shadow-xl shadow-slate-900/10 border border-slate-700/60">
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-3 border border-emerald-500/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Sesi Aktif
                </div>
                <h2 id="welcome-heading" class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Selamat Datang, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="mt-2 text-sm text-slate-300 max-w-2xl leading-relaxed">
                    Anda masuk dengan peran <span class="font-bold text-emerald-400">{{ Auth::user()->roles->pluck('name')->first() ?? 'Pengguna' }}</span>. Sistem siap digunakan untuk mengelola data operasional dan konten perusahaan cleaning service.
                </p>
            </div>
            
            <div class="flex items-center gap-3 shrink-0">
                <div class="text-right hidden sm:block">
                    <div class="text-xs text-slate-400">Waktu Server</div>
                    <div class="text-sm font-bold font-mono text-emerald-400">{{ date('d M Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stat Metric Cards Grid -->
    <section aria-label="Statistik Ringkas" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Total Users Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Pengguna</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                    <x-heroicon-o-users class="w-5 h-5" aria-hidden="true" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900">{{ \App\Models\User::count() }}</span>
                <span class="text-xs font-semibold text-emerald-700">Akun terdaftar</span>
            </div>
        </div>

        <!-- Total Roles Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Role Sistem</span>
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center">
                    <x-heroicon-o-shield-check class="w-5 h-5" aria-hidden="true" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900">{{ \Spatie\Permission\Models\Role::count() }}</span>
                <span class="text-xs font-semibold text-teal-700">Level hak akses</span>
            </div>
        </div>

        <!-- Spatie Settings Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Grup Settings</span>
                <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-700 flex items-center justify-center">
                    <x-heroicon-o-cog-6-tooth class="w-5 h-5" aria-hidden="true" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900">4</span>
                <span class="text-xs font-semibold text-cyan-700">Brand, Kontak, Medsos, SEO</span>
            </div>
        </div>

        <!-- Public Storage Status Card -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Asset Storage</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                    <x-heroicon-o-folder-arrow-down class="w-5 h-5" aria-hidden="true" />
                </div>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-lg font-black text-emerald-700 flex items-center gap-1">
                    <x-heroicon-s-check-circle class="w-5 h-5" aria-hidden="true" />
                    Terhubung
                </span>
                <span class="text-xs text-slate-500">public/storage</span>
            </div>
        </div>
    </section>

    <!-- Two Columns Details Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Brand & Settings Status Snapshot -->
        <section aria-labelledby="settings-snapshot-heading" class="lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div>
                    <h3 id="settings-snapshot-heading" class="text-base font-bold text-slate-900">Identitas & Konfigurasi Brand Aktif</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Pengaturan Spatie Settings yang saat ini dimuat oleh aplikasi</p>
                </div>
                @can('setting.view')
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                        Settings Aktif
                    </span>
                @endcan
            </div>

            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <!-- Brand Info -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold uppercase text-slate-500 tracking-wider">Nama Brand / Perusahaan</span>
                    <p class="mt-1 font-bold text-slate-900">{{ app(\App\Settings\BrandSettings::class)->site_name }}</p>
                    <p class="mt-0.5 text-xs text-slate-600">{{ app(\App\Settings\BrandSettings::class)->site_tagline }}</p>
                </div>

                <!-- Contact Info -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold uppercase text-slate-500 tracking-wider">Kontak & WhatsApp</span>
                    <p class="mt-1 font-bold text-slate-900">{{ app(\App\Settings\ContactSettings::class)->whatsapp }}</p>
                    <p class="mt-0.5 text-xs text-slate-600">{{ app(\App\Settings\ContactSettings::class)->email }}</p>
                </div>

                <!-- Address -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold uppercase text-slate-500 tracking-wider">Alamat Kantor</span>
                    <p class="mt-1 text-xs text-slate-800 leading-relaxed">{{ app(\App\Settings\ContactSettings::class)->address }}</p>
                    <p class="mt-1 text-[11px] font-semibold text-emerald-700">{{ app(\App\Settings\ContactSettings::class)->operating_hours }}</p>
                </div>

                <!-- SEO Meta -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="text-xs font-bold uppercase text-slate-500 tracking-wider">SEO Title Tag</span>
                    <p class="mt-1 text-xs font-semibold text-slate-800 leading-relaxed truncate">{{ app(\App\Settings\SeoSettings::class)->meta_title }}</p>
                    <p class="mt-1 text-[11px] text-slate-500 truncate">{{ app(\App\Settings\SeoSettings::class)->meta_description }}</p>
                </div>
            </div>
        </section>

        <!-- Right: Current User Permissions Matrix -->
        <section aria-labelledby="permissions-heading" class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2 pb-4 border-b border-slate-100">
                    <x-heroicon-o-key class="w-5 h-5 text-emerald-700" aria-hidden="true" />
                    <h3 id="permissions-heading" class="text-base font-bold text-slate-900">Hak Akses Anda</h3>
                </div>

                <div class="mt-4 space-y-2 max-h-72 overflow-y-auto pr-1">
                    @forelse(Auth::user()->getAllPermissions() as $perm)
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-slate-50 border border-slate-200 text-xs font-medium text-slate-800">
                            <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-600 shrink-0" aria-hidden="true" />
                            <span class="font-mono text-[11px]">{{ $perm->name }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-500 italic">Belum ada permission khusus yang terpasang.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                <span class="text-xs font-semibold text-slate-500">
                    Peran: <strong class="text-slate-900">{{ Auth::user()->roles->pluck('name')->first() ?? '-' }}</strong>
                </span>
            </div>
        </section>

    </div>

</div>
@endsection
