@extends('layouts.admin')

@section('title', 'Edit Role: ' . $role->name)
@section('header-title', 'Edit Role & Permissions')
@section('header-subtitle', 'Perbarui nama peran dan kelola penugasan hak akses (Role Assign To Permission)')

@section('content')
<div class="space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Edit Role: {{ $role->name }}</h2>
                <p class="text-xs text-slate-400">ID Role: #{{ $role->id }} • {{ $role->users->count() }} Pengguna Terhubung</p>
            </div>
            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-6" novalidate>
            @csrf
            @method('PUT')

            <!-- Role Name -->
            <div class="max-w-md">
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Nama Role <span class="text-rose-500" aria-hidden="true">*</span>
                </label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    required 
                    value="{{ old('name', $role->name) }}"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('name') ? 'border-rose-400 focus:border-rose-600 focus:ring-rose-500' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('name')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role Assign To Permission Matrix -->
            <div class="pt-4 border-t border-slate-100">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-key class="w-5 h-5 text-[#24695c]" aria-hidden="true" />
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 font-heading">Penugasan Hak Akses (Role Assign To Permission)</h3>
                            <p class="text-xs text-slate-400">Centang permission yang diizinkan untuk role ini</p>
                        </div>
                    </div>
                    
                    <button type="button" id="toggle-select-all" class="px-3.5 py-1.5 rounded-xl text-xs font-bold text-[#24695c] bg-[#e2f4f1] hover:bg-[#24695c] hover:text-white transition-colors cursor-pointer self-start sm:self-auto font-heading">
                        Pilih Semua (Select All)
                    </button>
                </div>

                <!-- Grouped Permissions Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($groupedPermissions as $moduleName => $permissions)
                        <div class="p-5 rounded-3xl bg-slate-50/70 border border-slate-200/70 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-3 border-b border-slate-200 mb-3">
                                    <span class="text-xs font-black uppercase text-[#24695c] tracking-wider font-heading">Modul: {{ $moduleName }}</span>
                                    <span class="text-[10px] bg-white border border-slate-200 px-2 py-0.5 rounded-full text-slate-500 font-mono">{{ count($permissions) }} items</span>
                                </div>

                                <div class="space-y-2.5">
                                    @foreach($permissions as $permission)
                                        <label class="flex items-start gap-2.5 p-2 rounded-xl hover:bg-white hover:shadow-xs transition-colors cursor-pointer">
                                            <input 
                                                type="checkbox" 
                                                name="permissions[]" 
                                                value="{{ $permission->name }}"
                                                {{ in_array($permission->name, old('permissions', $rolePermissionNames)) ? 'checked' : '' }}
                                                class="permission-checkbox mt-0.5 h-4 w-4 rounded border-slate-300 text-[#24695c] focus:ring-[#24695c]"
                                            >
                                            <div class="text-xs">
                                                <span class="font-bold text-slate-800 font-mono">{{ $permission->name }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('permissions')
                    <p class="mt-2 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.roles.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Perbarui Role</span>
                </button>
            </div>
        </form>

    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('toggle-select-all');
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        let allSelected = false;

        toggleBtn.addEventListener('click', () => {
            allSelected = !allSelected;
            checkboxes.forEach(cb => cb.checked = allSelected);
            toggleBtn.textContent = allSelected ? 'Batalkan Pilihan Semua' : 'Pilih Semua (Select All)';
        });
    });
</script>
@endpush
@endsection
