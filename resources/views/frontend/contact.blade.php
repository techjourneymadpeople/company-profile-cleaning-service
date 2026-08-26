@extends('layouts.frontend')

@section('content')

@php
    $headerSection = $sections['header'] ?? null;
    $contactInfoSection = $sections['contact_info'] ?? null;
    $formSection = $sections['form_section'] ?? null;
    $mapSection = $sections['map_section'] ?? null;
@endphp

<!-- Header Banner -->
@if(!$headerSection || $headerSection->is_active)
    <section aria-labelledby="contact-page-title" class="bg-[#0B3B60] text-white py-14 lg:py-20 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav aria-label="Breadcrumb" class="mb-4">
                <ol class="flex items-center gap-2 text-xs font-semibold text-cyan-200/80">
                    <li><a href="{{ route('public.home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><span>&rsaquo;</span></li>
                    <li class="text-white" aria-current="page">Kontak Kami</li>
                </ol>
            </nav>

            @if($headerSection?->badge)
                <span class="inline-block text-[11px] font-black uppercase tracking-widest text-cyan-300 bg-white/10 px-3.5 py-1 rounded-full mb-3 font-heading">
                    {{ $headerSection->badge }}
                </span>
            @endif

            <h1 id="contact-page-title" class="text-3xl sm:text-4xl lg:text-5xl font-black font-heading tracking-tight">
                {{ $headerSection?->title ?? 'Kontak Kami & Permintaan Penawaran' }}
            </h1>
            <p class="mt-2 text-sm sm:text-base text-slate-300 max-w-2xl leading-relaxed">
                {{ $headerSection?->subtitle ?? 'Kami siap mendengar dan membantu Anda. Hubungi kami melalui informasi di bawah ini atau kirimkan formulir permohonan penawaran harga (RFQ).' }}
            </p>
        </div>
    </section>
@endif

