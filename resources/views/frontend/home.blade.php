@extends('layouts.frontend')

@section('content')

<!-- 1. Hero Banner Section -->
<section aria-labelledby="hero-title" class="relative overflow-hidden bg-gradient-to-b from-[#e6f1f8]/60 via-white to-white pt-10 pb-16 lg:pt-16 lg:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Column: Content -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#0B3B60]/10 text-[#0B3B60] text-xs font-black uppercase tracking-widest font-heading">
                    <x-heroicon-s-sparkles class="w-4 h-4 text-cyan-600" aria-hidden="true" />
                    <span>CLEAN SPACE, BETTER LIFE</span>
                </div>

                <!-- Main Heading (H1) -->
                <h1 id="hero-title" class="text-4xl sm:text-5xl lg:text-6xl font-black text-[#0B3B60] font-heading tracking-tight leading-[1.1]">
                    Kebersihan Adalah Komitmen Kami
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl leading-relaxed">
                    {{ $brand->site_name ?: 'BersihPrima' }} Cleaning Service menyediakan layanan kebersihan profesional untuk rumah, kantor, gedung bertingkat, dan industri dengan standar mutu terbaik.
                </p>

                <!-- CTA Action Buttons -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('public.services') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full text-sm font-black uppercase tracking-wider text-white bg-[#0B3B60] hover:bg-[#07243B] shadow-xl shadow-[#0B3B60]/25 hover:-translate-y-0.5 transition-all font-heading">
                        <span>Lihat Layanan Kami</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 text-cyan-300" aria-hidden="true" />
                    </a>
                    <a href="{{ route('public.contact') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full text-sm font-bold text-[#0B3B60] bg-white hover:bg-slate-50 border-2 border-[#0B3B60]/20 hover:border-[#0B3B60] transition-all font-heading">
                        <span>Minta Penawaran Harga</span>
                    </a>
                </div>

                <!-- Trust Points Minimal -->
                <div class="pt-4 flex items-center justify-center lg:justify-start gap-6 text-xs text-slate-500 font-semibold">
                    <span class="inline-flex items-center gap-1.5">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-600" />
                        <span>Sertifikasi ISO 9001</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-emerald-600" />
                        <span>Tenaga Kerja BNSP</span>
                    </span>
                </div>

            </div>

            <!-- Right Column: Hero Visual Image -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Decorative Backdrop Circle -->
                    <div class="absolute -inset-4 bg-gradient-to-tr from-cyan-100 to-blue-200 rounded-[2.5rem] transform rotate-3 -z-10 blur-lg opacity-70"></div>
                    
                    <!-- Main Hero Image Container -->
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-100 aspect-[4/5] sm:aspect-square lg:aspect-[4/5] flex items-center justify-center">
                        <img 
                            src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80" 
                            alt="Tenaga Kerja Profesional Cleaning Service BersihPrima" 
                            class="w-full h-full object-cover"
                            loading="eager"
                        >
                        
                        <!-- Floating Glass Floating Badge -->
                        <div class="absolute bottom-5 left-5 right-5 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-slate-100 shadow-xl flex items-center gap-3.5">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <x-heroicon-o-sparkles class="w-7 h-7" aria-hidden="true" />
                            </div>
                            <div>
                                <div class="text-xs font-black text-slate-900 font-heading uppercase tracking-wider">Garansi Kebersihan 100%</div>
                                <div class="text-[11px] text-slate-500">Standar higienitas tinggi & chemical ramah lingkungan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 2. Value Proposition Pills (3 Cards) -->
<section aria-labelledby="usp-heading" class="py-6 bg-white border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 id="usp-heading" class="sr-only">Keunggulan Layanan Kami</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Card 1 -->
            <div class="p-6 rounded-3xl bg-slate-50/80 border border-slate-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-[#e6f1f8] text-[#0B3B60] flex items-center justify-center shrink-0">
                    <x-heroicon-o-shield-check class="w-6 h-6" aria-hidden="true" />
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 font-heading">Profesional & Terpercaya</h3>
                    <p class="mt-1 text-xs text-slate-500 leading-relaxed">
                        Tim kami terlatih, berpengalaman, dan bekerja dengan standar keselamatan & SOP tinggi.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="p-6 rounded-3xl bg-slate-50/80 border border-slate-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <x-heroicon-o-check-badge class="w-6 h-6" aria-hidden="true" />
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 font-heading">Produk Aman & Ramah Lingkungan</h3>
                    <p class="mt-1 text-xs text-slate-500 leading-relaxed">
                        Menggunakan chemical bersertifikat yang ramah lingkungan dan aman bagi pernapasan.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="p-6 rounded-3xl bg-slate-50/80 border border-slate-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-700 flex items-center justify-center shrink-0">
                    <x-heroicon-o-clock class="w-6 h-6" aria-hidden="true" />
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 font-heading">Layanan Fleksibel</h3>
                    <p class="mt-1 text-xs text-slate-500 leading-relaxed">
                        Siap melayani kebutuhan pembersihan rutin harian, mingguan, maupun panggilan darurat.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. Dark Navy Counter Bar -->
<section aria-labelledby="counters-heading" class="py-12 bg-[#0B3B60] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 id="counters-heading" class="sr-only">Statistik dan Pencapaian Kami</h2>
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-y lg:divide-y-0 lg:divide-x divide-white/10">
            @forelse($statistics as $stat)
                <div class="pt-4 lg:pt-0">
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-black font-heading text-white tracking-tight">
                        {{ $stat->value }}
                    </div>
                    <div class="mt-2 text-xs sm:text-sm font-bold text-cyan-200 uppercase tracking-wider font-heading">
                        {{ $stat->label }}
                    </div>
                </div>
            @empty
                <div>
                    <div class="text-4xl font-black font-heading">10+</div>
                    <div class="mt-1 text-xs font-bold text-cyan-200 uppercase">Tahun Pengalaman</div>
                </div>
                <div>
                    <div class="text-4xl font-black font-heading">500+</div>
                    <div class="mt-1 text-xs font-bold text-cyan-200 uppercase">Klien Puas</div>
                </div>
                <div>
                    <div class="text-4xl font-black font-heading">1000+</div>
                    <div class="mt-1 text-xs font-bold text-cyan-200 uppercase">Proyek Selesai</div>
                </div>
                <div>
                    <div class="text-4xl font-black font-heading">50+</div>
                    <div class="mt-1 text-xs font-bold text-cyan-200 uppercase">Tim Profesional</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 4. Section: Mengapa Memilih Kami? (4 Cards with Visuals) -->
<section aria-labelledby="why-us-heading" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-[#e6f1f8] px-3.5 py-1 rounded-full">
                Keunggulan Kami
            </span>
            <h2 id="why-us-heading" class="mt-3 text-3xl sm:text-4xl font-black text-[#0B3B60] font-heading tracking-tight">
                Mengapa Memilih Kami?
            </h2>
            <p class="mt-3 text-sm text-slate-500">
                Komitmen kami terhadap mutu pelayanan terbukti melalui dedikasi kerja dan kepatuhan standar industri.
            </p>
        </div>

        <!-- 4 Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1 -->
            <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="h-44 overflow-hidden bg-slate-100">
                    <img 
                        src="https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=600&q=80" 
                        alt="Standar Kebersihan Tinggi" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-[#0B3B60] font-heading">Standar Kebersihan Tinggi</h3>
                        <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                            Kami menerapkan standar operasional terbaik di setiap layanan kebersihan komersial maupun residensial.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="h-44 overflow-hidden bg-slate-100">
                    <img 
                        src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=600&q=80" 
                        alt="Tim Terlatih" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-[#0B3B60] font-heading">Tim Terlatih & Berlisensi</h3>
                        <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                            Seluruh tim kami telah melewati pelatihan sertifikasi profesional dan verifikasi latar belakang ketat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="h-44 overflow-hidden bg-slate-100">
                    <img 
                        src="https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?auto=format&fit=crop&w=600&q=80" 
                        alt="Peralatan Modern" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-[#0B3B60] font-heading">Peralatan Modern</h3>
                        <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                            Menggunakan mesin hydro-vacuum, polisher lantai industri, dan chemical bersertifikasi ramah lingkungan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
                <div class="h-44 overflow-hidden bg-slate-100">
                    <img 
                        src="https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=600&q=80" 
                        alt="Harga Kompetitif" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-base font-extrabold text-[#0B3B60] font-heading">Harga Kompetitif & SLA Transparan</h3>
                        <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                            Penawaran harga fleksibel dengan kesepakatan Service Level Agreement (SLA) yang jelas dan terukur.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- 5. Highlight Layanan Kami (Services Grid) -->
<section aria-labelledby="services-section-title" class="py-20 bg-slate-50/70 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-14 gap-4">
            <div>
                <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-[#e6f1f8] px-3.5 py-1 rounded-full">
                    Solusi Terpadu
                </span>
                <h2 id="services-section-title" class="mt-3 text-3xl sm:text-4xl font-black text-[#0B3B60] font-heading tracking-tight">
                    Layanan Kebersihan Unggulan
                </h2>
                <p class="mt-2 text-sm text-slate-500 max-w-xl">
                    Berbagai paket pembersihan profesional yang dirancang khusus untuk memenuhi kebutuhan instansi dan perorangan.
                </p>
            </div>
            <a href="{{ route('public.services') }}" class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-wider text-[#0B3B60] hover:text-[#07243B] font-heading">
                <span>Lihat Semua Layanan</span>
                <x-heroicon-o-arrow-right class="w-4 h-4" aria-hidden="true" />
            </a>
        </div>

        <!-- Services 6 Cards Grid (Matching Reference UI) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <article class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    
                    <!-- Card Thumbnail -->
                    <div class="relative h-48 bg-slate-100 overflow-hidden">
                        @if($service->thumbnail)
                            <img 
                                src="{{ asset('storage/' . $service->thumbnail) }}" 
                                alt="{{ $service->name }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            <img 
                                src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=600&q=80" 
                                alt="{{ $service->name }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        @endif

                        <!-- Floating Icon Badge -->
                        <div class="absolute bottom-3 right-3 w-10 h-10 rounded-2xl bg-[#0B3B60] text-white flex items-center justify-center shadow-lg">
                            @if($service->icon && str_starts_with($service->icon, 'heroicon-'))
                                <x-dynamic-component :component="$service->icon" class="w-5 h-5" aria-hidden="true" />
                            @else
                                <x-heroicon-o-sparkles class="w-5 h-5 text-cyan-300" aria-hidden="true" />
                            @endif
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-heading">
                                {{ $service->category }}
                            </span>
                            <h3 class="text-lg font-black text-[#0B3B60] font-heading mt-1">
                                <a href="{{ route('public.services.show', $service->slug) }}" class="hover:underline">
                                    {{ $service->name }}
                                </a>
                            </h3>
                            <p class="mt-2 text-xs text-slate-500 leading-relaxed line-clamp-2">
                                {{ $service->excerpt ?: strip_tags(substr($service->description, 0, 100)) }}
                            </p>
                        </div>

                        <div class="pt-2 border-t border-slate-100">
                            <a href="{{ route('public.services.show', $service->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0B3B60] hover:text-cyan-700 font-heading uppercase tracking-wider">
                                <span>Selengkapnya</span>
                                <x-heroicon-o-arrow-right class="w-3.5 h-3.5" aria-hidden="true" />
                            </a>
                        </div>
                    </div>

                </article>
            @endforeach
        </div>

        <!-- Bottom CTA Box in Services -->
        <div class="mt-14 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-lg sm:text-xl font-black text-[#0B3B60] font-heading">Butuh Layanan Kebersihan Khusus / Custom?</h3>
                <p class="text-xs text-slate-500 mt-1">Kami siap membantu Anda menciptakan lingkungan yang bersih, sehat, dan nyaman sesuai anggaran.</p>
            </div>
            <a href="{{ route('public.contact') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-xs font-extrabold uppercase tracking-wider text-white bg-[#0B3B60] hover:bg-[#07243B] shrink-0 font-heading shadow-md shadow-[#0B3B60]/20">
                <span>Hubungi Kami</span>
                <x-heroicon-o-arrow-right class="w-4 h-4 text-cyan-300" aria-hidden="true" />
            </a>
        </div>

    </div>
</section>

<!-- 6. Akreditasi & Sertifikasi ISO Section -->
<section aria-labelledby="certs-heading" class="py-16 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-[#e6f1f8] px-3.5 py-1 rounded-full">
                Legalitas & Mutu
            </span>
            <h2 id="certs-heading" class="mt-3 text-2xl sm:text-3xl font-black text-[#0B3B60] font-heading tracking-tight">
                Akreditasi & Standar Sertifikasi ISO
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($certificates as $cert)
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-100 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#0B3B60] text-white flex items-center justify-center shrink-0">
                        <x-heroicon-o-academic-cap class="w-6 h-6 text-cyan-300" aria-hidden="true" />
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900 font-heading">{{ $cert->name }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $cert->issuer ?: 'Lembaga Sertifikasi Nasional' }}</p>
                        @if($cert->license_number)
                            <div class="mt-2 text-[10px] font-mono font-semibold text-slate-400 bg-white px-2.5 py-1 rounded-lg inline-block border border-slate-200">
                                No: {{ $cert->license_number }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-6 text-xs text-slate-400 italic">Sertifikasi terdaftar.</div>
            @endforelse
        </div>

    </div>
</section>

<!-- 7. Galeri Hasil Kerja (Before & After Slider/Grid) -->
<section aria-labelledby="portfolio-heading" class="py-20 bg-slate-50/70 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-[#e6f1f8] px-3.5 py-1 rounded-full">
                    Bukti Kualitas
                </span>
                <h2 id="portfolio-heading" class="mt-3 text-3xl sm:text-4xl font-black text-[#0B3B60] font-heading tracking-tight">
                    Galeri Before & After Pengerjaan
                </h2>
                <p class="mt-2 text-sm text-slate-500 max-w-xl">
                    Perbandingan nyata kualitas pengerjaan tim pembersih kami sebelum dan sesudah tindakan restorasi.
                </p>
            </div>
            <a href="{{ route('public.portfolio') }}" class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-wider text-[#0B3B60] hover:text-[#07243B] font-heading">
                <span>Lihat Semua Galeri Proyek</span>
                <x-heroicon-o-arrow-right class="w-4 h-4" aria-hidden="true" />
            </a>
        </div>

        <!-- Before & After Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
                <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition-shadow p-5 flex flex-col justify-between">
                    <div>
                        <!-- Before & After Dual Preview -->
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-100 border border-slate-200">
                                @if($project->before_image)
                                    <img src="{{ asset('storage/' . $project->before_image) }}" alt="Before {{ $project->title }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=400&q=80" alt="Before" class="w-full h-full object-cover grayscale opacity-75">
                                @endif
                                <span class="absolute top-2 left-2 px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase text-white bg-amber-600 font-heading">
                                    Before
                                </span>
                            </div>

                            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] bg-slate-100 border border-slate-200">
                                @if($project->after_image)
                                    <img src="{{ asset('storage/' . $project->after_image) }}" alt="After {{ $project->title }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=400&q=80" alt="After" class="w-full h-full object-cover">
                                @endif
                                <span class="absolute top-2 left-2 px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase text-white bg-emerald-600 font-heading">
                                    After
                                </span>
                            </div>
                        </div>

                        <span class="text-[10px] font-bold uppercase text-slate-400 font-heading">
                            {{ $project->category ?: ($project->service->name ?? 'Pembersihan Umum') }}
                        </span>
                        <h3 class="text-base font-extrabold text-[#0B3B60] font-heading mt-0.5">
                            {{ $project->title }}
                        </h3>
                        @if($project->description)
                            <p class="mt-1.5 text-xs text-slate-500 leading-relaxed line-clamp-2">
                                {{ $project->description }}
                            </p>
                        @endif
                    </div>

                    @if($project->completed_at)
                        <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-400 font-mono">
                            Selesai: {{ $project->completed_at->format('d M Y') }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- 8. Mitra Korporat & Klien Terpercaya (Matching Reference UI Grid) -->
<section aria-labelledby="clients-heading" class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-[#e6f1f8] px-3.5 py-1 rounded-full">
                Mitra Kami
            </span>
            <h2 id="clients-heading" class="mt-3 text-3xl sm:text-4xl font-black text-[#0B3B60] font-heading tracking-tight">
                Dipercaya oleh Berbagai Perusahaan & Instansi
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Bergabung dengan mitra kami dan rasakan layanan kebersihan berkualitas tinggi untuk lingkungan yang lebih bersih dan sehat.
            </p>
        </div>

        <!-- Logos Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 items-center">
            @foreach($clients as $client)
                <div class="p-5 h-24 bg-slate-50/80 rounded-2xl border border-slate-100 flex items-center justify-center hover:bg-white hover:shadow-md transition-all group">
                    @if($client->logo_path)
                        <img src="{{ asset('storage/' . $client->logo_path) }}" alt="{{ $client->name }}" class="max-h-12 max-w-full object-contain grayscale group-hover:grayscale-0 transition-all opacity-70 group-hover:opacity-100">
                    @else
                        <span class="text-xs font-black text-slate-700 font-heading text-center tracking-tight">{{ $client->name }}</span>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- 9. Testimoni Klien Section -->
<section aria-labelledby="testimonials-heading" class="py-20 bg-[#e6f1f8]/40 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-white px-3.5 py-1 rounded-full shadow-sm">
                Kepuasan Pelanggan
            </span>
            <h2 id="testimonials-heading" class="mt-3 text-3xl sm:text-4xl font-black text-[#0B3B60] font-heading tracking-tight">
                Apa Kata Klien Kami?
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Ulasan kepuasan dari mitra institusi dan korporat yang mempercayakan fasilitas mereka kepada kami.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testi)
                <div class="bg-white rounded-3xl p-7 border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1 text-amber-400 mb-4">
                            @for($i = 1; $i <= $testi->rating; $i++)
                                <x-heroicon-s-star class="w-4 h-4 text-amber-400" />
                            @endfor
                        </div>

                        <!-- Quote Text -->
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic">
                            "{{ $testi->quote }}"
                        </p>
                    </div>

                    <!-- Client Bio -->
                    <div class="mt-6 pt-5 border-t border-slate-100 flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-full bg-[#0B3B60] text-white flex items-center justify-center font-bold text-sm font-heading shrink-0">
                            {{ strtoupper(substr($testi->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-sm font-extrabold text-[#0B3B60] font-heading">{{ $testi->name }}</div>
                            <div class="text-[11px] text-slate-400">{{ $testi->designation_company }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- 10. Artikel & Edukasi Kebersihan Terbaru (3 Posts) -->
<section aria-labelledby="articles-heading" class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-black text-[#0B3B60] uppercase tracking-widest font-heading bg-[#e6f1f8] px-3.5 py-1 rounded-full">
                    Wawasan & Berita
                </span>
                <h2 id="articles-heading" class="mt-3 text-3xl sm:text-4xl font-black text-[#0B3B60] font-heading tracking-tight">
                    Artikel & Edukasi Terbaru
                </h2>
                <p class="mt-2 text-sm text-slate-500 max-w-xl">
                    Pelajari tips pemeliharaan fasilitas gedung dan informasi standar sanitasi terkini.
                </p>
            </div>
            <a href="{{ route('public.articles') }}" class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-wider text-[#0B3B60] hover:text-[#07243B] font-heading">
                <span>Lihat Semua Artikel</span>
                <x-heroicon-o-arrow-right class="w-4 h-4" aria-hidden="true" />
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($recentArticles as $art)
                <article class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="h-48 overflow-hidden bg-slate-100">
                        @if($art->featured_image)
                            <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <img src="https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=600&q=80" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @endif
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-cyan-800 bg-cyan-50 px-2.5 py-0.5 rounded-full font-heading">
                                {{ $art->category }}
                            </span>
                            <h3 class="text-base font-black text-[#0B3B60] font-heading mt-2 line-clamp-2">
                                <a href="{{ route('public.articles.show', $art->slug) }}" class="hover:underline">
                                    {{ $art->title }}
                                </a>
                            </h3>
                            <p class="mt-2 text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $art->excerpt }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                            <span>{{ $art->published_at ? $art->published_at->format('d M Y') : '-' }}</span>
                            <span class="font-bold text-[#0B3B60] group-hover:text-cyan-700">Baca Selengkapnya &rarr;</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>

<!-- 11. Quick RFQ CTA Form Banner (Bottom Homepage) -->
<section aria-labelledby="cta-heading" class="py-20 bg-gradient-to-tr from-[#0B3B60] via-[#0e446d] to-[#07243B] text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
        
        <div class="space-y-3">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-white/10 text-cyan-300 text-xs font-black uppercase tracking-widest font-heading border border-white/15">
                Konsultasi & Penawaran Gratis
            </span>
            <h2 id="cta-heading" class="text-3xl sm:text-4xl lg:text-5xl font-black font-heading tracking-tight">
                Siap Meningkatkan Standar Kebersihan Properti Anda?
            </h2>
            <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Dapatkan proposal penawaran harga resmi (RFQ) dan konsultasi kebutuhan operasional cleaning service gedung Anda hari ini.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('public.contact') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-9 py-4 rounded-full text-xs font-black uppercase tracking-wider text-[#0B3B60] bg-white hover:bg-slate-100 shadow-2xl transition-all font-heading">
                <span>Isi Formulir Penawaran (RFQ)</span>
                <x-heroicon-o-arrow-right class="w-4 h-4 text-[#0B3B60]" aria-hidden="true" />
            </a>
            @if($contact->whatsapp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-9 py-4 rounded-full text-xs font-black uppercase tracking-wider text-white bg-emerald-500 hover:bg-emerald-600 shadow-xl transition-all font-heading">
                    <span>Chat WhatsApp Langsung</span>
                </a>
            @endif
        </div>

    </div>
</section>

@endsection
