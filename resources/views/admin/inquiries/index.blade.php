@extends('layouts.admin')

@section('title', 'Kotak Masuk Permintaan Penawaran')
@section('header-title', 'Inquiries & Leads')
@section('header-subtitle', 'Daftar permohonan penawaran harga (RFQ) dan pesan kontak dari calon klien')

@section('content')
<div class="space-y-6">

    <!-- Filter Status Tabs & Search Bar -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
        
        <!-- Filter Tabs -->
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 md:pb-0">
            <a href="{{ route('admin.inquiries.index') }}" class="px-4 py-2 rounded-2xl text-xs font-bold transition-all {{ empty($status) ? 'bg-[#24695c] text-white shadow-md shadow-[#24695c]/25' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Semua
            </a>
            <a href="{{ route('admin.inquiries.index', ['status' => 'new']) }}" class="px-4 py-2 rounded-2xl text-xs font-bold transition-all {{ $status === 'new' ? 'bg-rose-600 text-white shadow-md shadow-rose-600/25' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Baru
            </a>
            <a href="{{ route('admin.inquiries.index', ['status' => 'contacted']) }}" class="px-4 py-2 rounded-2xl text-xs font-bold transition-all {{ $status === 'contacted' ? 'bg-amber-600 text-white shadow-md shadow-amber-600/25' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Sudah Dihubungi
            </a>
            <a href="{{ route('admin.inquiries.index', ['status' => 'completed']) }}" class="px-4 py-2 rounded-2xl text-xs font-bold transition-all {{ $status === 'completed' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/25' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Selesai
            </a>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.inquiries.index') }}" class="max-w-xs">
            @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <div class="relative rounded-2xl">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-slate-400" aria-hidden="true" />
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari pengirim, email, perusahaan..." 
                    class="block w-full rounded-2xl border border-slate-200 pl-11 pr-4 py-2 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#24695c] focus:border-[#24695c] transition-all"
                >
            </div>
        </form>

    </div>

    <!-- Inquiries Table Card -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Nama Pengirim & Perusahaan</th>
                        <th scope="col" class="px-6 py-4">Kontak (Email / WA)</th>
                        <th scope="col" class="px-6 py-4">Layanan Diminta</th>
                        <th scope="col" class="px-6 py-4 text-center">Status</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Sender & Company -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900 font-heading text-sm">{{ $inquiry->name }}</div>
                                <div class="text-xs text-slate-400">{{ $inquiry->company_name ?: 'Perorangan' }}</div>
                            </td>

                            <!-- Contact -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                <div class="font-mono text-slate-800">{{ $inquiry->phone }}</div>
                                <div class="text-slate-400 font-sans">{{ $inquiry->email }}</div>
                            </td>

                            <!-- Requested Service -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#e2f4f1] text-[#24695c] border border-[#a2ded5]/60 font-heading">
                                    {{ $inquiry->service_requested ?: 'Permintaan Umum' }}
                                </span>
                            </td>

                            <!-- Status Badge & Form -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <select 
                                        name="status" 
                                        onchange="this.form.submit()" 
                                        class="text-[10px] font-bold uppercase rounded-full px-2.5 py-1 border cursor-pointer focus:outline-none transition-all {{ $inquiry->status === 'new' ? 'bg-rose-50 text-rose-700 border-rose-200' : ($inquiry->status === 'contacted' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200') }}"
                                    >
                                        <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>Baru</option>
                                        <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>Sudah Dihubungi</option>
                                        <option value="completed" {{ $inquiry->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Lihat Detail Pesan" aria-label="Lihat detail pesan dari {{ $inquiry->name }}">
                                        <x-heroicon-o-eye class="w-4 h-4" aria-hidden="true" />
                                    </a>

                                    @can('inquiry.delete')
                                        <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permohonan dari {{ $inquiry->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Data" aria-label="Hapus permohonan dari {{ $inquiry->name }}">
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
                                Belum ada pesan permohonan penawaran masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
