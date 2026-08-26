@extends('layouts.admin')

@section('title', 'Edit Section: ' . $pageSection->section_name)
@section('header-title', 'Edit Section Konten')
@section('header-subtitle', 'Sesuaikan teks, gambar, dan elemen pada ' . ($pageMeta['name'] ?? 'halaman publik'))

@section('content')
<div class="space-y-6">

    <!-- Top Action & Navigation Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.page-sections.index', ['page' => $pageSection->page_key]) }}" class="w-10 h-10 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors" title="Kembali ke Daftar Section">
                <x-heroicon-o-arrow-left class="w-5 h-5" />
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-[#24695c] font-heading bg-[#e2f4f1] px-2.5 py-0.5 rounded-md">
                        {{ $pageMeta['name'] ?? ucfirst($pageSection->page_key) }}
                    </span>
                    <span class="text-xs text-slate-400 font-mono">key: {{ $pageSection->section_key }}</span>
                </div>
                <h2 class="text-lg font-extrabold text-slate-900 font-heading mt-0.5">
                    {{ $pageSection->section_name }}
                </h2>
            </div>
        </div>

        <!-- Sibling Sections Quick Dropdown Switcher -->
        <div class="flex items-center gap-2">
            <label for="sibling-switcher" class="text-xs font-bold text-slate-400 uppercase font-heading hidden sm:inline">Pindah Section:</label>
            <select id="sibling-switcher" onchange="if (this.value) window.location.href=this.value" class="text-xs font-semibold bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 focus:ring-2 focus:ring-[#24695c] focus:outline-none">
                @foreach($siblingSections as $sibling)
                    <option value="{{ route('admin.page-sections.edit', $sibling) }}" {{ $sibling->id === $pageSection->id ? 'selected' : '' }}>
                        #{{ $sibling->sort_order }} {{ $sibling->section_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Alert Notification -->
    @if(session('status'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-medium flex items-center gap-3 shadow-xs">
            <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
            <span>{{ session('status') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-medium space-y-1">
            <div class="font-bold flex items-center gap-2">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-rose-600" />
                <span>Terjadi kesalahan pada input form:</span>
            </div>
            <ul class="list-disc list-inside pl-2 space-y-0.5 text-xs text-rose-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Edit Form -->
    <form action="{{ route('admin.page-sections.update', $pageSection) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left 8 Columns: Content Fields -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- Card 1: Primary Typography & Texts -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] space-y-5">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">
                            Teks Utama & Heading Section
                        </h3>
                        <p class="text-xs text-slate-400">Sesuaikan judul, badge, dan deskripsi pengantar pada section ini</p>
                    </div>

                    <!-- Badge Field -->
                    <div>
                        <label for="badge" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                            Badge / Label Mini (Opsional)
                        </label>
                        <input type="text" name="badge" id="badge" value="{{ old('badge', $pageSection->badge) }}" placeholder="Contoh: CLEAN SPACE, BETTER LIFE atau JAMINAN MUTU RESMI" class="w-full px-4 py-2.5 rounded-2xl text-sm border border-slate-200 focus:border-[#24695c] focus:ring-2 focus:ring-[#24695c]/20 outline-none transition-all">
                        <span class="text-[11px] text-slate-400 mt-1 block">Badge kecil yang tampil di atas judul utama</span>
                    </div>

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                            Judul Utama Section
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $pageSection->title) }}" placeholder="Masukkan judul utama section..." class="w-full px-4 py-2.5 rounded-2xl text-sm border border-slate-200 focus:border-[#24695c] focus:ring-2 focus:ring-[#24695c]/20 outline-none font-bold text-slate-900 transition-all">
                    </div>

                    <!-- Subtitle Field -->
                    <div>
                        <label for="subtitle" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                            Subjudul / Deskripsi Pendukung
                        </label>
                        <textarea name="subtitle" id="subtitle" rows="3" placeholder="Masukkan deskripsi pendukung atau subjudul..." class="w-full px-4 py-2.5 rounded-2xl text-sm border border-slate-200 focus:border-[#24695c] focus:ring-2 focus:ring-[#24695c]/20 outline-none transition-all leading-relaxed">{{ old('subtitle', $pageSection->subtitle) }}</textarea>
                    </div>

                    <!-- Body Field (if applicable) -->
                    @if($pageSection->section_key === 'content' || $pageSection->body)
                        <div>
                            <label for="body" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-1.5">
                                Konten Paragraf Lengkap (Body)
                            </label>
                            <textarea name="body" id="body" rows="6" class="w-full px-4 py-2.5 rounded-2xl text-sm border border-slate-200 focus:border-[#24695c] focus:ring-2 focus:ring-[#24695c]/20 outline-none transition-all leading-relaxed">{{ old('body', $pageSection->body) }}</textarea>
                        </div>
                    @endif
                </div>

                <!-- Card 2: CTA Action Buttons (If Section supports buttons) -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] space-y-5">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">
                            Tombol Aksi (Call To Action / CTA)
                        </h3>
                        <p class="text-xs text-slate-400">Kosongkan jika section ini tidak memerlukan tombol navigasi</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Primary Button -->
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 space-y-3">
                            <span class="text-xs font-black uppercase tracking-wider text-[#24695c] font-heading block">
                                Tombol Utama (Primary CTA)
                            </span>
                            <div>
                                <label for="button_text" class="block text-[11px] font-bold text-slate-600 mb-1">Teks Tombol</label>
                                <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $pageSection->button_text) }}" placeholder="Contoh: Lihat Layanan Kami" class="w-full px-3 py-2 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c] focus:outline-none">
                            </div>
                            <div>
                                <label for="button_url" class="block text-[11px] font-bold text-slate-600 mb-1">Tautan / URL Tujuan</label>
                                <input type="text" name="button_url" id="button_url" value="{{ old('button_url', $pageSection->button_url) }}" placeholder="Contoh: /layanan atau https://..." class="w-full px-3 py-2 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c] focus:outline-none font-mono">
                            </div>
                        </div>

                        <!-- Secondary Button -->
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 space-y-3">
                            <span class="text-xs font-black uppercase tracking-wider text-slate-600 font-heading block">
                                Tombol Sekunder (Secondary CTA)
                            </span>
                            <div>
                                <label for="secondary_button_text" class="block text-[11px] font-bold text-slate-600 mb-1">Teks Tombol</label>
                                <input type="text" name="secondary_button_text" id="secondary_button_text" value="{{ old('secondary_button_text', $pageSection->secondary_button_text) }}" placeholder="Contoh: Minta Penawaran Harga" class="w-full px-3 py-2 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c] focus:outline-none">
                            </div>
                            <div>
                                <label for="secondary_button_url" class="block text-[11px] font-bold text-slate-600 mb-1">Tautan / URL Tujuan</label>
                                <input type="text" name="secondary_button_url" id="secondary_button_url" value="{{ old('secondary_button_url', $pageSection->secondary_button_url) }}" placeholder="Contoh: /kontak" class="w-full px-3 py-2 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c] focus:outline-none font-mono">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Dynamic Structured Data (Cards, Trust Points, Badges) -->
                @if($pageSection->section_key === 'hero')
                    <!-- Hero Specific Items: Trust Points & Floating Glass Badge -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] space-y-5">
                        <div class="border-b border-slate-100 pb-3">
                            <h3 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">
                                Elemen Khusus Hero Banner
                            </h3>
                            <p class="text-xs text-slate-400">Trust checklist dan badge melayang di atas gambar hero</p>
                        </div>

                        <!-- Trust Points -->
                        <div class="space-y-3">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                                Trust Points (2 Poin Kepercayaan)
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <input type="text" name="data[trust_points][0]" value="{{ old('data.trust_points.0', $pageSection->data['trust_points'][0] ?? 'Sertifikasi ISO 9001') }}" placeholder="Poin 1 (misal: Sertifikasi ISO 9001)" class="w-full px-3 py-2 rounded-xl text-xs border border-slate-200 focus:ring-2 focus:ring-[#24695c]">
                                </div>
                                <div>
                                    <input type="text" name="data[trust_points][1]" value="{{ old('data.trust_points.1', $pageSection->data['trust_points'][1] ?? 'Tenaga Kerja BNSP') }}" placeholder="Poin 2 (misal: Tenaga Kerja BNSP)" class="w-full px-3 py-2 rounded-xl text-xs border border-slate-200 focus:ring-2 focus:ring-[#24695c]">
                                </div>
                            </div>
                        </div>

                        <!-- Floating Glass Badge on Image -->
                        <div class="pt-3 border-t border-slate-100 space-y-3">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                                Floating Glass Badge (Badge Melayang pada Gambar)
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Judul Badge</label>
                                    <input type="text" name="data[floating_badge_title]" value="{{ old('data.floating_badge_title', $pageSection->data['floating_badge_title'] ?? 'Garansi Kebersihan 100%') }}" class="w-full px-3 py-2 rounded-xl text-xs border border-slate-200 focus:ring-2 focus:ring-[#24695c]">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Subjudul / Keterangan</label>
                                    <input type="text" name="data[floating_badge_subtitle]" value="{{ old('data.floating_badge_subtitle', $pageSection->data['floating_badge_subtitle'] ?? 'Standar higienitas tinggi & chemical ramah lingkungan') }}" class="w-full px-3 py-2 rounded-xl text-xs border border-slate-200 focus:ring-2 focus:ring-[#24695c]">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($pageSection->section_key === 'usp')
                    <!-- USP 3 Cards Editor -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] space-y-5">
                        <div class="border-b border-slate-100 pb-3">
                            <h3 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">
                                3 Kartu Nilai Unggulan (Value Proposition)
                            </h3>
                            <p class="text-xs text-slate-400">Ubah judul dan deskripsi dari 3 kartu keunggulan utama</p>
                        </div>

                        <div class="space-y-4">
                            @for($i = 0; $i < 3; $i++)
                                @php
                                    $card = $pageSection->data['cards'][$i] ?? ['icon' => 'heroicon-o-shield-check', 'title' => '', 'description' => ''];
                                @endphp
                                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                                    <span class="text-xs font-black uppercase text-[#24695c] font-heading block">
                                        Kartu Keunggulan #{{ $i + 1 }}
                                    </span>
                                    <input type="hidden" name="data[cards][{{ $i }}][icon]" value="{{ $card['icon'] ?? 'heroicon-o-shield-check' }}">
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Judul Kartu</label>
                                        <input type="text" name="data[cards][{{ $i }}][title]" value="{{ old("data.cards.{$i}.title", $card['title']) }}" placeholder="Judul keunggulan..." class="w-full px-3 py-2 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c] font-bold">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Deskripsi Singkat</label>
                                        <textarea name="data[cards][{{ $i }}][description]" rows="2" placeholder="Deskripsi keunggulan..." class="w-full px-3 py-2 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c]">{{ old("data.cards.{$i}.description", $card['description']) }}</textarea>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                @elseif($pageSection->section_key === 'why_us')
                    <!-- Why Us 4 Cards Editor -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] space-y-5">
                        <div class="border-b border-slate-100 pb-3">
                            <h3 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">
                                4 Pilar "Mengapa Memilih Kami"
                            </h3>
                            <p class="text-xs text-slate-400">Kelola 4 kartu pilar keunggulan perusahaan</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @for($i = 0; $i < 4; $i++)
                                @php
                                    $card = $pageSection->data['cards'][$i] ?? ['badge' => '', 'title' => '', 'description' => ''];
                                @endphp
                                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black uppercase text-[#24695c] font-heading">
                                            Pilar #{{ $i + 1 }}
                                        </span>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">Badge Tag</label>
                                        <input type="text" name="data[cards][{{ $i }}][badge]" value="{{ old("data.cards.{$i}.badge", $card['badge']) }}" placeholder="Contoh: Standar Global" class="w-full px-3 py-1.5 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c]">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">Judul Pilar</label>
                                        <input type="text" name="data[cards][{{ $i }}][title]" value="{{ old("data.cards.{$i}.title", $card['title']) }}" placeholder="Judul pilar..." class="w-full px-3 py-1.5 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c] font-bold">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">Deskripsi</label>
                                        <textarea name="data[cards][{{ $i }}][description]" rows="3" placeholder="Deskripsi..." class="w-full px-3 py-1.5 rounded-xl text-xs bg-white border border-slate-200 focus:ring-2 focus:ring-[#24695c]">{{ old("data.cards.{$i}.description", $card['description']) }}</textarea>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endif

            </div>

            <!-- Right 4 Columns: Media, Visibility & Save Actions -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Save Action Card (Sticky) -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] space-y-5 sticky top-6">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider">
                            Status & Publikasi
                        </h3>
                    </div>

                    <!-- Visibility Active Toggle -->
                    <div class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 border border-slate-200/70">
                        <div>
                            <span class="text-xs font-bold text-slate-900 font-heading block">Tayangkan Section</span>
                            <span class="text-[10px] text-slate-400">Aktifkan untuk menampilkan di website publik</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $pageSection->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#24695c]"></div>
                        </label>
                    </div>

                    <!-- Section Name & Order -->
                    <div class="space-y-3">
                        <div>
                            <label for="section_name" class="block text-[11px] font-bold uppercase text-slate-600 mb-1">
                                Nama Section (Admin Label)
                            </label>
                            <input type="text" name="section_name" id="section_name" value="{{ old('section_name', $pageSection->section_name) }}" required class="w-full px-3 py-2 rounded-xl text-xs border border-slate-200 focus:ring-2 focus:ring-[#24695c]">
                        </div>
                        <div>
                            <label for="sort_order" class="block text-[11px] font-bold uppercase text-slate-600 mb-1">
                                Urutan Tampil (Sort Order)
                            </label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $pageSection->sort_order) }}" class="w-full px-3 py-2 rounded-xl text-xs border border-slate-200 focus:ring-2 focus:ring-[#24695c]">
                        </div>
                    </div>

                    <!-- Save & Cancel Buttons -->
                    <div class="pt-3 border-t border-slate-100 flex flex-col gap-2.5">
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all font-heading uppercase tracking-wider cursor-pointer">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-teal-200" />
                            <span>Simpan Perubahan</span>
                        </button>
                        <a href="{{ route('admin.page-sections.index', ['page' => $pageSection->page_key]) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all font-heading text-center">
                            <span>Batal & Kembali</span>
                        </a>
                    </div>
                </div>

                <!-- Image / Media Card -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] space-y-4">
                    <div class="border-b border-slate-100 pb-3">
                        <h3 class="text-sm font-bold text-slate-900 font-heading uppercase tracking-wider flex items-center gap-2">
                            <x-heroicon-o-photo class="w-4 h-4 text-[#24695c]" />
                            <span>Thumbnail / Gambar Section</span>
                        </h3>
                        <p class="text-xs text-slate-400">Upload thumbnail atau banner visual untuk section ini</p>
                    </div>

                    <!-- Image Preview Area (Always present) -->
                    @php
                        $hasImage = !empty($pageSection->image);
                        $imgSrc = $hasImage ? (str_starts_with($pageSection->image, 'http') ? $pageSection->image : asset('storage/' . $pageSection->image)) : '';
                    @endphp

                    <div id="image-preview-container" class="{{ $hasImage ? '' : 'hidden' }} space-y-2">
                        <span class="text-[11px] font-bold text-slate-600 block">Preview Thumbnail Saat Ini:</span>
                        <div class="relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-900/5 aspect-video flex items-center justify-center group shadow-inner">
                            <img id="current-image-preview" src="{{ $imgSrc }}" alt="Preview Gambar Section" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">
                                Gambar Thumbnail Aktif
                            </div>
                        </div>
                    </div>

                    <div id="image-empty-placeholder" class="{{ $hasImage ? 'hidden' : '' }} p-6 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 flex flex-col items-center justify-center text-center">
                        <div class="w-10 h-10 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-2">
                            <x-heroicon-o-photo class="w-6 h-6" />
                        </div>
                        <span class="text-xs font-bold text-slate-600 font-heading">Belum Ada Thumbnail</span>
                        <span class="text-[11px] text-slate-400 mt-0.5">Pilih file di bawah untuk menambahkan gambar</span>
                    </div>

                    <!-- Upload Input Form -->
                    <div class="space-y-1.5">
                        <label for="image_file" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            {{ $hasImage ? 'Ganti File Gambar' : 'Pilih File Gambar' }}
                        </label>
                        <input 
                            type="file" 
                            name="image_file" 
                            id="image_file" 
                            accept="image/jpeg,image/png,image/webp,image/svg+xml" 
                            onchange="previewSelectedImage(event)" 
                            class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#e2f4f1] file:text-[#24695c] hover:file:bg-[#24695c] hover:file:text-white file:transition-all cursor-pointer bg-slate-50 border border-slate-200 rounded-2xl p-1.5"
                        >
                        <span class="text-[10px] text-slate-400 block">Format: JPG, PNG, WEBP, SVG (Maksimal 4 MB)</span>
                        @error('image_file')
                            <p class="text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- External Image URL input fallback -->
                    <div class="pt-3 border-t border-slate-100 space-y-1">
                        <label for="image" class="block text-[11px] font-bold text-slate-600">
                            Atau Masukkan URL Gambar (Opsional):
                        </label>
                        <input 
                            type="text" 
                            name="image" 
                            id="image" 
                            value="{{ old('image', $pageSection->image) }}" 
                            oninput="previewUrlImage(this.value)"
                            placeholder="https://images.unsplash.com/photo-..." 
                            class="w-full px-3 py-2 rounded-xl text-xs border border-slate-200 focus:ring-2 focus:ring-[#24695c] font-mono text-slate-700 bg-slate-50/50 focus:bg-white"
                        >
                    </div>
                </div>

            </div>

        </div>
    </form>

</div>

@push('scripts')
<script>
function previewSelectedImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const container = document.getElementById('image-preview-container');
            const img = document.getElementById('current-image-preview');
            const placeholder = document.getElementById('image-empty-placeholder');
            if (img) {
                img.src = e.target.result;
            }
            if (container) {
                container.classList.remove('hidden');
            }
            if (placeholder) {
                placeholder.classList.add('hidden');
            }
        };
        reader.readAsDataURL(file);
    }
}

function previewUrlImage(url) {
    const container = document.getElementById('image-preview-container');
    const img = document.getElementById('current-image-preview');
    const placeholder = document.getElementById('image-empty-placeholder');
    if (url && url.trim() !== '') {
        if (img) {
            img.src = url.trim();
        }
        if (container) {
            container.classList.remove('hidden');
        }
        if (placeholder) {
            placeholder.classList.add('hidden');
        }
    }
}
</script>
@endpush
@endsection
