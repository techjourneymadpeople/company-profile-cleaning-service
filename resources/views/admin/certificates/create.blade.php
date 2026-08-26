@extends('layouts.admin')

@section('title', 'Tambah Sertifikat Baru')
@section('header-title', 'Create Certificate')
@section('header-subtitle', 'Tambahkan sertifikat ISO, akreditasi, atau lisensi resmi')

@section('content')
<div class="max-w-2xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Formulir Tambah Sertifikat</h2>
                <p class="text-xs text-slate-400">Lengkapi data sertifikasi dan unggah foto dokumen lencana</p>
            </div>
            <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.certificates.store') }}" enctype="multipart/form-data" class="space-y-5" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Nama Sertifikat / Lisensi <span class="text-rose-500">*</span>
                </label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    required 
                    value="{{ old('name') }}"
                    placeholder="Contoh: ISO 9001:2015 Quality Management"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('name') ? 'border-rose-400 focus:border-rose-600' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Issuer & License Number Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="issuer" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Lembaga Penerbit
                    </label>
                    <input 
                        id="issuer" 
                        name="issuer" 
                        type="text" 
                        value="{{ old('issuer') }}"
                        placeholder="Contoh: Bureau Veritas / Sucofindo"
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>

                <div>
                    <label for="license_number" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Nomor Registrasi / Lisensi
                    </label>
                    <input 
                        id="license_number" 
                        name="license_number" 
                        type="text" 
                        value="{{ old('license_number') }}"
                        placeholder="Contoh: ID-QMS-2024-001"
                        class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>
            </div>

            <!-- Valid Until & Image Upload Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="valid_until" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Masa Berlaku (Hingga)
                    </label>
                    <input 
                        id="valid_until" 
                        name="valid_until" 
                        type="date" 
                        value="{{ old('valid_until') }}"
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all font-mono"
                    >
                </div>

                <div>
                    <label for="image" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                        Gambar Sertifikat / Lencana
                    </label>
                    <input 
                        id="image" 
                        name="image" 
                        type="file" 
                        accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#e2f4f1] file:text-[#24695c] hover:file:bg-[#24695c] hover:file:text-white file:transition-colors file:cursor-pointer"
                    >
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.certificates.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Simpan Sertifikat</span>
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
