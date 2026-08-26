@extends('layouts.admin')

@section('title', 'Tambah Angka Pencapaian Baru')
@section('header-title', 'Create Counter')
@section('header-subtitle', 'Tambahkan statistik pencapaian operasional')

@section('content')
<div class="max-w-xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Formulir Tambah Counter</h2>
                <p class="text-xs text-slate-400">Tentukan label deskripsi dan nilai angka</p>
            </div>
            <a href="{{ route('admin.statistics.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.statistics.store') }}" class="space-y-5" novalidate>
            @csrf

            <!-- Label -->
            <div>
                <label for="label" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Label Pencapaian <span class="text-rose-500">*</span>
                </label>
                <input 
                    id="label" 
                    name="label" 
                    type="text" 
                    required 
                    value="{{ old('label') }}"
                    placeholder="Contoh: Tenaga Kerja Aktif / Klien Korporat"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('label') ? 'border-rose-400 focus:border-rose-600' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('label') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Value & Sort Order Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="value" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Nilai Angka <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        id="value" 
                        name="value" 
                        type="text" 
                        required 
                        value="{{ old('value') }}"
                        placeholder="Contoh: 7000+ atau 99.8%"
                        class="mt-1.5 block w-full font-bold rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all font-heading"
                    >
                    @error('value') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="sort_order" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Urutan Tampil <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        id="sort_order" 
                        name="sort_order" 
                        type="number" 
                        min="0"
                        required 
                        value="{{ old('sort_order', 1) }}"
                        class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>
            </div>

            <!-- Icon -->
            <div>
                <label for="icon" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Identifier Ikon (Heroicons)
                </label>
                <input 
                    id="icon" 
                    name="icon" 
                    type="text" 
                    value="{{ old('icon', 'heroicon-o-chart-bar') }}"
                    placeholder="Contoh: heroicon-o-users atau heroicon-o-building-office"
                    class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.statistics.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Simpan Counter</span>
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
