@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')
@section('header-title', 'Create New User')
@section('header-subtitle', 'Buat akun pengguna baru dan tetapkan peran (role)')

@section('content')
<div class="max-w-3xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Formulir Tambah Pengguna</h2>
                <p class="text-xs text-slate-400">Lengkapi informasi akun dan pilih penugasan role</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Nama Lengkap <span class="text-rose-500" aria-hidden="true">*</span>
                </label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    required 
                    value="{{ old('name') }}"
                    placeholder="Contoh: Ahmad Wijaya"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('name') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('name')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Alamat Email <span class="text-rose-500" aria-hidden="true">*</span>
                </label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    required 
                    value="{{ old('email') }}"
                    placeholder="nama@bersihsebagian.com"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('email') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('email')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Kata Sandi <span class="text-rose-500" aria-hidden="true">*</span>
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        placeholder="Minimal 8 karakter"
                        class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('password') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Konfirmasi Kata Sandi <span class="text-rose-500" aria-hidden="true">*</span>
                    </label>
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        required 
                        placeholder="Ulangi kata sandi"
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>
            </div>

            <!-- User Assign to Role Section -->
            <div class="pt-4 border-t border-slate-100">
                <div class="flex items-center gap-2 mb-3">
                    <x-heroicon-o-shield-check class="w-5 h-5 text-[#24695c]" aria-hidden="true" />
                    <h3 class="text-sm font-bold text-slate-900 font-heading">Penugasan Peran (Assign To Role)</h3>
                </div>
                <p class="text-xs text-slate-500 mb-4">Pilih satu atau lebih role hak akses yang akan diberikan kepada pengguna ini:</p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                    @foreach($roles as $role)
                        <label class="relative flex items-center p-4 rounded-2xl border border-slate-200 hover:border-[#24695c] bg-slate-50/50 hover:bg-[#e2f4f1]/30 cursor-pointer transition-all">
                            <input 
                                type="checkbox" 
                                name="roles[]" 
                                value="{{ $role->name }}" 
                                {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-slate-300 text-[#24695c] focus:ring-[#24695c]"
                            >
                            <div class="ml-3">
                                <span class="block text-xs font-bold text-slate-900 font-heading">{{ $role->name }}</span>
                                <span class="block text-[10px] text-slate-400 font-mono">{{ $role->permissions->count() }} permissions</span>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('roles')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Simpan Pengguna</span>
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
