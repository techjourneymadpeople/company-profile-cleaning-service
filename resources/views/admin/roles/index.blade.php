@extends('layouts.admin')

@section('title', 'Manajemen Role')
@section('header-title', 'Role Management')
@section('header-subtitle', 'Kelola peran pengguna dan pembatasan wewenang sistem')

@section('content')
<div class="space-y-6">

    <!-- Top Action Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Role & Peran Pengguna</h2>
            <p class="text-xs text-slate-400">Total {{ $roles->count() }} role sistem aktif</p>
        </div>

        @can('role.create')
            <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-shield-check class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Role Baru</span>
            </a>
        @endcan
    </div>

    <!-- Roles Table Card with DataTable -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden p-2 sm:p-4">
        <div class="overflow-x-auto">
            <table class="datatable w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Nama Role</th>
                        <th scope="col" class="px-6 py-4">Total Pengguna</th>
                        <th scope="col" class="px-6 py-4">Total Hak Akses (Permissions)</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($roles as $role)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Role Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-2xl bg-[#e2f4f1] text-[#24695c] flex items-center justify-center font-bold">
                                        <x-heroicon-o-shield-check class="w-5 h-5" aria-hidden="true" />
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 font-heading text-sm">{{ $role->name }}</div>
                                        <div class="text-[11px] font-mono text-slate-400">guard: {{ $role->guard_name }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Total Users Assigned -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 font-mono">
                                    <x-heroicon-o-users class="w-3.5 h-3.5 text-slate-400" aria-hidden="true" />
                                    {{ $role->users->count() }} Pengguna
                                </span>
                            </td>

                            <!-- Total Permissions -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($role->name === 'Super Admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 font-heading uppercase">
                                        Semua Hak Akses (Bypass)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#e2f4f1] text-[#24695c] border border-[#a2ded5]/60 font-heading uppercase">
                                        {{ $role->permissions->count() }} Hak Akses Terpasang
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('role.edit')
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Role & Permission" aria-label="Edit {{ $role->name }}">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                                        </a>
                                    @endcan

                                    @can('role.delete')
                                        @if(!in_array(strtolower($role->name), ['super admin', 'superadmin']))
                                            <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus role {{ $role->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Role" aria-label="Hapus {{ $role->name }}">
                                                    <x-heroicon-o-trash class="w-4 h-4" aria-hidden="true" />
                                                </button>
                                            </form>
                                        @endif
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
