<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Autentikasi') - {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'Bersih Sebagian Dari Iman' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-50 via-emerald-50/40 to-teal-50/60 text-slate-900 antialiased selection:bg-emerald-600 selection:text-white">
    
    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-emerald-700 focus:text-white focus:rounded-lg focus:shadow-lg focus:outline-none">
        Lewati ke Konten Utama
    </a>

    <main id="main-content" class="sm:mx-auto sm:w-full sm:max-w-md px-4">
        <!-- Brand Header -->
        <header class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 focus-visible:ring-offset-2 rounded-xl p-1" aria-label="Kembali ke Beranda">
                <div class="w-12 h-12 rounded-2xl bg-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-600/30 group-hover:scale-105 transition-transform duration-200">
                    <x-heroicon-o-sparkles class="w-7 h-7" aria-hidden="true" />
                </div>
                <div class="text-left">
                    <span class="block text-xl font-bold tracking-tight text-slate-900 group-hover:text-emerald-700 transition-colors">Bersih Sebagian</span>
                    <span class="block text-xs font-semibold text-emerald-700 uppercase tracking-wider">Admin Portal System</span>
                </div>
            </a>
            <h1 class="mt-4 text-2xl font-extrabold tracking-tight text-slate-900">
                @yield('header-title', 'Masuk ke Akun Anda')
            </h1>
            <p class="mt-1.5 text-sm text-slate-600">
                @yield('header-subtitle', 'Sistem Manajemen Operasional & Layanan Cleaning')
            </p>
        </header>

        <!-- Status Alerts -->
        @if (session('status'))
            <div role="status" aria-live="polite" class="mb-6 rounded-xl bg-emerald-50 border border-emerald-300 p-4 text-sm font-medium text-emerald-900 flex items-start gap-3 shadow-sm">
                <x-heroicon-o-check-circle class="w-5 h-5 text-emerald-700 shrink-0 mt-0.5" aria-hidden="true" />
                <div>{{ session('status') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div role="alert" aria-live="assertive" class="mb-6 rounded-xl bg-rose-50 border border-rose-300 p-4 text-sm font-medium text-rose-900 shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-1 text-rose-950">
                    <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-rose-700" aria-hidden="true" />
                    <span>Terjadi kesalahan pada data yang dimasukkan:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 pl-1 text-xs text-rose-800">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-white py-8 px-6 shadow-xl shadow-slate-200/60 rounded-2xl sm:px-10 border border-slate-200/80">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-8 text-center text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} PT Bersih Sebagian Dari Iman. All rights reserved.</p>
        </footer>
    </main>

</body>
</html>
