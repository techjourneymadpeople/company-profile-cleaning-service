@extends('layouts.admin')

@section('title', 'Edit Galeri Proyek: ' . $project->title)
@section('header-title', 'Edit Project Gallery')
@section('header-subtitle', 'Perbarui dokumentasi foto komparasi dan informasi pengerjaan')

@section('content')
<div class="max-w-3xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Edit Proyek: {{ $project->title }}</h2>
                <p class="text-xs text-slate-400">ID: #{{ $project->id }}</p>
            </div>
            <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Judul Proyek <span class="text-rose-500">*</span>
                </label>
                <input 
                    id="title" 
                    name="title" 
                    type="text" 
                    required 
                    value="{{ old('title', $project->title) }}"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('title') ? 'border-rose-400 focus:border-rose-600' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('title') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Service & Category Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="service_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Layanan Terkait
                    </label>
                    <select 
                        id="service_id" 
                        name="service_id" 
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-3.5 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                        <option value="">-- Pilih Layanan (Opsional) --</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}" {{ old('service_id', $project->service_id) == $srv->id ? 'selected' : '' }}>
                                {{ $srv->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Kategori Pengerjaan
                    </label>
                    <input 
                        id="category" 
                        name="category" 
                        type="text" 
                        value="{{ old('category', $project->category) }}"
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>
            </div>

            <!-- Before & After Images Upload with Current Previews -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 p-5 rounded-3xl bg-slate-50/80 border border-slate-200/70">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-6 h-6 rounded-lg bg-amber-100 text-amber-800 text-[10px] font-black flex items-center justify-center">1</span>
                        <label for="before_image" class="block text-xs font-bold uppercase tracking-wider text-amber-800 font-heading">
                            Foto Sebelum (Before)
                        </label>
                    </div>
                    @if($project->before_image)
                        <div class="mb-2 p-2 bg-white rounded-xl inline-block border border-slate-200">
                            <img src="{{ asset('storage/' . $project->before_image) }}" alt="Before Saat Ini" class="h-16 w-auto rounded-lg object-cover">
                        </div>
                    @endif
                    <input 
                        id="before_image" 
                        name="before_image" 
                        type="file" 
                        accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 file:transition-colors file:cursor-pointer"
                    >
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-6 h-6 rounded-lg bg-emerald-100 text-[#24695c] text-[10px] font-black flex items-center justify-center">2</span>
                        <label for="after_image" class="block text-xs font-bold uppercase tracking-wider text-[#24695c] font-heading">
                            Foto Sesudah (After)
                        </label>
                    </div>
                    @if($project->after_image)
                        <div class="mb-2 p-2 bg-white rounded-xl inline-block border border-slate-200">
                            <img src="{{ asset('storage/' . $project->after_image) }}" alt="After Saat Ini" class="h-16 w-auto rounded-lg object-cover">
                        </div>
                    @endif
                    <input 
                        id="after_image" 
                        name="after_image" 
                        type="file" 
                        accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#e2f4f1] file:text-[#24695c] hover:file:bg-[#24695c] hover:file:text-white file:transition-colors file:cursor-pointer"
                    >
                </div>
            </div>

            <!-- Description & Completed Date -->
            <div class="space-y-4">
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Deskripsi Singkat Pengerjaan
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="3" 
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="max-w-xs">
                    <label for="completed_at" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Tanggal Selesai Pengerjaan
                    </label>
                    <input 
                        id="completed_at" 
                        name="completed_at" 
                        type="date" 
                        value="{{ old('completed_at', $project->completed_at ? $project->completed_at->format('Y-m-d') : '') }}"
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all font-mono"
                    >
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Perbarui Proyek</span>
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
