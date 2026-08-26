@extends('layouts.auth')

@section('title', 'Lupa Kata Sandi')
@section('header-title', 'Reset Your Password')
@section('header-subtitle', 'Masukkan alamat email Anda untuk menerima tautan pembuatan kata sandi baru')

@section('content')
<form method="POST" action="{{ route('password.email') }}" class="space-y-5" novalidate>
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

    <!-- Submit Button -->
    <div>
        <button 
            type="submit" 
            class="w-full flex justify-center items-center gap-2.5 py-3.5 px-4 rounded-2xl text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] active:bg-[#154239] shadow-lg shadow-[#24695c]/25 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] focus-visible:ring-offset-2 transition-all cursor-pointer font-heading uppercase tracking-wider"
        >
            <x-heroicon-o-paper-airplane class="w-5 h-5" aria-hidden="true" />
            <span>Kirim Link Reset</span>
        </button>
    </div>
</form>

<div class="mt-6 text-center text-xs text-slate-500">
    Ingat kata sandi Anda?
    <a href="{{ route('login') }}" class="font-bold text-[#24695c] hover:text-[#1b5247] underline underline-offset-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] rounded px-1">
        Kembali ke Login
    </a>
</div>
@endsection
