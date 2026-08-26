@extends('layouts.admin')

@section('title', 'Edit Testimoni: ' . $testimonial->name)
@section('header-title', 'Edit Testimonial')
@section('header-subtitle', 'Perbarui ulasan kepuasan dan rating pelanggan')

@section('content')
<div class="max-w-2xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Edit Testimoni: {{ $testimonial->name }}</h2>
                <p class="text-xs text-slate-400">ID: #{{ $testimonial->id }}</p>
            </div>
            <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data" class="space-y-5" novalidate>
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Nama Klien / Tokoh <span class="text-rose-500">*</span>
                </label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    required 
                    value="{{ old('name', $testimonial->name) }}"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('name') ? 'border-rose-400 focus:border-rose-600' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Designation / Company & Rating Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="designation_company" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Jabatan & Instansi / Perusahaan
                    </label>
                    <input 
                        id="designation_company" 
                        name="designation_company" 
                        type="text" 
                        value="{{ old('designation_company', $testimonial->designation_company) }}"
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>

                <div>
                    <label for="rating" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Rating Bintang (1 - 5) <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="rating" 
                        name="rating" 
                        required
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-3.5 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                        <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang - Sempurna)</option>
                        <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang - Sangat Puas)</option>
                        <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang - Cukup Puas)</option>
                        <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>⭐⭐ (2 Bintang - Kurang Puas)</option>
                        <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>⭐ (1 Bintang - Tidak Puas)</option>
                    </select>
                </div>
            </div>

            <!-- Quote -->
            <div>
                <label for="quote" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Isi Ulasan / Kutipan Testimoni <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    id="quote" 
                    name="quote" 
                    rows="4" 
                    required 
                    class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >{{ old('quote', $testimonial->quote) }}</textarea>
                @error('quote') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Avatar Upload & Current Preview -->
            <div>
                <label for="avatar" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                    Foto Klien / Avatar (Opsional)
                </label>
                @if($testimonial->avatar)
                    <div class="mb-2 p-1.5 bg-slate-50 border border-slate-200 rounded-full inline-block">
                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="Avatar" class="h-12 w-12 rounded-full object-cover">
                    </div>
                @endif
                <input 
                    id="avatar" 
                    name="avatar" 
                    type="file" 
                    accept="image/*"
                    class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#e2f4f1] file:text-[#24695c] hover:file:bg-[#24695c] hover:file:text-white file:transition-colors file:cursor-pointer"
                >
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.testimonials.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Perbarui Testimoni</span>
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
