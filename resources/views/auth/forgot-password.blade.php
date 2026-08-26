@extends('layouts.auth')

@section('title', 'Lupa Kata Sandi')
@section('header-title', 'Pemulihan Kata Sandi')
@section('header-subtitle', 'Masukkan email terdaftar untuk menerima tautan reset kata sandi')

@section('content')
<form method="POST" action="{{ route('password.email') }}" class="space-y-5" novalidate>
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

    <!-- Submit Button -->
    <div>
        <button 
            type="submit" 
            class="w-full flex justify-center items-center gap-2 py-3 px-4 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 shadow-md shadow-emerald-600/30 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 focus-visible:ring-offset-2 transition-all cursor-pointer"
        >
            <x-heroicon-o-envelope class="w-5 h-5" aria-hidden="true" />
            <span>Kirim Tautan Reset Password</span>
        </button>
    </div>
</form>

<div class="mt-6 text-center text-xs text-slate-600">
    Ingat kata sandi Anda?
    <a href="{{ route('login') }}" class="font-bold text-emerald-700 hover:text-emerald-800 underline underline-offset-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 rounded px-1">
        Kembali ke Login
    </a>
</div>
@endsection
