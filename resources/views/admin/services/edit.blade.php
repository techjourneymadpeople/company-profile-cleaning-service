@extends('layouts.admin')

@section('title', 'Edit Layanan: ' . $service->name)
@section('header-title', 'Edit Service')
@section('header-subtitle', 'Perbarui detail informasi paket layanan kebersihan')

@section('content')
<div class="max-w-4xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Edit Layanan: {{ $service->name }}</h2>
                <p class="text-xs text-slate-400">ID: #{{ $service->id }} • Kategori: {{ $service->category }}</p>
            </div>
            <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Nama Layanan <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        required 
                        value="{{ old('name', $service->name) }}"
                        class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('name') ? 'border-rose-400 focus:border-rose-600' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                    @error('name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Kategori Layanan <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="category" 
                        name="category" 
                        required
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-3.5 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                        <option value="Kebersihan" {{ old('category', $service->category) === 'Kebersihan' ? 'selected' : '' }}>Kebersihan (Cleaning)</option>
                        <option value="Keamanan & Higienitas" {{ old('category', $service->category) === 'Keamanan & Higienitas' ? 'selected' : '' }}>Keamanan & Higienitas</option>
                        <option value="Manajemen Fasilitas" {{ old('category', $service->category) === 'Manajemen Fasilitas' ? 'selected' : '' }}>Manajemen Fasilitas</option>
                    </select>
                </div>
            </div>

            <!-- Slug & Icon Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Slug URL
                    </label>
                    <input 
                        id="slug" 
                        name="slug" 
                        type="text" 
                        value="{{ old('slug', $service->slug) }}"
                        class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>

                <div>
                    <label for="icon" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Identifier Ikon (Heroicons)
                    </label>
                    <input 
                        id="icon" 
                        name="icon" 
                        type="text" 
                        value="{{ old('icon', $service->icon) }}"
                        class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Ringkasan Singkat (Excerpt Kartu Beranda)
                </label>
                <textarea 
                    id="excerpt" 
                    name="excerpt" 
                    rows="2" 
                    class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >{{ old('excerpt', $service->excerpt) }}</textarea>
            </div>

            <!-- Description (CKEditor) -->
            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                    Deskripsi Lengkap (Rich Text)
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="6" 
                    class="editor block w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-900"
                >{{ old('description', $service->description) }}</textarea>
            </div>

            <!-- Thumbnail Upload & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                <div>
                    <label for="thumbnail" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                        Gambar Thumbnail Layanan
                    </label>
                    @if($service->thumbnail)
                        <div class="mb-2 p-2 bg-slate-100 rounded-xl inline-block">
                            <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="Thumbnail" class="h-14 w-auto rounded-lg object-cover">
                        </div>
                    @endif
                    <input 
                        id="thumbnail" 
                        name="thumbnail" 
                        type="file" 
                        accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#e2f4f1] file:text-[#24695c] hover:file:bg-[#24695c] hover:file:text-white file:transition-colors file:cursor-pointer"
                    >
                </div>

                <div class="flex items-center pt-5">
                    <label class="inline-flex items-center cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="is_active" 
                            value="1" 
                            {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-[#24695c] focus:ring-[#24695c]"
                        >
                        <span class="ml-2.5 text-xs font-bold text-slate-800 select-none">Status Aktif (Tampilkan di Publik)</span>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.services.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Perbarui Layanan</span>
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
