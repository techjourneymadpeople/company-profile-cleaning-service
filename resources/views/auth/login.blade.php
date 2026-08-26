@extends('layouts.auth')

@section('title', 'Masuk ke Admin Panel')
@section('header-title', 'Selamat Datang Kembali')
@section('header-subtitle', 'Silakan masuk dengan akun terdaftar Anda')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email" class="block text-sm font-semibold text-slate-800">
            Alamat Email <span class="text-rose-600" aria-hidden="true">*</span>
        </label>
        <div class="mt-1.5 relative">
            <input 
                id="email" 
                name="email" 
                type="email" 
                autocomplete="email" 
                required 
                aria-required="true"
                value="{{ old('email') }}"
                placeholder="nama@bersihsebagian.com"
                class="block w-full rounded-xl border {{ $errors->has('email') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-300 focus:border-emerald-600 focus:ring-emerald-500' }} px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 shadow-sm transition-colors"
                @if($errors->has('email')) aria-invalid="true" aria-describedby="email-error" @endif
            >
        </div>
        @error('email')
            <p id="email-error" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1">
                <x-heroicon-s-exclamation-circle class="w-4 h-4 shrink-0" aria-hidden="true" />
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-semibold text-slate-800">
                Kata Sandi <span class="text-rose-600" aria-hidden="true">*</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-emerald-700 hover:text-emerald-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 rounded px-1 underline-offset-2 hover:underline">
                    Lupa sandi?
                </a>
            @endif
        </div>
        <div class="mt-1.5 relative">
            <input 
                id="password" 
                name="password" 
                type="password" 
                autocomplete="current-password" 
                required 
                aria-required="true"
                placeholder="••••••••"
                class="block w-full rounded-xl border {{ $errors->has('password') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-300 focus:border-emerald-600 focus:ring-emerald-500' }} px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 shadow-sm transition-colors"
                @if($errors->has('password')) aria-invalid="true" aria-describedby="password-error" @endif
            >
        </div>
        @error('password')
            <p id="password-error" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1">
                <x-heroicon-s-exclamation-circle class="w-4 h-4 shrink-0" aria-hidden="true" />
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="flex items-center">
        <input 
            id="remember" 
            name="remember" 
            type="checkbox" 
            class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 focus:ring-2"
        >
        <label for="remember" class="ml-2.5 block text-sm text-slate-700 select-none cursor-pointer">
            Ingat saya di perangkat ini
        </label>
    </div>

    <!-- Submit Button -->
    <div>
        <button 
            type="submit" 
            class="w-full flex justify-center items-center gap-2 py-3 px-4 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 shadow-md shadow-emerald-600/30 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 focus-visible:ring-offset-2 transition-all cursor-pointer"
        >
            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" aria-hidden="true" />
            <span>Masuk ke Dashboard</span>
        </button>
    </div>
</form>

<!-- Demo Accounts Helper Box -->
<div class="mt-6 pt-5 border-t border-slate-200 text-xs text-slate-600">
    <p class="font-bold text-slate-800 mb-2 flex items-center gap-1.5">
        <x-heroicon-o-information-circle class="w-4 h-4 text-emerald-600" aria-hidden="true" />
        <span>Akun Demo Tersedia:</span>
    </p>
    <div class="space-y-1.5 bg-slate-50 p-3 rounded-lg border border-slate-200">
        <div class="flex justify-between items-center"><span class="font-semibold text-slate-800">Super Admin:</span> <code>superadmin@bersihsebagian.com</code></div>
        <div class="flex justify-between items-center"><span class="font-semibold text-slate-800">Owner:</span> <code>owner@bersihsebagian.com</code></div>
        <div class="flex justify-between items-center"><span class="font-semibold text-slate-800">Admin Content:</span> <code>admin@bersihsebagian.com</code></div>
        <div class="pt-1 text-[11px] text-slate-500 border-t border-slate-200 mt-1">Password semua akun: <code>password</code></div>
    </div>
</div>

@if (Route::has('register'))
    <div class="mt-5 text-center text-xs text-slate-600">
        Belum memiliki akun?
        <a href="{{ route('register') }}" class="font-bold text-emerald-700 hover:text-emerald-800 underline underline-offset-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 rounded px-1">
            Daftar akun baru
        </a>
    </div>
@endif
@endsection
