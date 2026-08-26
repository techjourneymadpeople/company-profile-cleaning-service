@extends('layouts.admin')

@section('title', 'Klien & Mitra Perusahaan')
@section('header-title', 'Clients & Partners')
@section('header-subtitle', 'Kelola daftar logo korporat/instansi yang pernah bekerja sama (Trusted By)')

@section('content')
<div class="space-y-6">

    <!-- Top Action & Search Bar -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.clients.index') }}" class="flex-1 max-w-md">
            <div class="relative rounded-2xl">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-slate-400" aria-hidden="true" />
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari nama klien / mitra..." 
                    class="block w-full rounded-2xl border border-slate-200 pl-11 pr-4 py-2.5 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#24695c] focus:border-[#24695c] transition-all"
                >
            </div>
        </form>

        @can('client.create')
            <a href="{{ route('admin.clients.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-plus-circle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Klien Baru</span>
            </a>
        @endcan
    </div>

    <!-- Clients Table Card -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4 w-16 text-center">Urutan</th>
                        <th scope="col" class="px-6 py-4">Nama Perusahaan / Klien</th>
                        <th scope="col" class="px-6 py-4">Logo Klien</th>
                        <th scope="col" class="px-6 py-4 text-center">Status Tampil</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($clients as $client)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Sort Order -->
                            <td class="px-6 py-4 text-center font-mono font-bold text-xs">
                                <span class="w-7 h-7 rounded-xl bg-slate-100 text-slate-700 inline-flex items-center justify-center">
                                    {{ $client->sort_order }}
                                </span>
                            </td>

                            <!-- Client Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900 font-heading text-sm">{{ $client->name }}</div>
                            </td>

                            <!-- Logo Preview -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($client->logo_path)
                                    <div class="p-2 bg-slate-50 border border-slate-100 rounded-xl inline-block">
                                        <img src="{{ asset('storage/' . $client->logo_path) }}" alt="{{ $client->name }}" class="h-8 max-w-[120px] object-contain">
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 italic">No Logo (Default Text)</span>
                                @endif
                            </td>

                            <!-- Status Visible -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($client->is_visible)
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Show
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full border border-slate-200">
                                        Hide
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('client.edit')
                                        <a href="{{ route('admin.clients.edit', $client) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Klien" aria-label="Edit {{ $client->name }}">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                                        </a>
                                    @endcan

                                    @can('client.delete')
                                        <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus klien {{ $client->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Klien" aria-label="Hapus {{ $client->name }}">
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
                                Belum ada data klien / mitra.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($clients->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $clients->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
