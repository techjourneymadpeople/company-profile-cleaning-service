@extends('layouts.admin')

@section('title', 'Manajemen Role')
@section('header-title', 'Role & Permission Management')
@section('header-subtitle', 'Kelola level peran (roles) dan konfigurasikan pembagian hak akses sistem')

@section('content')
<div class="space-y-6">

    <!-- Top Bar Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Peran Pengguna (Roles)</h2>
            <p class="text-xs text-slate-400">Total {{ $roles->count() }} peran terdaftar dalam sistem</p>
        </div>

        @can('role.create')
            <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-plus-circle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Role Baru</span>
            </a>
        @endcan
    </div>

    <!-- Roles Table Card -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Nama Role</th>
                        <th scope="col" class="px-6 py-4">Hak Akses (Permissions)</th>
                        <th scope="col" class="px-6 py-4">Jumlah Pengguna</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($roles as $role)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Role Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-[#e2f4f1] text-[#24695c] flex items-center justify-center font-bold">
                                        <x-heroicon-o-shield-check class="w-5 h-5" aria-hidden="true" />
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 font-heading text-sm">{{ $role->name }}</div>
                                        <div class="text-[11px] text-slate-400">Guard: <code>{{ $role->guard_name }}</code></div>
                                    </div>
                                </div>
                            </td>

                            <!-- Permissions Overview -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#e2f4f1] text-[#24695c] border border-[#a2ded5]/60 font-heading">
                                        {{ $role->permissions->count() }} Permissions
                                    </span>
                                    @if(in_array(strtolower($role->name), ['super admin', 'superadmin']))
                                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                                            Full Access (Semua)
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Users Count -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-700 font-semibold font-mono">
                                {{ $role->users->count() }} Pengguna
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('role.edit')
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Role & Permissions" aria-label="Edit {{ $role->name }}">
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
                                        @else
                                            <span class="p-2 rounded-xl text-slate-300 border border-slate-100 cursor-not-allowed" title="Super Admin tidak dapat dihapus">
                                                <x-heroicon-o-lock-closed class="w-4 h-4" aria-hidden="true" />
                                            </span>
                                        @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-xs italic">
                                Belum ada role yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
