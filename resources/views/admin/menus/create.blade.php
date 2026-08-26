@extends('layouts.admin')

@section('title', 'Tambah Menu Baru')
@section('header-title', 'Create New Menu')
@section('header-subtitle', 'Buat menu navigasi baru untuk sidebar sistem')

@section('content')
<div class="max-w-2xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)]">
        
        <div class="flex items-center justify-between pb-5 border-b border-slate-100 mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Formulir Tambah Menu Navigasi</h2>
                <p class="text-xs text-slate-400">Tentukan rute, ikon, permission, dan urutan tampil</p>
            </div>
            <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('admin.menus.store') }}" class="space-y-5" novalidate>
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Judul Menu <span class="text-rose-500" aria-hidden="true">*</span>
                </label>
                <input 
                    id="title" 
                    name="title" 
                    type="text" 
                    required 
                    value="{{ old('title') }}"
                    placeholder="Contoh: Booking Layanan"
                    class="mt-1.5 block w-full rounded-2xl border {{ $errors->has('title') ? 'border-rose-400 focus:border-rose-600' : 'border-slate-200 focus:border-[#24695c] focus:ring-[#24695c]' }} px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                @error('title')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Route & Order Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="route" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Nama Route / URL
                    </label>
                    <input 
                        id="route" 
                        name="route" 
                        type="text" 
                        value="{{ old('route') }}"
                        placeholder="Contoh: admin.bookings.index"
                        class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                    @error('route')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Urutan Tampil <span class="text-rose-500" aria-hidden="true">*</span>
                    </label>
                    <input 
                        id="order" 
                        name="order" 
                        type="number" 
                        min="0"
                        required 
                        value="{{ old('order', 1) }}"
                        class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                    @error('order')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Icon -->
            <div>
                <label for="icon" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Identifier Icon Heroicons
                </label>
                <input 
                    id="icon" 
                    name="icon" 
                    type="text" 
                    value="{{ old('icon', 'heroicon-o-folder') }}"
                    placeholder="Contoh: heroicon-o-sparkles atau heroicon-o-users"
                    class="mt-1.5 block w-full font-mono rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                >
                <p class="mt-1 text-[11px] text-slate-400">Nama ikon dari library Blade Heroicons (contoh: <code>heroicon-o-squares-2x2</code>, <code>heroicon-o-users</code>, <code>heroicon-o-cog-6-tooth</code>).</p>
            </div>

            <!-- Required Permission & Parent Menu Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="permission_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Syarat Permission (Hak Akses)
                    </label>
                    <select 
                        id="permission_name" 
                        name="permission_name" 
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-3.5 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all font-mono"
                    >
                        <option value="">-- Tanpa Syarat (Terbuka) --</option>
                        @foreach($permissions as $perm)
                            <option value="{{ $perm->name }}" {{ old('permission_name') == $perm->name ? 'selected' : '' }}>
                                {{ $perm->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="parent_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                        Parent Menu (Sub-Menu Dari)
                    </label>
                    <select 
                        id="parent_id" 
                        name="parent_id" 
                        class="mt-1.5 block w-full rounded-2xl border border-slate-200 focus:border-[#24695c] focus:ring-[#24695c] px-3.5 py-3 text-sm text-slate-900 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 transition-all"
                    >
                        <option value="">-- Menu Utama (Root) --</option>
                        @foreach($parentMenus as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Is Active Checkbox -->
            <div class="pt-2">
                <label class="inline-flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1" 
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-slate-300 text-[#24695c] focus:ring-[#24695c]"
                    >
                    <span class="ml-2.5 text-xs font-bold text-slate-800 select-none">Status Menu Aktif (Tampilkan di Sidebar)</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.menus.index') }}" class="px-5 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors font-heading uppercase">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-lg shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] cursor-pointer font-heading uppercase tracking-wider">
                    <x-heroicon-o-check class="w-4 h-4" aria-hidden="true" />
                    <span>Simpan Menu</span>
                </button>
            </div>
        </form>

    </div>

</div>
@endsection
