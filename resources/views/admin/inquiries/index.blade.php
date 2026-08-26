@extends('layouts.admin')

@section('title', 'Kotak Masuk Permintaan Penawaran')
@section('header-title', 'Inquiries & Leads')
@section('header-subtitle', 'Daftar permohonan penawaran harga (RFQ) dan pesan kontak dari calon klien')

@section('content')
<div class="space-y-6">

    <!-- Top Info Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Permintaan Penawaran (Leads)</h2>
            <p class="text-xs text-slate-400">Total {{ $inquiries->count() }} permohonan masuk</p>
        </div>

        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                {{ $inquiries->where('status', 'new')->count() }} Leads Baru
            </span>
        </div>
    </div>

    <!-- Inquiries Table Card with DataTable -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden p-2 sm:p-4">
        <div class="overflow-x-auto">
            <table class="datatable w-full text-left text-sm text-slate-600">
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
                    @foreach($inquiries as $inquiry)
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
