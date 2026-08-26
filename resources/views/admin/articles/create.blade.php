@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru')
@section('header-title', 'Create Article')
@section('header-subtitle', 'Buat artikel edukasi kebersihan atau berita aktivitas perusahaan')

@section('content')
<div class="max-w-4xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Formulir Tulis Artikel</h2>
                <p class="text-xs text-slate-400">Lengkapi judul, kategori, dan isi artikel dengan editor visual</p>
            </div>
            <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Judul Artikel <span class="text-rose-500">*</span>
                </label>
                <input 
                    id="title" 
                    name="title" 
                    type="text" 
                    required 
                    value="{{ old('title') }}"
                    placeholder="Contoh: 5 Tips Menjaga Kebersihan Udara Ruang Kantor"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('title') ? 'border-rose-400 focus:border-rose-600' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('title') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Category, Slug & Status Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Kategori Artikel <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="category" 
                        name="category" 
                        required
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-3.5 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                        <option value="Edukasi Kebersihan" {{ old('category') === 'Edukasi Kebersihan' ? 'selected' : '' }}>Edukasi Kebersihan</option>
                        <option value="Berita Perusahaan" {{ old('category') === 'Berita Perusahaan' ? 'selected' : '' }}>Berita Perusahaan</option>
                        <option value="Tips & Trik Fasilitas" {{ old('category') === 'Tips & Trik Fasilitas' ? 'selected' : '' }}>Tips & Trik Fasilitas</option>
                    </select>
                </div>

                <div>
                    <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Slug URL (Otomatis)
                    </label>
                    <input 
                        id="slug" 
                        name="slug" 
                        type="text" 
                        value="{{ old('slug') }}"
                        placeholder="tips-kebersihan-kantor"
                        class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>

                <div>
                    <label for="status" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Status Publikasi <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="status" 
                        name="status" 
                        required
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-3.5 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Simpan Konsep)</option>
                    </select>
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Ringkasan Singkat (Excerpt)
                </label>
                <textarea 
                    id="excerpt" 
                    name="excerpt" 
                    rows="2" 
                    placeholder="Ringkasan 1-2 kalimat untuk snippet kartu artikel..."
                    class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >{{ old('excerpt') }}</textarea>
            </div>

            <!-- Content (CKEditor) -->
            <div>
                <label for="content" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                    Konten Artikel Lengkap <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="8" 
                    class="editor block w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-900"
                >{{ old('content') }}</textarea>
                @error('content') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Featured Image Upload -->
            <div>
                <label for="featured_image" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                    Gambar Sampul Utama (Featured Image)
                </label>
                <input 
                    id="featured_image" 
                    name="featured_image" 
                    type="file" 
                    accept="image/*"
                    class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#e2f4f1] file:text-[#24695c] hover:file:bg-[#24695c] hover:file:text-white file:transition-colors file:cursor-pointer"
                >
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.articles.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Simpan & Publikasikan</span>
                </button>
            </div>
        </form>

    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.ClassicEditor) {
            document.querySelectorAll('.editor').forEach(el => {
                ClassicEditor.create(el).catch(err => console.error(err));
            });
        }
    });
</script>
@endpush
@endsection
