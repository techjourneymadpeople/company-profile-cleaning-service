@extends('layouts.auth')

@section('title', 'Masuk ke Admin Panel')
@section('header-title', 'Sign In to Account')
@section('header-subtitle', 'Masukkan email dan kata sandi Anda untuk mengakses dashboard')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
            Alamat Email <span class="text-rose-500" aria-hidden="true">*</span>
        </label>
        <div class="mt-1.5 relative rounded-2xl shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <x-heroicon-o-envelope class="w-5 h-5 text-slate-400" aria-hidden="true" />
            </div>
            <input 
                id="email" 
                name="email" 
                type="email" 
                autocomplete="email" 
                required 
                aria-required="true"
                value="{{ old('email') }}"
                placeholder="nama@bersihsebagian.com"
                class="block w-full rounded-2xl border {{ $errors->has('email') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} pl-11 pr-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
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
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                Kata Sandi <span class="text-rose-500" aria-hidden="true">*</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-[#24695c] hover:text-[#1b5247] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] rounded px-1 underline-offset-2 hover:underline">
                    Lupa sandi?
                </a>
            @endif
        </div>
        <div class="mt-1.5 relative rounded-2xl shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <x-heroicon-o-lock-closed class="w-5 h-5 text-slate-400" aria-hidden="true" />
            </div>
            <input 
                id="password" 
                name="password" 
                type="password" 
                autocomplete="current-password" 
                required 
                aria-required="true"
                placeholder="••••••••"
                class="block w-full rounded-2xl border {{ $errors->has('password') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} pl-11 pr-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
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

    <!-- Remember Me Checkbox -->
    <div class="flex items-center">
        <input 
            id="remember" 
            name="remember" 
            type="checkbox" 
            class="h-4 w-4 rounded border-slate-300 text-[#24695c] focus:ring-[#24695c] focus:ring-2 cursor-pointer"
        >
        <label for="remember" class="ml-2.5 block text-xs font-medium text-slate-600 select-none cursor-pointer">
            Ingat sesi masuk di browser ini
        </label>
    </div>

    <!-- Submit Button (Viho Primary Theme) -->
    <div>
        <button 
            type="submit" 
            class="w-full flex justify-center items-center gap-2.5 py-3.5 px-4 rounded-2xl text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] active:bg-[#154239] shadow-lg shadow-[#24695c]/25 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] focus-visible:ring-offset-2 transition-all cursor-pointer font-heading uppercase tracking-wider"
        >
            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" aria-hidden="true" />
            <span>Sign In</span>
        </button>
    </div>
</form>

<!-- Demo Accounts Helper (Viho Pastel Card) -->
<div class="mt-6 pt-5 border-t border-slate-100 text-xs">
    <div class="flex items-center gap-2 text-slate-700 font-bold mb-2.5 font-heading">
        <span class="w-6 h-6 rounded-lg bg-[#e2f4f1] text-[#24695c] flex items-center justify-center">
            <x-heroicon-o-information-circle class="w-4 h-4" aria-hidden="true" />
        </span>
        <span>Akun Pengguna Demo:</span>
    </div>
    <div class="space-y-2 bg-[#f8fafc] p-3.5 rounded-2xl border border-slate-100">
        <div class="flex justify-between items-center text-slate-600">
            <span class="font-semibold text-slate-800">Super Admin:</span>
            <code class="text-[11px] bg-white px-2 py-0.5 rounded-md border border-slate-200 text-[#24695c]">superadmin@bersihsebagian.com</code>
        </div>
        <div class="flex justify-between items-center text-slate-600">
            <span class="font-semibold text-slate-800">Owner:</span>
            <code class="text-[11px] bg-white px-2 py-0.5 rounded-md border border-slate-200 text-[#24695c]">owner@bersihsebagian.com</code>
        </div>
        <div class="flex justify-between items-center text-slate-600">
            <span class="font-semibold text-slate-800">Admin Content:</span>
            <code class="text-[11px] bg-white px-2 py-0.5 rounded-md border border-slate-200 text-[#24695c]">admin@bersihsebagian.com</code>
        </div>
        <div class="pt-1.5 text-[11px] text-slate-400 border-t border-slate-200/60 mt-1 flex justify-between">
            <span>Password semua akun:</span>
            <code class="font-mono text-slate-700 font-bold">password</code>
        </div>
    </div>
</div>
@endsection
