@extends('layouts.admin')

@section('title', 'Manajemen Permission')
@section('header-title', 'Permission Management')
@section('header-subtitle', 'Kelola daftar izin aksi dan kewenangan teknis sistem')

@section('content')
<div class="space-y-6">

    <!-- Top Action Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Hak Akses Sistem</h2>
            <p class="text-xs text-slate-400">Total {{ $permissions->count() }} permissions terdaftar</p>
        </div>

        @can('permission.create')
            <a href="{{ route('admin.permissions.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-key class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Permission</span>
            </a>
        @endcan
    </div>

    <!-- Permissions Table Card with DataTable -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden p-2 sm:p-4">
        <div class="overflow-x-auto">
            <table class="datatable w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Nama Permission</th>
                        <th scope="col" class="px-6 py-4">Modul / Grup</th>
                        <th scope="col" class="px-6 py-4">Role Terkait</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($permissions as $permission)
                        @php
                            $parts = explode('.', $permission->name);
                            $module = count($parts) > 1 ? ucfirst($parts[0]) : 'General';
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-[#e2f4f1] text-[#24695c] flex items-center justify-center font-mono font-bold text-xs">
                                        <x-heroicon-o-key class="w-4 h-4" aria-hidden="true" />
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 font-mono text-xs">{{ $permission->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono">guard: {{ $permission->guard_name }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Module -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 uppercase font-heading">
                                    {{ $module }}
                                </span>
                            </td>

                            <!-- Roles with this permission -->
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($permission->roles as $role)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-[#e2f4f1] text-[#24695c] border border-[#a2ded5]/60">
                                            {{ $role->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-slate-400 italic">Belum ada role</span>
                                    @endforelse
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('permission.edit')
                                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Permission" aria-label="Edit {{ $permission->name }}">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                                        </a>
                                    @endcan

                                    @can('permission.delete')
                                        <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permission {{ $permission->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Permission" aria-label="Hapus {{ $permission->name }}">
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
