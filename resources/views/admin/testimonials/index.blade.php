@extends('layouts.admin')

@section('title', 'Testimoni Klien')
@section('header-title', 'Client Testimonials')
@section('header-subtitle', 'Kelola ulasan kepuasan dan rating pelanggan institusi maupun perorangan')

@section('content')
<div class="space-y-6">

    <!-- Top Action Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Testimoni & Review</h2>
            <p class="text-xs text-slate-400">Total {{ $testimonials->count() }} ulasan kepuasan klien</p>
        </div>

        @can('testimonial.create')
            <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-plus-circle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Testimoni Baru</span>
            </a>
        @endcan
    </div>

    <!-- Testimonials Table Card with DataTable -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden p-2 sm:p-4">
        <div class="overflow-x-auto">
            <table class="datatable w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Klien & Perusahaan</th>
                        <th scope="col" class="px-6 py-4">Rating</th>
                        <th scope="col" class="px-6 py-4">Kutipan Ulasan</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($testimonials as $testimonial)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Client Details -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#24695c] to-[#4aa897] text-white flex items-center justify-center font-bold text-sm font-heading shadow-sm ring-2 ring-[#e2f4f1]">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 font-heading text-sm">{{ $testimonial->name }}</div>
                                        <div class="text-xs text-slate-400">{{ $testimonial->designation_company ?: '-' }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Rating Stars -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-0.5 text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <x-heroicon-s-star class="w-4 h-4 text-amber-400" />
                                        @else
                                            <x-heroicon-o-star class="w-4 h-4 text-slate-300" />
                                        @endif
                                    @endfor
                                    <span class="ml-1 text-xs font-bold text-slate-700 font-mono">({{ $testimonial->rating }}.0)</span>
                                </div>
                            </td>

                            <!-- Quote -->
                            <td class="px-6 py-4 max-w-md text-xs text-slate-600 italic">
                                "{{ Str::limit($testimonial->quote, 120) }}"
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('testimonial.edit')
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Testimoni" aria-label="Edit {{ $testimonial->name }}">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                                        </a>
                                    @endcan

                                    @can('testimonial.delete')
                                        <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni {{ $testimonial->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Testimoni" aria-label="Hapus {{ $testimonial->name }}">
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
