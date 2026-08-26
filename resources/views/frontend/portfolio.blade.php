@extends('layouts.frontend')

@section('content')

@php
    $headerSection = $sections['header'] ?? null;
    $clientsIntroSection = $sections['clients_intro'] ?? null;
    $caseStudiesSection = $sections['case_studies_intro'] ?? null;
    $bottomCtaSection = $sections['bottom_cta'] ?? null;
@endphp

<!-- Header Banner -->
@if(!$headerSection || $headerSection->is_active)
    <section aria-labelledby="portfolio-page-title" class="bg-[#0B3B60] text-white py-14 lg:py-20 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav aria-label="Breadcrumb" class="mb-4">
                <ol class="flex items-center gap-2 text-xs font-semibold text-cyan-200/80">
                    <li><a href="{{ route('public.home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><span>&rsaquo;</span></li>
                    <li class="text-white" aria-current="page">Mitra & Portofolio</li>
                </ol>
            </nav>

            @if($headerSection?->badge)
                <span class="inline-block text-[11px] font-black uppercase tracking-widest text-cyan-300 bg-white/10 px-3.5 py-1 rounded-full mb-3 font-heading">
                    {{ $headerSection->badge }}
                </span>
            @endif

            <h1 id="portfolio-page-title" class="text-3xl sm:text-4xl lg:text-5xl font-black font-heading tracking-tight">
                {{ $headerSection?->title ?? 'Mitra Kami & Portofolio Proyek' }}
            </h1>
            <p class="mt-2 text-sm sm:text-base text-slate-300 max-w-2xl leading-relaxed">
                {{ $headerSection?->subtitle ?? 'Kami bangga bermitra dengan berbagai korporat, BUMN, dan institusi terkemuka untuk menjaga standar kebersihan fasilitas mereka.' }}
            </p>
        </div>
    </section>
@endif

<!-- Client Logos Section -->
@if(!$clientsIntroSection || $clientsIntroSection->is_active)
    <section aria-labelledby="clients-grid-heading" class="py-16 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                @if($clientsIntroSection?->badge ?? 'Trusted By')
                    <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-[#e6f1f8] px-3.5 py-1 rounded-full">
                        {{ $clientsIntroSection?->badge ?? 'Trusted By' }}
                    </span>
                @endif
                <h2 id="clients-grid-heading" class="mt-3 text-2xl sm:text-3xl font-black text-[#0B3B60] font-heading tracking-tight">
                    {{ $clientsIntroSection?->title ?? 'Deretan Klien & Mitra Korporat' }}
                </h2>
                @if($clientsIntroSection?->subtitle)
                    <p class="mt-2 text-sm text-slate-500">
                        {{ $clientsIntroSection->subtitle }}
                    </p>
                @endif
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 items-center">
                @foreach($clients as $client)
                    <div class="p-6 h-28 bg-slate-50/80 rounded-2xl border border-slate-100 flex items-center justify-center hover:bg-white hover:shadow-lg transition-all group">
                        @if($client->logo_path)
                            <img src="{{ asset('storage/' . $client->logo_path) }}" alt="{{ $client->name }}" class="max-h-14 max-w-full object-contain grayscale group-hover:grayscale-0 transition-all opacity-70 group-hover:opacity-100">
                        @else
                            <span class="text-xs font-black text-slate-700 font-heading text-center tracking-tight">{{ $client->name }}</span>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endif

<!-- Before & After Projects Gallery Section -->
@if(!$caseStudiesSection || $caseStudiesSection->is_active)
    <section aria-labelledby="case-studies-heading" class="py-20 bg-slate-50/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-14">
                @if($caseStudiesSection?->badge ?? 'Studi Kasus & Restorasi')
                    <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-[#e6f1f8] px-3.5 py-1 rounded-full">
                        {{ $caseStudiesSection?->badge ?? 'Studi Kasus & Restorasi' }}
                    </span>
                @endif
                <h2 id="case-studies-heading" class="mt-3 text-3xl sm:text-4xl font-black text-[#0B3B60] font-heading tracking-tight">
                    {{ $caseStudiesSection?->title ?? 'Galeri Hasil Kerja Sebelum & Sesudah' }}
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    {{ $caseStudiesSection?->subtitle ?? 'Dokumentasi transparansi hasil pengerjaan pembersihan mendalam tim kami di berbagai sektor properti.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $project)
                    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 p-6 flex flex-col justify-between">
                        <div>
                            <!-- Before & After Images -->
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-100 border border-slate-200">
                                    @if($project->before_image)
                                        <img src="{{ asset('storage/' . $project->before_image) }}" alt="Before" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=400&q=80" alt="Before" class="w-full h-full object-cover grayscale opacity-75">
                                    @endif
                                    <span class="absolute top-2 left-2 px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase text-white bg-amber-600 font-heading">Before</span>
                                </div>

                                <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-100 border border-slate-200">
                                    @if($project->after_image)
                                        <img src="{{ asset('storage/' . $project->after_image) }}" alt="After" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=400&q=80" alt="After" class="w-full h-full object-cover">
                                    @endif
                                    <span class="absolute top-2 left-2 px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase text-white bg-emerald-600 font-heading">After</span>
                                </div>
                            </div>

                            <span class="text-[10px] font-bold uppercase text-slate-400 font-heading">
                                {{ $project->category ?: ($project->service->name ?? 'Pembersihan Umum') }}
                            </span>
                            <h3 class="text-base font-extrabold text-[#0B3B60] font-heading mt-0.5">
                                {{ $project->title }}
                            </h3>
                            @if($project->description)
                                <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                                    {{ $project->description }}
                                </p>
                            @endif
                        </div>

                        @if($project->completed_at)
                            <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-400 font-mono">
                                Tanggal Selesai: {{ $project->completed_at->format('d M Y') }}
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-100">
                        <p class="text-sm text-slate-400">Belum ada portofolio yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Bottom CTA Box in Portfolio -->
            @if(!$bottomCtaSection || $bottomCtaSection->is_active)
                <div class="mt-16 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div>
                        @if($bottomCtaSection?->badge)
                            <span class="inline-block text-[10px] font-extrabold uppercase tracking-wider text-[#0B3B60] bg-[#e6f1f8] px-2.5 py-0.5 rounded-full font-heading mb-1.5">
                                {{ $bottomCtaSection->badge }}
                            </span>
                        @endif
                        <h2 class="text-lg sm:text-xl font-black text-[#0B3B60] font-heading">
                            {{ $bottomCtaSection?->title ?? 'Tertarik Menjadi Bagian dari Mitra Puas Kami?' }}
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">
                            {{ $bottomCtaSection?->subtitle ?? 'Dapatkan layanan cleaning berstandar internasional dengan survei lokasi dan konsultasi tanpa biaya.' }}
                        </p>
                    </div>
                    <a href="{{ $bottomCtaSection?->button_url ?: route('public.contact') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-xs font-extrabold uppercase tracking-wider text-white bg-[#0B3B60] hover:bg-[#07243B] shrink-0 font-heading shadow-md shadow-[#0B3B60]/20">
                        <span>{{ $bottomCtaSection?->button_text ?? 'Hubungi Tim Kami' }}</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 text-cyan-300" aria-hidden="true" />
                    </a>
                </div>
            @endif

        </div>
    </section>
@endif

@endsection