<!-- Main Contact & RFQ Form Section -->
<section aria-label="Informasi Kontak dan Formulir" class="py-16 bg-slate-50/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Info Cards: Contact Information & Google Maps -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
            
            <!-- Contact Info Box (5 Cols) -->
            @if(!$contactInfoSection || $contactInfoSection->is_active)
                <div class="lg:col-span-5 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm space-y-6 flex flex-col justify-between">
                    <div>
                        <div class="mb-6 border-b border-slate-100 pb-3">
                            @if($contactInfoSection?->badge)
                                <span class="inline-block text-[10px] font-extrabold uppercase tracking-wider text-[#0B3B60] bg-[#e6f1f8] px-2.5 py-0.5 rounded-full font-heading mb-1.5">
                                    {{ $contactInfoSection->badge }}
                                </span>
                            @endif
                            <h2 class="text-xl font-black text-[#0B3B60] font-heading">
                                {{ $contactInfoSection?->title ?? 'Informasi Kontak' }}
                            </h2>
                            @if($contactInfoSection?->subtitle)
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $contactInfoSection->subtitle }}
                                </p>
                            @endif
                        </div>

                        <div class="space-y-6">
                            <!-- Alamat -->
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#e6f1f8] text-[#0B3B60] flex items-center justify-center shrink-0">
                                    <x-heroicon-o-map-pin class="w-5 h-5" aria-hidden="true" />
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">Alamat Kantor</h3>
                                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                        {{ $contact->address ?: 'Jl. Kebersihan No. 10, Sukajadi, Bandung, Jawa Barat 40161' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Telepon -->
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#e6f1f8] text-[#0B3B60] flex items-center justify-center shrink-0">
                                    <x-heroicon-o-phone class="w-5 h-5" aria-hidden="true" />
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">Telepon</h3>
                                    <p class="text-xs text-slate-600 mt-1 font-mono">
                                        {{ $contact->phone ?: '(022) 1234 5678' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#e6f1f8] text-[#0B3B60] flex items-center justify-center shrink-0">
                                    <x-heroicon-o-envelope class="w-5 h-5" aria-hidden="true" />
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">Email Resmi</h3>
                                    <p class="text-xs text-slate-600 mt-1">
                                        {{ $contact->email ?: 'info@bersihprima.co.id' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Jam Operasional -->
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-[#e6f1f8] text-[#0B3B60] flex items-center justify-center shrink-0">
                                    <x-heroicon-o-clock class="w-5 h-5" aria-hidden="true" />
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-slate-900 font-heading uppercase tracking-wider">Jam Operasional</h3>
                                    <p class="text-xs text-slate-600 mt-1">
                                        {{ $contact->operating_hours ?: 'Senin - Sabtu: 08:00 - 17:00 WIB' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($contact->whatsapp)
                        <div class="pt-4 border-t border-slate-100">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl text-xs font-black uppercase text-white bg-emerald-600 hover:bg-emerald-700 font-heading transition-colors shadow-md">
                                <span>Chat WhatsApp Langsung</span>
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Google Maps Embed Box (7 Cols or Full) -->
            @if(!$mapSection || $mapSection->is_active)
                <div class="{{ (!$contactInfoSection || $contactInfoSection->is_active) ? 'lg:col-span-7' : 'lg:col-span-12' }} bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm min-h-[350px] relative">
                    @if($contact->google_maps_embed)
                        {!! $contact->google_maps_embed !!}
                    @else
                        <iframe 
                            title="Lokasi Kantor Bersih Sebagian" 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862707!2d107.57311652136979!3d-6.903444341655169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
                            class="w-full h-full min-h-[380px] border-0" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    @endif
                </div>
            @endif

        </div>

        <!-- RFQ Form Card -->
        @if(!$formSection || $formSection->is_active)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-12">
                
                <!-- Left Side: Form (7 Cols) -->
                <div class="lg:col-span-7 p-8 sm:p-12 space-y-6">
                    <div>
                        @if($formSection?->badge)
                            <span class="inline-block text-[10px] font-extrabold uppercase tracking-wider text-[#0B3B60] bg-[#e6f1f8] px-2.5 py-0.5 rounded-full font-heading mb-1.5">
                                {{ $formSection->badge }}
                            </span>
                        @endif
                        <h2 class="text-2xl font-black text-[#0B3B60] font-heading">
                            {{ $formSection?->title ?? 'Kirim Pesan & Minta Penawaran (RFQ)' }}
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">
                            {{ $formSection?->subtitle ?? 'Punya pertanyaan atau ingin konsultasi kebutuhan cleaning properti Anda? Silakan isi form di bawah ini, tim kami akan segera merespons Anda.' }}
                        </p>
                    </div>

                    <!-- Flash Success Message -->
                    @if(session('success_inquiry'))
                        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-start gap-3">
                            <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                            <div>{{ session('success_inquiry') }}</div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('public.contact.submit') }}" class="space-y-4">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-700 font-heading mb-1">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                placeholder="Contoh: Budi Santoso" 
                                class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0B3B60] transition-all"
                            >
                            @error('name')
                                <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email & No. HP/WA (2 Cols) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-700 font-heading mb-1">
                                    Alamat Email <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    placeholder="email@perusahaan.com" 
                                    class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0B3B60] transition-all"
                                >
                                @error('email')
                                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-bold text-slate-700 font-heading mb-1">
                                    Nomor Telepon / WA <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}" 
                                    required 
                                    placeholder="0812-xxxx-xxxx" 
                                    class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0B3B60] transition-all"
                                >
                                @error('phone')
                                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Perusahaan & Layanan Diminta (2 Cols) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="company_name" class="block text-xs font-bold text-slate-700 font-heading mb-1">
                                    Nama Perusahaan / Instansi
                                </label>
                                <input 
                                    type="text" 
                                    id="company_name" 
                                    name="company_name" 
                                    value="{{ old('company_name') }}" 
                                    placeholder="PT Maju Bersama (Opsional)" 
                                    class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0B3B60] transition-all"
                                >
                            </div>

                            <div>
                                <label for="service_requested" class="block text-xs font-bold text-slate-700 font-heading mb-1">
                                    Layanan yang Diminta
                                </label>
                                <select 
                                    id="service_requested" 
                                    name="service_requested" 
                                    class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0B3B60] transition-all"
                                >
                                    <option value="">-- Pilih Layanan --</option>
                                    @foreach($services as $srv)
                                        <option value="{{ $srv->name }}" {{ (old('service_requested') === $srv->name || request('layanan') === $srv->name) ? 'selected' : '' }}>
                                            {{ $srv->name }} ({{ $srv->category }})
                                        </option>
                                    @endforeach
                                    <option value="Lainnya / Paket Khusus">Lainnya / Paket Khusus</option>
                                </select>
                            </div>
                        </div>

                        <!-- Pesan / Kebutuhan Detail -->
                        <div>
                            <label for="message" class="block text-xs font-bold text-slate-700 font-heading mb-1">
                                Pesan & Rincian Kebutuhan <span class="text-rose-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="4" 
                                required 
                                placeholder="Deskripsikan estimasi luas area, jenis bangunan, lokasi pengerjaan, atau pertanyaan spesifik Anda..." 
                                class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0B3B60] transition-all"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-2xl text-xs font-black uppercase tracking-wider text-white bg-[#0B3B60] hover:bg-[#07243B] shadow-lg shadow-[#0B3B60]/20 transition-all font-heading cursor-pointer">
                                <span>Kirim Pesan & Penawaran</span>
                                <x-heroicon-o-paper-airplane class="w-4 h-4 text-cyan-300" aria-hidden="true" />
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Side: Visual & Support Image -->
                <div class="lg:col-span-5 relative bg-slate-900 overflow-hidden flex flex-col justify-end min-h-[300px]">
                    @php
                        $formSectionImage = $formSection?->image ? (str_starts_with($formSection->image, 'http') ? $formSection->image : asset('storage/' . $formSection->image)) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=800&q=80';
                    @endphp
                    <img 
                        src="{{ $formSectionImage }}" 
                        alt="{{ $formSection?->title ?? 'Customer Support Bersih Sebagian' }}" 
                        class="absolute inset-0 w-full h-full object-cover opacity-60"
                    >
                    <div class="relative z-10 p-8 sm:p-10 bg-gradient-to-t from-[#0B3B60] via-[#0B3B60]/80 to-transparent text-white space-y-3">
                        <span class="text-[10px] font-black uppercase tracking-widest text-cyan-300 font-heading">
                            Bantuan Pelanggan
                        </span>
                        <h3 class="text-xl font-black font-heading leading-tight">
                            Pelayanan Cepat & Konsultasi Langsung
                        </h3>
                        <p class="text-xs text-slate-200 leading-relaxed">
                            Tim Customer Relations kami siap memberikan estimasi biaya awal dan jadwal survei lokasi gratis.
                        </p>
                    </div>
                </div>

            </div>
        @endif

        <!-- 3 Bottom Trust Badges -->
        <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-3xl bg-white border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-[#e6f1f8] text-[#0B3B60] flex items-center justify-center shrink-0">
                    <x-heroicon-o-bolt class="w-6 h-6" aria-hidden="true" />
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-[#0B3B60] font-heading">Respon Cepat</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kami akan merespons pesan & RFQ Anda dalam waktu < 2 jam kerja.</p>
                </div>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <x-heroicon-o-chat-bubble-bottom-center-text class="w-6 h-6" aria-hidden="true" />
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-[#0B3B60] font-heading">Konsultasi Gratis</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Dapatkan survei kebutuhan dan rancangan anggaran biaya (RAB) tanpa biaya.</p>
                </div>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-700 flex items-center justify-center shrink-0">
                    <x-heroicon-o-check-circle class="w-6 h-6" aria-hidden="true" />
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-[#0B3B60] font-heading">Solusi Tepat</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Penanganan disesuaikan secara presisi dengan kebutuhan higienitas gedung Anda.</p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
