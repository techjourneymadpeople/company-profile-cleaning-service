@extends('layouts.admin')

@section('title', 'Galeri Hasil Kerja (Before & After)')
@section('header-title', 'Projects & Portfolio')
@section('header-subtitle', 'Dokumentasi komparasi foto hasil kerja Sebelum & Sesudah pengerjaan tim cleaning')

@section('content')
<div class="space-y-6">

    <!-- Top Action & Search Bar -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.projects.index') }}" class="flex-1 max-w-md">
            <div class="relative rounded-2xl">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-slate-400" aria-hidden="true" />
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari judul proyek atau kategori..." 
                    class="block w-full rounded-2xl border border-slate-200 pl-11 pr-4 py-2.5 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#24695c] focus:border-[#24695c] transition-all"
                >
            </div>
        </form>

        @can('project.create')
            <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-plus-circle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Proyek Baru</span>
            </a>
        @endcan
    </div>

    <!-- Projects Table Card -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Judul Proyek</th>
                        <th scope="col" class="px-6 py-4">Layanan Terkait</th>
                        <th scope="col" class="px-6 py-4">Komparasi Foto</th>
                        <th scope="col" class="px-6 py-4">Selesai Pada</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($projects as $project)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Project Title & Category -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900 font-heading text-sm">{{ $project->title }}</div>
                                <div class="text-xs text-slate-400">{{ $project->category ?: '-' }}</div>
                            </td>

                            <!-- Related Service -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($project->service)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#e2f4f1] text-[#24695c] border border-[#a2ded5]/60 font-heading">
                                        {{ $project->service->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400 italic">Umum</span>
                                @endif
                            </td>

                            <!-- Before & After Thumbnails -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="text-center">
                                        @if($project->before_image)
                                            <img src="{{ asset('storage/' . $project->before_image) }}" alt="Before" class="w-12 h-9 rounded-lg object-cover border border-slate-200">
                                        @else
                                            <div class="w-12 h-9 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-[9px] text-slate-400 font-bold">No Before</div>
                                        @endif
                                        <span class="text-[9px] font-bold text-amber-700 uppercase">Before</span>
                                    </div>
                                    <x-heroicon-o-arrow-right class="w-3.5 h-3.5 text-slate-400 shrink-0" aria-hidden="true" />
                                    <div class="text-center">
                                        @if($project->after_image)
                                            <img src="{{ asset('storage/' . $project->after_image) }}" alt="After" class="w-12 h-9 rounded-lg object-cover border border-slate-200">
                                        @else
                                            <div class="w-12 h-9 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-[9px] text-slate-400 font-bold">No After</div>
                                        @endif
                                        <span class="text-[9px] font-bold text-emerald-700 uppercase">After</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Completed Date -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-mono">
                                {{ $project->completed_at ? $project->completed_at->format('d M Y') : '-' }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('project.edit')
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Proyek" aria-label="Edit {{ $project->title }}">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                                        </a>
                                    @endcan

                                    @can('project.delete')
                                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri proyek {{ $project->title }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Proyek" aria-label="Hapus {{ $project->title }}">
                                                <x-heroicon-o-trash class="w-4 h-4" aria-hidden="true" />
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-xs italic">
                                Belum ada galeri hasil kerja.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($projects->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
