@extends('layouts.admin')

@section('title', 'Kelola Berita & Artikel')
@section('header-title', 'Articles & Blog Management')
@section('header-subtitle', 'Publikasi edukasi kebersihan, tips fasilitas, dan update berita aktivitas perusahaan')

@section('content')
<div class="space-y-6">

    <!-- Top Action Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Artikel & Berita</h2>
            <p class="text-xs text-slate-400">Total {{ $articles->count() }} artikel terdaftar</p>
        </div>

        @can('article.create')
            <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-plus-circle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tulis Artikel Baru</span>
            </a>
        @endcan
    </div>

    <!-- Articles Table Card with DataTable -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden p-2 sm:p-4">
        <div class="overflow-x-auto">
            <table class="datatable w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Judul Artikel</th>
                        <th scope="col" class="px-6 py-4">Kategori</th>
                        <th scope="col" class="px-6 py-4">Penulis</th>
                        <th scope="col" class="px-6 py-4 text-center">Status</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($articles as $article)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Title & Slug -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900 font-heading text-sm">{{ Str::limit($article->title, 55) }}</div>
                                <div class="text-xs font-mono text-slate-400">/artikel/{{ $article->slug }}</div>
                            </td>

                            <!-- Category -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#e2f4f1] text-[#24695c] border border-[#a2ded5]/60 uppercase font-heading">
                                    {{ $article->category }}
                                </span>
                            </td>

                            <!-- Author -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600">
                                {{ $article->author->name ?? 'Admin' }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($article->status === 'published')
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('article.edit')
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Artikel" aria-label="Edit {{ $article->title }}">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                                        </a>
                                    @endcan

                                    @can('article.delete')
                                        <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel {{ $article->title }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Artikel" aria-label="Hapus {{ $article->title }}">
                                                <x-heroicon-o-trash class="w-4 h-4" aria-hidden="true" />
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
