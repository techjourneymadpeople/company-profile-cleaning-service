@extends('layouts.admin')

@section('title', 'Tambah Permission Baru')
@section('header-title', 'Create New Permission')
@section('header-subtitle', 'Tambahkan izin akses baru dengan format dot-notation')

@section('content')
<div class="max-w-xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Formulir Tambah Permission</h2>
                <p class="text-xs text-slate-400">Gunakan format standar seperti <code>modul.aksi</code></p>
            </div>
            <a href="{{ route('admin.permissions.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.permissions.store') }}" class="space-y-6" novalidate>
            @csrf

            <!-- Permission Name -->
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Nama Identifier Permission <span class="text-rose-500" aria-hidden="true">*</span>
                </label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    required 
                    value="{{ old('name') }}"
                    placeholder="Contoh: blog.create atau report.view"
                    class="mt-1.5 block w-full font-mono rounded-2xl border {{ $errors->has('name') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                <p class="mt-1.5 text-[11px] text-slate-400">Rekomendasi format: <code>modul.aksi</code> (huruf kecil tanpa spasi).</p>
                @error('name')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.permissions.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Simpan Permission</span>
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
