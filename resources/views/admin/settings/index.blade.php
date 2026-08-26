@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')
@section('header-title', 'System Settings')
@section('header-subtitle', 'Konfigurasi identitas perusahaan, kontak operasional, media sosial, dan optimasi SEO')

@section('content')
<div class="space-y-6">

    @php
        $activeTab = request()->query('tab', 'brand');
    @endphp

    <!-- Viho Tabs Navigation Bar -->
    <div class="bg-white p-2.5 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-wrap gap-2">
        
        <button type="button" onclick="switchTab('brand')" id="tab-btn-brand" class="tab-btn flex-1 sm:flex-none inline-flex items-center justify-center gap-2.5 px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all cursor-pointer font-heading {{ $activeTab === 'brand' ? 'bg-[#24695c] text-white shadow-md shadow-[#24695c]/25' : 'text-slate-600 hover:bg-[#e2f4f1]/60 hover:text-[#24695c]' }}">
            <x-heroicon-o-building-office class="w-4 h-4" aria-hidden="true" />
            <span>Identitas Brand</span>
        </button>

        <button type="button" onclick="switchTab('contact')" id="tab-btn-contact" class="tab-btn flex-1 sm:flex-none inline-flex items-center justify-center gap-2.5 px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all cursor-pointer font-heading {{ $activeTab === 'contact' ? 'bg-[#24695c] text-white shadow-md shadow-[#24695c]/25' : 'text-slate-600 hover:bg-[#e2f4f1]/60 hover:text-[#24695c]' }}">
            <x-heroicon-o-phone class="w-4 h-4" aria-hidden="true" />
            <span>Kontak & Operasional</span>
        </button>

        <button type="button" onclick="switchTab('social')" id="tab-btn-social" class="tab-btn flex-1 sm:flex-none inline-flex items-center justify-center gap-2.5 px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all cursor-pointer font-heading {{ $activeTab === 'social' ? 'bg-[#24695c] text-white shadow-md shadow-[#24695c]/25' : 'text-slate-600 hover:bg-[#e2f4f1]/60 hover:text-[#24695c]' }}">
            <x-heroicon-o-share class="w-4 h-4" aria-hidden="true" />
            <span>Media Sosial</span>
        </button>

        <button type="button" onclick="switchTab('seo')" id="tab-btn-seo" class="tab-btn flex-1 sm:flex-none inline-flex items-center justify-center gap-2.5 px-5 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all cursor-pointer font-heading {{ $activeTab === 'seo' ? 'bg-[#24695c] text-white shadow-md shadow-[#24695c]/25' : 'text-slate-600 hover:bg-[#e2f4f1]/60 hover:text-[#24695c]' }}">
            <x-heroicon-o-globe-alt class="w-4 h-4" aria-hidden="true" />
            <span>SEO & Metadata</span>
        </button>

    </div>

    <!-- Tab 1: Brand Settings -->
    <div id="tab-content-brand" class="tab-pane {{ $activeTab === 'brand' ? '' : 'hidden' }}">
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
            <div class="pb-5 border-b border-slate-100 mb-6">
                <h2 class="text-base font-bold text-slate-900 font-heading">Pengaturan Identitas Brand & Logo</h2>
                <p class="text-xs text-slate-400">Atur nama resmi website, tagline, serta logo dan favicon publik</p>
            </div>

            <form method="POST" action="{{ route('admin.settings.brand.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="site_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Nama Perusahaan / Brand <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            id="site_name" 
                            name="site_name" 
                            type="text" 
                            required 
                            value="{{ old('site_name', $brand->site_name) }}"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('site_name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="site_tagline" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Tagline / Slogan Perusahaan <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            id="site_tagline" 
                            name="site_tagline" 
                            type="text" 
                            required 
                            value="{{ old('site_tagline', $brand->site_tagline) }}"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('site_tagline') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="site_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Deskripsi Singkat Profil Perusahaan
                    </label>
                    <textarea 
                        id="site_description" 
                        name="site_description" 
                        rows="3" 
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >{{ old('site_description', $brand->site_description) }}</textarea>
                </div>

                <!-- Logo & Favicon Upload -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                    <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-200/70">
                        <label for="site_logo" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-2">
                            Upload Logo Perusahaan
                        </label>
                        @if($brand->site_logo)
                            <div class="mb-3 p-3 bg-white rounded-xl border border-slate-200 inline-block">
                                <img src="{{ asset('storage/' . $brand->site_logo) }}" alt="Logo Saat Ini" class="h-12 w-auto object-contain">
                            </div>
                        @endif
                        <input 
                            id="site_logo" 
                            name="site_logo" 
                            type="file" 
                            accept="image/*"
                            class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#e2f4f1] file:text-[#24695c] hover:file:bg-[#24695c] hover:file:text-white file:transition-colors file:cursor-pointer"
                        >
                        <p class="mt-1.5 text-[11px] text-slate-400">Format: PNG, JPG, SVG, WebP (Maks: 2MB).</p>
                        @error('site_logo') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-200/70">
                        <label for="site_favicon" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-2">
                            Upload Favicon Browser
                        </label>
                        @if($brand->site_favicon)
                            <div class="mb-3 p-3 bg-white rounded-xl border border-slate-200 inline-block">
                                <img src="{{ asset('storage/' . $brand->site_favicon) }}" alt="Favicon Saat Ini" class="h-8 w-8 object-contain">
                            </div>
                        @endif
                        <input 
                            id="site_favicon" 
                            name="site_favicon" 
                            type="file" 
                            accept="image/*,.ico"
                            class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#e2f4f1] file:text-[#24695c] hover:file:bg-[#24695c] hover:file:text-white file:transition-colors file:cursor-pointer"
                        >
                        <p class="mt-1.5 text-[11px] text-slate-400">Format: ICO, PNG, SVG (Maks: 1MB).</p>
                        @error('site_favicon') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                @can('setting.update')
                    <div class="pt-5 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                            <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                            <span>Simpan Identitas Brand</span>
                        </button>
                    </div>
                @endcan
            </form>
        </div>
    </div>

    <!-- Tab 2: Contact & Operational Settings -->
    <div id="tab-content-contact" class="tab-pane {{ $activeTab === 'contact' ? '' : 'hidden' }}">
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
            <div class="pb-5 border-b border-slate-100 mb-6">
                <h2 class="text-base font-bold text-slate-900 font-heading">Pengaturan Kontak & Jam Operasional</h2>
                <p class="text-xs text-slate-400">Kelola nomor telepon, WhatsApp, email, dan alamat kantor operasional</p>
            </div>

            <form method="POST" action="{{ route('admin.settings.contact.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Nomor Telepon Kantor <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            id="phone" 
                            name="phone" 
                            type="text" 
                            required 
                            value="{{ old('phone', $contact->phone) }}"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('phone') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="whatsapp" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            WhatsApp Resmi <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            id="whatsapp" 
                            name="whatsapp" 
                            type="text" 
                            required 
                            value="{{ old('whatsapp', $contact->whatsapp) }}"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('whatsapp') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Alamat Email Resmi <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            required 
                            value="{{ old('email', $contact->email) }}"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('email') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Alamat Lengkap Operasional <span class="text-rose-500">*</span>
                        </label>
                        <textarea 
                            id="address" 
                            name="address" 
                            rows="3" 
                            required 
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >{{ old('address', $contact->address) }}</textarea>
                        @error('address') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="operating_hours" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Jam Operasional Layanan <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            id="operating_hours" 
                            name="operating_hours" 
                            type="text" 
                            required 
                            value="{{ old('operating_hours', $contact->operating_hours) }}"
                            placeholder="Senin - Minggu: 08:00 - 20:00 WIB"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('operating_hours') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="google_maps_embed" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Google Maps Embed URL / Iframe
                    </label>
                    <input 
                        id="google_maps_embed" 
                        name="google_maps_embed" 
                        type="text" 
                        value="{{ old('google_maps_embed', $contact->google_maps_embed) }}"
                        placeholder="https://maps.google.com/..."
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                </div>

                @can('setting.update')
                    <div class="pt-5 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                            <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                            <span>Simpan Kontak & Operasional</span>
                        </button>
                    </div>
                @endcan
            </form>
        </div>
    </div>

    <!-- Tab 3: Social Media Settings -->
    <div id="tab-content-social" class="tab-pane {{ $activeTab === 'social' ? '' : 'hidden' }}">
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
            <div class="pb-5 border-b border-slate-100 mb-6">
                <h2 class="text-base font-bold text-slate-900 font-heading">Pengaturan Tautan Media Sosial</h2>
                <p class="text-xs text-slate-400">Tautkan akun media sosial resmi perusahaan untuk ditampilkan pada landing page</p>
            </div>

            <form method="POST" action="{{ route('admin.settings.social.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="instagram" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Instagram URL
                        </label>
                        <input 
                            id="instagram" 
                            name="instagram" 
                            type="url" 
                            value="{{ old('instagram', $social->instagram) }}"
                            placeholder="https://instagram.com/bersihsebagian"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('instagram') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="facebook" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Facebook URL
                        </label>
                        <input 
                            id="facebook" 
                            name="facebook" 
                            type="url" 
                            value="{{ old('facebook', $social->facebook) }}"
                            placeholder="https://facebook.com/bersihsebagian"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('facebook') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tiktok" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            TikTok URL
                        </label>
                        <input 
                            id="tiktok" 
                            name="tiktok" 
                            type="url" 
                            value="{{ old('tiktok', $social->tiktok) }}"
                            placeholder="https://tiktok.com/@bersihsebagian"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('tiktok') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="youtube" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            YouTube Channel URL
                        </label>
                        <input 
                            id="youtube" 
                            name="youtube" 
                            type="url" 
                            value="{{ old('youtube', $social->youtube) }}"
                            placeholder="https://youtube.com/@bersihsebagian"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('youtube') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="linkedin" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            LinkedIn Company URL
                        </label>
                        <input 
                            id="linkedin" 
                            name="linkedin" 
                            type="url" 
                            value="{{ old('linkedin', $social->linkedin) }}"
                            placeholder="https://linkedin.com/company/bersihsebagian"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('linkedin') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="twitter" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Twitter / X URL
                        </label>
                        <input 
                            id="twitter" 
                            name="twitter" 
                            type="url" 
                            value="{{ old('twitter', $social->twitter) }}"
                            placeholder="https://x.com/bersihsebagian"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('twitter') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                @can('setting.update')
                    <div class="pt-5 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                            <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                            <span>Simpan Media Sosial</span>
                        </button>
                    </div>
                @endcan
            </form>
        </div>
    </div>

    <!-- Tab 4: SEO & Metadata Settings -->
    <div id="tab-content-seo" class="tab-pane {{ $activeTab === 'seo' ? '' : 'hidden' }}">
        <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
            <div class="pb-5 border-b border-slate-100 mb-6">
                <h2 class="text-base font-bold text-slate-900 font-heading">Pengaturan SEO & Metadata Search Engine</h2>
                <p class="text-xs text-slate-400">Optimasi kata kunci, deskripsi pencarian Google, dan tautan canonical</p>
            </div>

            <form method="POST" action="{{ route('admin.settings.seo.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="meta_title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Default Meta Title Tag <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        id="meta_title" 
                        name="meta_title" 
                        type="text" 
                        required 
                        value="{{ old('meta_title', $seo->meta_title) }}"
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                    @error('meta_title') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="meta_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Default Meta Description <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        id="meta_description" 
                        name="meta_description" 
                        rows="3" 
                        required 
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >{{ old('meta_description', $seo->meta_description) }}</textarea>
                    @error('meta_description') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="meta_keywords" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Keywords (Pisahkan dengan koma)
                        </label>
                        <input 
                            id="meta_keywords" 
                            name="meta_keywords" 
                            type="text" 
                            value="{{ old('meta_keywords', $seo->meta_keywords) }}"
                            placeholder="cleaning service, cuci sofa, vacuum kasur"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                    </div>

                    <div>
                        <label for="canonical_url" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                            Canonical URL Utama
                        </label>
                        <input 
                            id="canonical_url" 
                            name="canonical_url" 
                            type="url" 
                            value="{{ old('canonical_url', $seo->canonical_url) }}"
                            placeholder="https://bersihsebagian.com"
                            class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                        >
                        @error('canonical_url') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                @can('setting.update')
                    <div class="pt-5 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                            <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                            <span>Simpan Pengaturan SEO</span>
                        </button>
                    </div>
                @endcan
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function switchTab(tabName) {
        // Hide all panes
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));
        // Show active pane
        const activeContent = document.getElementById('tab-content-' + tabName);
        if (activeContent) activeContent.classList.remove('hidden');

        // Reset all buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-[#24695c]', 'text-white', 'shadow-md', 'shadow-[#24695c]/25');
            btn.classList.add('text-slate-600', 'hover:bg-[#e2f4f1]/60', 'hover:text-[#24695c]');
        });

        // Highlight active button
        const activeBtn = document.getElementById('tab-btn-' + tabName);
        if (activeBtn) {
            activeBtn.classList.remove('text-slate-600', 'hover:bg-[#e2f4f1]/60', 'hover:text-[#24695c]');
            activeBtn.classList.add('bg-[#24695c]', 'text-white', 'shadow-md', 'shadow-[#24695c]/25');
        }

        // Update URL query state without full reload
        const newUrl = new URL(window.location);
        newUrl.searchParams.set('tab', tabName);
        window.history.replaceState({}, '', newUrl);
    }
</script>
@endpush
@endsection
