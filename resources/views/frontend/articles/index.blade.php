@extends('layouts.frontend')

@section('content')

<!-- Header Banner -->
<section aria-labelledby="articles-page-title" class="bg-[#0B3B60] text-white py-14 lg:py-20 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav aria-label="Breadcrumb" class="mb-4">
            <ol class="flex items-center gap-2 text-xs font-semibold text-cyan-200/80">
                <li><a href="{{ route('public.home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                <li><span>&rsaquo;</span></li>
                <li class="text-white" aria-current="page">Artikel & Berita</li>
            </ol>
        </nav>

        <h1 id="articles-page-title" class="text-3xl sm:text-4xl lg:text-5xl font-black font-heading tracking-tight">
            Artikel & Edukasi Kebersihan
        </h1>
        <p class="mt-2 text-sm sm:text-base text-slate-300 max-w-2xl leading-relaxed">
            Wawasan seputar teknik perawatan fasilitas properti, standar sanitasi gedung, dan berita kegiatan perusahaan.
        </p>
    </div>
</section>

<!-- Filter & Search Section -->
<section aria-label="Filter & Pencarian Artikel" class="py-6 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
        
        <!-- Category Filter -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1">
            <a 
                href="{{ route('public.articles') }}" 
                class="px-4 py-2 rounded-full text-xs font-extrabold uppercase tracking-wider transition-all whitespace-nowrap font-heading {{ empty($category) ? 'bg-[#0B3B60] text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
            >
                Semua Kategori
            </a>
            @foreach($categories as $cat)
                <a 
                    href="{{ route('public.articles', ['kategori' => $cat]) }}" 
                    class="px-4 py-2 rounded-full text-xs font-extrabold uppercase tracking-wider transition-all whitespace-nowrap font-heading {{ $category === $cat ? 'bg-[#0B3B60] text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                >
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <!-- Search Input Form -->
        <form method="GET" action="{{ route('public.articles') }}" class="w-full md:w-72">
            @if($category)
                <input type="hidden" name="kategori" value="{{ $category }}">
            @endif
            <div class="relative">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $search }}" 
                    placeholder="Cari artikel..." 
                    class="w-full pl-4 pr-10 py-2 rounded-full text-xs border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B3B60]"
                >
                <button type="submit" class="absolute right-3 top-2.5 text-slate-400 hover:text-[#0B3B60]" aria-label="Cari">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                </button>
            </div>
        </form>

    </div>
</section>

<!-- Articles Grid Section -->
<section aria-label="Daftar Artikel" class="py-16 bg-slate-50/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $art)
                <article class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    
                    <!-- Thumbnail -->
                    <div class="relative h-52 bg-slate-100 overflow-hidden">
                        @if($art->featured_image)
                            <img src="{{ asset('storage/' . $art->featured_image) }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=600&q=80" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @endif
                    </div>

                    <!-- Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-cyan-800 bg-cyan-50 px-2.5 py-0.5 rounded-full font-heading">
                                {{ $art->category }}
                            </span>
                            <h2 class="text-lg font-black text-[#0B3B60] font-heading mt-2 line-clamp-2">
                                <a href="{{ route('public.articles.show', $art->slug) }}" class="hover:underline">
                                    {{ $art->title }}
                                </a>
                            </h2>
                            <p class="mt-2 text-xs text-slate-500 line-clamp-3 leading-relaxed">
                                {{ $art->excerpt }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                            <span>{{ $art->published_at ? $art->published_at->format('d M Y') : '-' }}</span>
                            <span class="font-bold text-[#0B3B60] group-hover:text-cyan-700">Baca Selengkapnya &rarr;</span>
                        </div>
                    </div>

                </article>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-3xl border border-slate-100">
                    <p class="text-sm text-slate-400 font-semibold">Tidak ada artikel yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        @endif

    </div>
</section>

@endsection
