@extends('layouts.admin')

@section('title', 'Kelola Menu Dinamis')
@section('header-title', 'Dynamic Menu Management')
@section('header-subtitle', 'Kelola urutan dan hak akses menu navigasi sidebar admin panel')

@section('content')
<div class="space-y-6">

    <!-- Top Action Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Menu Navigasi</h2>
            <p class="text-xs text-slate-400">Total {{ $menus->count() }} menu navigasi terdaftar</p>
        </div>

        @can('menu.create')
            <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-plus-circle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Menu Baru</span>
            </a>
        @endcan
    </div>

    <!-- Menus Table Card with DataTable -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden p-2 sm:p-4">
        <div class="overflow-x-auto">
            <table class="datatable w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4 w-16 text-center">Urutan</th>
                        <th scope="col" class="px-6 py-4">Judul Menu</th>
                        <th scope="col" class="px-6 py-4">Nama Rute / URL</th>
                        <th scope="col" class="px-6 py-4">Syarat Permission</th>
                        <th scope="col" class="px-6 py-4 text-center">Status</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($menus as $menu)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Order Number -->
                            <td class="px-6 py-4 text-center font-mono font-bold text-xs">
                                <span class="w-7 h-7 rounded-xl bg-slate-100 text-slate-700 inline-flex items-center justify-center">
                                    {{ $menu->order }}
                                </span>
                            </td>

                            <!-- Title & Icon -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-2xl bg-[#e2f4f1] text-[#24695c] flex items-center justify-center">
                                        @if($menu->icon && str_starts_with($menu->icon, 'heroicon-'))
                                            <x-dynamic-component :component="$menu->icon" class="w-5 h-5" aria-hidden="true" />
                                        @else
                                            <x-heroicon-o-link class="w-5 h-5" aria-hidden="true" />
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 font-heading text-sm">{{ $menu->title }}</div>
                                        @if($menu->parent)
                                            <div class="text-[11px] text-slate-400">Sub dari: {{ $menu->parent->title }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Route -->
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-slate-700">
                                {{ $menu->route ?: '-' }}
                            </td>

                            <!-- Required Permission -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($menu->permission_name)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-[#e2f4f1] text-[#24695c] border border-[#a2ded5]/60">
                                        {{ $menu->permission_name }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400 italic">Semua Role (Publik Admin)</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($menu->is_active)
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full border border-slate-200">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('menu.edit')
                                        <a href="{{ route('admin.menus.edit', $menu) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Menu" aria-label="Edit {{ $menu->title }}">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                                        </a>
                                    @endcan

                                    @can('menu.delete')
                                        <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $menu->title }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Menu" aria-label="Hapus {{ $menu->title }}">
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
