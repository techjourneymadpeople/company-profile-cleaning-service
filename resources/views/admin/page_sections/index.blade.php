@extends('layouts.admin')

@section('title', 'Content Halaman Publik')
@section('header-title', 'Public Page Content')
@section('header-subtitle', 'Kelola, sesuaikan, dan aktifkan setiap section pada seluruh halaman website publik')

@section('content')
<div class="space-y-6">

    <!-- Top Action & Info Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-[#e2f4f1] text-[#24695c] font-heading">
                    <x-heroicon-o-window class="w-4 h-4" />
                    <span>Modul Editor Halaman</span>
                </span>
                <span class="text-xs text-slate-400 font-medium">| Section-by-Section Customizer</span>
            </div>
            <h2 class="mt-2 text-lg sm:text-xl font-black text-slate-900 font-heading">
                Kelola Section Halaman: <span class="text-[#24695c]">{{ $pages[$currentPage]['name'] ?? 'Halaman' }}</span>
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                {{ $pages[$currentPage]['description'] ?? '' }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if(isset($pages[$currentPage]['route']) && \Illuminate\Support\Facades\Route::has($pages[$currentPage]['route']))
                <a href="{{ route($pages[$currentPage]['route']) }}" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-all font-heading">
                    <span>Lihat di Web Publik</span>
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 text-slate-500" />
                </a>
            @endif
        </div>
    </div>

    <!-- Alert Notification -->
    @if(session('status'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-medium flex items-center gap-3 shadow-xs">
            <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <!-- Page Selection Tabs Navigation -->
    <div class="bg-white p-2 sm:p-3 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-x-auto">
        <div class="flex items-center gap-2 min-w-max">
            @foreach($pages as $key => $page)
                @php
                    $isPageActive = ($currentPage === $key);
                    $stats = $pageStats[$key] ?? ['total' => 0, 'active' => 0];
                @endphp
                <a href="{{ route('admin.page-sections.index', ['page' => $key]) }}" 
                   class="group flex items-center gap-3 px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all duration-200 {{ $isPageActive ? 'bg-[#24695c] text-white shadow-md shadow-[#24695c]/25' : 'text-slate-600 hover:bg-[#e2f4f1]/50 hover:text-[#24695c]' }}">
                    <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ $isPageActive ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-[#e2f4f1] group-hover:text-[#24695c]' }}">
                        @if($page['icon'] && str_starts_with($page['icon'], 'heroicon-'))
                            <x-dynamic-component :component="$page['icon']" class="w-4 h-4" />
                        @else
                            <x-heroicon-o-document-text class="w-4 h-4" />
                        @endif
                    </div>
                    <div class="text-left">
                        <div class="font-heading font-extrabold tracking-tight">{{ $page['name'] }}</div>
                        <div class="text-[10px] {{ $isPageActive ? 'text-teal-100' : 'text-slate-400' }} font-medium">
                            {{ $stats['active'] }}/{{ $stats['total'] }} Section Aktif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Sections List Grid -->
    <div class="space-y-4">
        <div class="flex items-center justify-between px-1">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 font-heading">
                Daftar Section pada Halaman {{ $pages[$currentPage]['name'] ?? '' }} ({{ $sections->count() }} Section)
            </h3>
            <span class="text-xs text-slate-400">Klik "Edit Section" untuk mengubah konten & gambar</span>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @forelse($sections as $section)
                <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] hover:border-[#24695c]/30 hover:shadow-md transition-all flex flex-col lg:flex-row lg:items-center justify-between gap-5 {{ $section->is_active ? '' : 'opacity-70 bg-slate-50/50' }}">
                    
                    <!-- Left: Section Info -->
                    <div class="flex items-start gap-4 flex-1 min-w-0">
                        <!-- Sort Number & Icon -->
                        <div class="w-12 h-12 rounded-2xl bg-[#e2f4f1] text-[#24695c] flex flex-col items-center justify-center shrink-0 border border-[#a2ded5]/50">
                            <span class="text-[10px] font-black uppercase font-heading text-[#24695c]/70">#{{ $section->sort_order }}</span>
                            <x-heroicon-o-cube class="w-5 h-5 text-[#24695c]" />
                        </div>

                        <div class="space-y-1.5 flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <h4 class="text-base font-extrabold text-slate-900 font-heading truncate">
                                    {{ $section->section_name }}
                                </h4>
                                <span class="font-mono text-[10px] px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 border border-slate-200">
                                    key: {{ $section->section_key }}
                                </span>

                                @if($section->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Aktif Tayang</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        <span>Dinonaktifkan</span>
                                    </span>
                                @endif
                            </div>

                            <!-- Preview Elements (Badge / Title / Subtitle) -->
                            <div class="text-xs text-slate-600 space-y-1 pt-1">
                                @if($section->badge)
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Badge:</span>
                                        <span class="font-bold text-[#24695c] bg-[#e2f4f1] px-2 py-0.5 rounded-md text-[11px]">{{ $section->badge }}</span>
                                    </div>
                                @endif

                                @if($section->title)
                                    <div class="flex items-baseline gap-1.5">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 shrink-0">Judul:</span>
                                        <span class="font-semibold text-slate-800 line-clamp-1">"{{ $section->title }}"</span>
                                    </div>
                                @endif

                                @if($section->subtitle)
                                    <div class="flex items-baseline gap-1.5">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 shrink-0">Subjudul:</span>
                                        <span class="text-slate-500 line-clamp-1">{{ $section->subtitle }}</span>
                                    </div>
                                @endif

                                @if($section->button_text)
                                    <div class="flex items-center gap-2 text-[11px] text-slate-500 pt-0.5">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">CTA:</span>
                                        <span class="font-medium text-slate-700 bg-slate-100 px-2 py-0.5 rounded">{{ $section->button_text }} &rarr; {{ $section->button_url }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right: Actions -->
                    <div class="flex items-center gap-3 pt-3 lg:pt-0 border-t lg:border-t-0 border-slate-100 shrink-0">
                        <!-- Quick Toggle Status Button -->
                        @can('page_section.edit')
                            <form action="{{ route('admin.page-sections.toggle-status', $section) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold transition-all {{ $section->is_active ? 'bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200' }}"
                                        title="{{ $section->is_active ? 'Nonaktifkan section ini di halaman publik' : 'Aktifkan section ini di halaman publik' }}">
                                    @if($section->is_active)
                                        <x-heroicon-o-eye-slash class="w-4 h-4" />
                                        <span>Sembunyikan</span>
                                    @else
                                        <x-heroicon-o-eye class="w-4 h-4" />
                                        <span>Tampilkan</span>
                                    @endif
                                </button>
                            </form>
                        @endcan

                        <!-- Edit Button -->
                        @can('page_section.edit')
                            <a href="{{ route('admin.page-sections.edit', $section) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/20 transition-all font-heading">
                                <x-heroicon-o-pencil-square class="w-4 h-4 text-teal-200" />
                                <span>Edit Section</span>
                            </a>
                        @endcan
                    </div>

                </div>
            @empty
                <div class="bg-white p-12 text-center rounded-3xl border border-slate-100">
                    <x-heroicon-o-folder-open class="w-12 h-12 text-slate-300 mx-auto mb-3" />
                    <p class="text-sm font-bold text-slate-700 font-heading">Belum ada section yang terdaftar untuk halaman ini.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
