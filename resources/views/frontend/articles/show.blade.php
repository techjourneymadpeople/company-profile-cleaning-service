@extends('layouts.frontend')

@section('content')

<!-- Header Banner -->
<section aria-labelledby="article-title" class="bg-[#0B3B60] text-white py-14 lg:py-20 border-b border-white/10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav aria-label="Breadcrumb" class="mb-4">
            <ol class="flex items-center gap-2 text-xs font-semibold text-cyan-200/80">
                <li><a href="{{ route('public.home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                <li><span>&rsaquo;</span></li>
                <li><a href="{{ route('public.articles') }}" class="hover:text-white transition-colors">Artikel</a></li>
                <li><span>&rsaquo;</span></li>
                <li class="text-white truncate max-w-[200px]" aria-current="page">{{ $article->title }}</li>
            </ol>
        </nav>

        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-white/15 text-cyan-200 font-heading mb-4">
            {{ $article->category }}
        </span>

        <h1 id="article-title" class="text-2xl sm:text-3xl lg:text-4xl font-black font-heading tracking-tight leading-tight">
            {{ $article->title }}
        </h1>

        <!-- Author & Date Meta -->
        <div class="mt-6 flex items-center gap-4 text-xs text-slate-300">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-cyan-500 text-white flex items-center justify-center font-bold font-heading">
                    {{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}
                </div>
                <span>{{ $article->author->name ?? 'Tim Editorial BersihPrima' }}</span>
            </div>
            <span>•</span>
            <time datetime="{{ $article->published_at ? $article->published_at->toIso8601String() : '' }}">
                {{ $article->published_at ? $article->published_at->translatedFormat('d F Y') : '-' }}
            </time>
        </div>
    </div>
</section>

<!-- Main Article Body -->
<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <article class="space-y-8">
            
            <!-- Featured Image -->
            @if($article->featured_image)
                <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-100 aspect-video bg-slate-100">
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Excerpt Callout -->
            @if($article->excerpt)
                <div class="p-6 bg-slate-50 border-l-4 border-[#0B3B60] rounded-r-2xl text-slate-700 italic text-sm leading-relaxed">
                    {{ $article->excerpt }}
                </div>
            @endif

            <!-- Full Content (Rich Text) -->
            <div class="prose prose-slate max-w-none prose-headings:font-heading prose-headings:text-[#0B3B60] prose-h2:text-2xl prose-h3:text-xl prose-p:text-slate-700 prose-p:leading-relaxed prose-li:text-slate-700 prose-img:rounded-2xl">
                {!! $article->content !!}
            </div>

            <!-- Social Share Bar -->
            <div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <span class="text-xs font-bold text-slate-700 font-heading uppercase tracking-wider">Bagikan Artikel Ini:</span>
                <div class="flex items-center gap-2">
                    <a 
                        href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
                        target="_blank" 
                        class="px-4 py-2 rounded-full text-xs font-bold bg-emerald-500 hover:bg-emerald-600 text-white transition-colors"
                    >
                        WhatsApp
                    </a>
                    <a 
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                        target="_blank" 
                        class="px-4 py-2 rounded-full text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white transition-colors"
                    >
                        Facebook
                    </a>
                    <a 
                        href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" 
                        target="_blank" 
                        class="px-4 py-2 rounded-full text-xs font-bold bg-sky-500 hover:bg-sky-600 text-white transition-colors"
                    >
                        Twitter / X
                    </a>
                    <a 
                        href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                        target="_blank" 
                        class="px-4 py-2 rounded-full text-xs font-bold bg-blue-800 hover:bg-blue-900 text-white transition-colors"
                    >
                        LinkedIn
                    </a>
                </div>
            </div>

        </article>

        <!-- Related Articles Section -->
        @if($relatedArticles->isNotEmpty())
            <section aria-labelledby="related-articles-heading" class="mt-20 pt-12 border-t border-slate-200">
                <h2 id="related-articles-heading" class="text-2xl font-black text-[#0B3B60] font-heading mb-8">
                    Artikel Terkait Lainnya
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $rel)
                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 flex flex-col justify-between hover:bg-white hover:shadow-md transition-all group">
                            <div>
                                <span class="text-[9px] font-bold uppercase text-slate-400 font-heading">{{ $rel->category }}</span>
                                <h3 class="text-xs font-extrabold text-[#0B3B60] font-heading mt-1 group-hover:underline">
                                    <a href="{{ route('public.articles.show', $rel->slug) }}">{{ $rel->title }}</a>
                                </h3>
                            </div>
                            <div class="mt-3 text-[10px] text-slate-400 font-mono">
                                {{ $rel->published_at ? $rel->published_at->format('d M Y') : '-' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</div>

@endsection
