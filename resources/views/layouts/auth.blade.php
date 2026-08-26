<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Autentikasi') - {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'Bersih Sebagian Dari Iman' }}</title>

    <!-- Google Fonts: Montserrat & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
<body class="h-full min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-[#f5f7fb] text-slate-800 antialiased selection:bg-[#24695c] selection:text-white relative overflow-x-hidden">
    
    <!-- Background Decorative Gradient Blobs -->
    <div class="fixed top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-[#24695c]/10 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="fixed bottom-0 right-0 translate-x-1/3 translate-y-1/3 w-[500px] h-[500px] bg-[#ba895d]/10 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

    <!-- Accessibility Skip Link (WCAG 2.1 AA) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-[#24695c] focus:text-white focus:font-bold focus:rounded-xl focus:shadow-xl focus:outline-none">
        Lewati ke Konten Utama
    </a>

    <main id="main-content" class="w-full max-w-lg relative z-10 my-auto">
        <!-- Brand Header -->
        <header class="text-center mb-6">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3.5 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] focus-visible:ring-offset-2 rounded-2xl p-1.5" aria-label="Kembali ke Beranda">
                <div class="w-13 h-13 rounded-2xl bg-gradient-to-tr from-[#24695c] to-[#3a9686] flex items-center justify-center text-white shadow-lg shadow-[#24695c]/25 group-hover:scale-105 transition-transform duration-200">
                    <x-heroicon-o-sparkles class="w-7 h-7" aria-hidden="true" />
                </div>
                <div class="text-left">
                    <span class="block text-xl font-bold tracking-tight text-slate-900 font-heading">
                        {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'Bersih Sebagian' }}
                    </span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#e2f4f1] text-[#24695c] uppercase tracking-wider">
                        Admin Control Panel
                    </span>
                </div>
            </a>
        </header>

        <!-- Status Alerts -->
        @if (session('status'))
            <div role="status" aria-live="polite" class="mb-5 rounded-2xl bg-[#e2f4f1] border border-[#a2ded5] p-4 text-sm font-semibold text-[#164f45] flex items-center gap-3 shadow-sm">
                <x-heroicon-s-check-circle class="w-5 h-5 text-[#24695c] shrink-0" aria-hidden="true" />
                <div>{{ session('status') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div role="alert" aria-live="assertive" class="mb-5 rounded-2xl bg-rose-50 border border-rose-200 p-4 text-sm font-medium text-rose-900 shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-1.5 text-rose-950 font-heading">
                    <x-heroicon-s-exclamation-triangle class="w-5 h-5 text-rose-600 shrink-0" aria-hidden="true" />
                    <span>Periksa data yang Anda masukkan:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 pl-1 text-xs text-rose-800">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-white py-8 px-6 sm:px-10 shadow-[0_10px_35px_rgba(8,21,66,0.06)] rounded-3xl border border-slate-100/80">
            <div class="mb-6 text-center sm:text-left">
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 font-heading">
                    @yield('header-title', 'Masuk ke Akun Anda')
                </h1>
                <p class="mt-1 text-xs text-slate-500">
                    @yield('header-subtitle', 'Masukkan kredensial akun terdaftar Anda untuk melanjutkan')
                </p>
            </div>

            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-6 text-center text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} {{ app(\App\Settings\BrandSettings::class)->site_name ?? 'PT Bersih Sebagian Dari Iman' }}. All rights reserved.</p>
        </footer>
    </main>

</body>
</html>
