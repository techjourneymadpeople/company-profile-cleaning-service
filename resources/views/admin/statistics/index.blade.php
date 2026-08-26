@extends('layouts.admin')

@section('title', 'Angka Pencapaian & Counter')
@section('header-title', 'Statistics & Counters')
@section('header-subtitle', 'Kelola metrik pencapaian perusahaan yang ditampilkan pada halaman beranda')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Statistik Pencapaian</h2>
            <p class="text-xs text-slate-400">Total {{ $statistics->count() }} metrik aktif</p>
        </div>

        @can('statistic.create')
            <a href="{{ route('admin.statistics.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-plus-circle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Counter Baru</span>
            </a>
        @endcan
    </div>

    <!-- Statistics Grid & Table -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach($statistics as $stat)
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="w-7 h-7 rounded-xl bg-[#e2f4f1] text-[#24695c] font-bold text-xs flex items-center justify-center">
                            #{{ $stat->sort_order }}
                        </span>
                        <div class="w-10 h-10 rounded-2xl bg-[#e2f4f1] text-[#24695c] flex items-center justify-center">
                            @if($stat->icon && str_starts_with($stat->icon, 'heroicon-'))
                                <x-dynamic-component :component="$stat->icon" class="w-5 h-5" aria-hidden="true" />
                            @else
                                <x-heroicon-o-chart-bar class="w-5 h-5" aria-hidden="true" />
                            @endif
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="text-3xl font-black text-slate-900 font-heading">{{ $stat->value }}</div>
                        <div class="mt-1 text-xs font-semibold text-slate-500">{{ $stat->label }}</div>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-end gap-2 text-xs">
                    @can('statistic.edit')
                        <a href="{{ route('admin.statistics.edit', $stat) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Counter" aria-label="Edit {{ $stat->label }}">
                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                        </a>
                    @endcan

                    @can('statistic.delete')
                        <form method="POST" action="{{ route('admin.statistics.destroy', $stat) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus counter {{ $stat->label }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Counter" aria-label="Hapus {{ $stat->label }}">
                                <x-heroicon-o-trash class="w-4 h-4" aria-hidden="true" />
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
