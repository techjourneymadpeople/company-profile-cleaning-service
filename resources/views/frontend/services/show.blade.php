@extends('layouts.frontend')

@section('content')

<!-- Header Banner -->
<section aria-labelledby="service-detail-title" class="bg-[#0B3B60] text-white py-14 lg:py-20 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav aria-label="Breadcrumb" class="mb-4">
            <ol class="flex items-center gap-2 text-xs font-semibold text-cyan-200/80">
                <li><a href="{{ route('public.home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                <li><span>&rsaquo;</span></li>
                <li><a href="{{ route('public.services') }}" class="hover:text-white transition-colors">Layanan</a></li>
                <li><span>&rsaquo;</span></li>
                <li class="text-white" aria-current="page">{{ $service->name }}</li>
            </ol>
        </nav>

        <div class="flex items-center gap-3 mb-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-white/15 text-cyan-200 font-heading">
                {{ $service->category }}
            </span>
        </div>

        <h1 id="service-detail-title" class="text-3xl sm:text-4xl lg:text-5xl font-black font-heading tracking-tight">
            {{ $service->name }}
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-300 max-w-3xl leading-relaxed">
            {{ $service->excerpt }}
        </p>
    </div>
</section>

<!-- Content Grid: Main Description + Sidebar -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Main Content Column (8 Cols) -->
            <div class="lg:col-span-8 space-y-12">
                
                <!-- Main Service Featured Thumbnail -->
                @if($service->thumbnail)
                    <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-100 aspect-video bg-slate-100">
                        <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <!-- Rich Text Description -->
                <article class="prose prose-slate max-w-none prose-headings:font-heading prose-headings:text-[#0B3B60] prose-h2:text-2xl prose-h3:text-xl prose-p:text-slate-600 prose-p:leading-relaxed prose-li:text-slate-600">
                    <h2>Rincian & Cakupan Layanan</h2>
                    @if($service->description)
                        {!! $service->description !!}
                    @else
                        <p>Layanan <strong>{{ $service->name }}</strong> kami dilaksanakan oleh tenaga kerja terlatih dan berlisensi BNSP dengan menggunakan peralatan berstandar internasional serta chemical ramah lingkungan yang telah teruji efektivitasnya.</p>
                    @endif
                </article>

                <!-- Technical SOP / Benefit Checklist -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 space-y-5">
                    <h3 class="text-lg font-black text-[#0B3B60] font-heading">Standar Pengerjaan & Keunggulan Layanan:</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                            <span class="text-xs font-semibold text-slate-700">Tenaga kerja bersertifikat BNSP dan terlatih SOP ketat</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                            <span class="text-xs font-semibold text-slate-700">Chemical bersertifikat ramah lingkungan (Eco-Friendly)</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                            <span class="text-xs font-semibold text-slate-700">Supervisi berkala dan laporan inspeksi digital berkala</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                            <span class="text-xs font-semibold text-slate-700">Perlindungan jaminan kepuasan (SLA Guarantee 100%)</span>
                        </div>
                    </div>
                </div>

                <!-- Related Before & After Projects (If Any) -->
                @if($relatedProjects->isNotEmpty())
                    <section aria-labelledby="related-projects-heading" class="space-y-6 pt-4 border-t border-slate-100">
                        <h3 id="related-projects-heading" class="text-2xl font-black text-[#0B3B60] font-heading">
                            Galeri Hasil Kerja Terkait
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach($relatedProjects as $proj)
                                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                                    <div class="grid grid-cols-2 gap-2 mb-3">
                                        <div class="relative rounded-xl overflow-hidden aspect-[4/3] bg-slate-100">
                                            @if($proj->before_image)
                                                <img src="{{ asset('storage/' . $proj->before_image) }}" alt="Before" class="w-full h-full object-cover">
                                            @endif
                                            <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded text-[8px] font-black uppercase text-white bg-amber-600 font-heading">Before</span>
                                        </div>
                                        <div class="relative rounded-xl overflow-hidden aspect-[4/3] bg-slate-100">
                                            @if($proj->after_image)
                                                <img src="{{ asset('storage/' . $proj->after_image) }}" alt="After" class="w-full h-full object-cover">
                                            @endif
                                            <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded text-[8px] font-black uppercase text-white bg-emerald-600 font-heading">After</span>
                                        </div>
                                    </div>
                                    <h4 class="text-xs font-bold text-slate-900 font-heading">{{ $proj->title }}</h4>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

            </div>

            <!-- Right Column: Sidebar (4 Cols) -->
            <aside class="lg:col-span-4 space-y-8" aria-label="Sidebar Layanan">
                
                <!-- CTA Box: Minta Penawaran Layanan Ini -->
                <div class="bg-gradient-to-tr from-[#0B3B60] to-[#17629b] text-white p-8 rounded-3xl shadow-xl space-y-5 text-center sm:text-left">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 text-cyan-300 text-[10px] font-black uppercase tracking-widest font-heading">
                        Dapatkan Penawaran
                    </span>
                    <h3 class="text-xl font-black font-heading leading-tight">
                        Tertarik dengan Layanan {{ $service->name }}?
                    </h3>
                    <p class="text-xs text-slate-200 leading-relaxed">
                        Konsultasikan kebutuhan fasilitas Anda bersama konsultan kami secara gratis.
                    </p>
                    <div class="pt-2 space-y-3">
                        <a href="{{ route('public.contact', ['layanan' => $service->name]) }}" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full text-xs font-black uppercase text-[#0B3B60] bg-white hover:bg-slate-100 transition-all font-heading tracking-wider shadow-lg">
                            <span>Minta Penawaran (RFQ)</span>
                            <x-heroicon-o-arrow-right class="w-4 h-4" />
                        </a>
                        @if(app(\App\Settings\ContactSettings::class)->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', app(\App\Settings\ContactSettings::class)->whatsapp) }}?text={{ urlencode('Halo BersihPrima, saya ingin konsultasi mengenai layanan: ' . $service->name) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-full text-xs font-bold uppercase text-white bg-emerald-500 hover:bg-emerald-600 transition-all font-heading tracking-wider">
                                <span>WhatsApp CS</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Other Services List -->
                <div class="bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-100 space-y-4">
                    <h3 class="text-base font-black text-[#0B3B60] font-heading border-b border-slate-200 pb-3">
                        Layanan Lainnya
                    </h3>
                    <ul class="space-y-2">
                        @foreach($otherServices as $other)
                            <li>
                                <a href="{{ route('public.services.show', $other->slug) }}" class="flex items-center justify-between p-3 rounded-2xl bg-white hover:bg-[#e6f1f8] border border-slate-100 text-xs font-bold text-slate-700 hover:text-[#0B3B60] transition-colors group">
                                    <span>{{ $other->name }}</span>
                                    <x-heroicon-o-chevron-right class="w-4 h-4 text-slate-400 group-hover:text-[#0B3B60]" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </aside>

        </div>
    </div>
</div>

@endsection
