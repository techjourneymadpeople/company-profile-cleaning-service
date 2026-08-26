@extends('layouts.frontend')

@section('content')

<!-- Header Banner (Matching Reference UI Dark Navy Banner) -->
<section aria-labelledby="services-page-title" class="bg-[#0B3B60] text-white py-14 lg:py-20 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav aria-label="Breadcrumb" class="mb-4">
            <ol class="flex items-center gap-2 text-xs font-semibold text-cyan-200/80">
                <li><a href="{{ route('public.home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                <li><span>&rsaquo;</span></li>
                <li class="text-white" aria-current="page">Layanan</li>
            </ol>
        </nav>

        <h1 id="services-page-title" class="text-3xl sm:text-4xl lg:text-5xl font-black font-heading tracking-tight">
            Layanan Kami
        </h1>
        <p class="mt-2 text-sm sm:text-base text-slate-300 max-w-2xl leading-relaxed">
            Berbagai layanan kebersihan profesional yang kami sediakan untuk memenuhi kebutuhan Anda.
        </p>
    </div>
</section>

<!-- Category Filter Pills -->
<section aria-label="Filter Kategori Layanan" class="py-8 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto pb-2">
            @foreach($categories as $cat)
                <a 
                    href="{{ route('public.services', ['kategori' => $cat === 'Semua' ? null : $cat]) }}" 
                    class="px-5 py-2.5 rounded-full text-xs font-extrabold uppercase tracking-wider transition-all whitespace-nowrap font-heading {{ ($category === $cat || (empty($category) && $cat === 'Semua')) ? 'bg-[#0B3B60] text-white shadow-md shadow-[#0B3B60]/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                >
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Services Grid Section -->
<section aria-label="Daftar Layanan Kebersihan" class="py-16 bg-slate-50/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
                <article class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    
                    <!-- Thumbnail -->
                    <div class="relative h-52 bg-slate-100 overflow-hidden">
                        @if($service->thumbnail)
                            <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=600&q=80" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @endif

                        <!-- Icon Badge -->
                        <div class="absolute bottom-3 right-3 w-11 h-11 rounded-2xl bg-[#0B3B60] text-white flex items-center justify-center shadow-lg">
                            @if($service->icon && str_starts_with($service->icon, 'heroicon-'))
                                <x-dynamic-component :component="$service->icon" class="w-6 h-6" aria-hidden="true" />
                            @else
                                <x-heroicon-o-sparkles class="w-6 h-6 text-cyan-300" aria-hidden="true" />
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-heading">
                                {{ $service->category }}
                            </span>
                            <h2 class="text-lg font-black text-[#0B3B60] font-heading mt-1">
                                <a href="{{ route('public.services.show', $service->slug) }}" class="hover:underline">
                                    {{ $service->name }}
                                </a>
                            </h2>
                            <p class="mt-2 text-xs text-slate-500 leading-relaxed line-clamp-3">
                                {{ $service->excerpt ?: strip_tags(substr($service->description, 0, 120)) }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-100">
                            <a href="{{ route('public.services.show', $service->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0B3B60] hover:text-cyan-700 font-heading uppercase tracking-wider">
                                <span>Selengkapnya</span>
                                <x-heroicon-o-arrow-right class="w-3.5 h-3.5" aria-hidden="true" />
                            </a>
                        </div>
                    </div>

                </article>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-100">
                    <p class="text-sm text-slate-500 font-semibold">Tidak ada layanan yang ditemukan untuk kategori ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Bottom CTA Box in Services Index (Matching Reference) -->
        <div class="mt-16 bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-lg sm:text-xl font-black text-[#0B3B60] font-heading">Butuh Layanan Kebersihan Profesional?</h2>
                <p class="text-xs text-slate-500 mt-1">Kami siap membantu Anda menciptakan lingkungan yang bersih, sehat, dan nyaman.</p>
            </div>
            <a href="{{ route('public.contact') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-xs font-extrabold uppercase tracking-wider text-white bg-[#0B3B60] hover:bg-[#07243B] shrink-0 font-heading shadow-md shadow-[#0B3B60]/20">
                <span>Hubungi Kami</span>
                <x-heroicon-o-arrow-right class="w-4 h-4 text-cyan-300" aria-hidden="true" />
            </a>
        </div>

    </div>
</section>

@endsection
