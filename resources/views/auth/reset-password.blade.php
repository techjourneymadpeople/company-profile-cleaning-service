@extends('layouts.auth')

@section('title', 'Atur Ulang Kata Sandi')
@section('header-title', 'Atur Ulang Kata Sandi')
@section('header-subtitle', 'Masukkan kata sandi baru untuk akun Anda')

@section('content')
<form method="POST" action="{{ route('password.update') }}" class="space-y-5" novalidate>
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                value="{{ old('email', $request->email) }}"
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
        <label for="password" class="block text-sm font-semibold text-slate-800">
            Kata Sandi Baru <span class="text-rose-600" aria-hidden="true">*</span>
        </label>
        <div class="mt-1.5 relative">
            <input 
                id="password" 
                name="password" 
                type="password" 
                autocomplete="new-password" 
                required 
                aria-required="true"
                placeholder="Minimal 8 karakter"
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

    <!-- Password Confirmation -->
    <div>
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-800">
            Konfirmasi Kata Sandi Baru <span class="text-rose-600" aria-hidden="true">*</span>
        </label>
        <div class="mt-1.5 relative">
            <input 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                autocomplete="new-password" 
                required 
                aria-required="true"
                placeholder="Ulangi kata sandi baru"
                class="block w-full rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-emerald-500 px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 shadow-sm transition-colors"
            >
        </div>
    </div>

    <!-- Submit Button -->
    <div>
        <button 
            type="submit" 
            class="w-full flex justify-center items-center gap-2 py-3 px-4 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 shadow-md shadow-emerald-600/30 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 focus-visible:ring-offset-2 transition-all cursor-pointer"
        >
            <x-heroicon-o-check class="w-5 h-5" aria-hidden="true" />
            <span>Simpan Kata Sandi Baru</span>
        </button>
    </div>
</form>
@endsection
