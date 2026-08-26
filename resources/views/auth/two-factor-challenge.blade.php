@extends('layouts.auth')

@section('title', 'Autentikasi Dua Faktor')
@section('header-title', 'Verifikasi Dua Faktor')
@section('header-subtitle', 'Masukkan kode autentikasi dari aplikasi authenticator Anda')

@section('content')
<form method="POST" action="{{ route('two-factor.login') }}" class="space-y-5" novalidate>
    @csrf

    <div id="code-container">
        <label for="code" class="block text-sm font-semibold text-slate-800">
            Kode Otentikasi (6 Digit) <span class="text-rose-600" aria-hidden="true">*</span>
        </label>
        <div class="mt-1.5 relative">
            <input 
                id="code" 
                name="code" 
                type="text" 
                inputmode="numeric" 
                autofocus 
                autocomplete="one-time-code" 
                placeholder="123456"
                class="block w-full rounded-xl text-center tracking-widest text-lg font-mono border {{ $errors->has('code') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-300 focus:border-emerald-600 focus:ring-emerald-500' }} px-3.5 py-2.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 shadow-sm transition-colors"
                @if($errors->has('code')) aria-invalid="true" aria-describedby="code-error" @endif
            >
        </div>
        @error('code')
            <p id="code-error" class="mt-1.5 text-xs font-medium text-rose-600 flex items-center gap-1">
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
            <x-heroicon-o-shield-check class="w-5 h-5" aria-hidden="true" />
            <span>Verifikasi dan Masuk</span>
        </button>
    </div>
</form>
@endsection
