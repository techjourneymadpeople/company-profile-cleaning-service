@extends('layouts.admin')

@section('title', 'Detail Permintaan Penawaran: ' . $inquiry->name)
@section('header-title', 'Inquiry Details')
@section('header-subtitle', 'Rincian pesan permohonan penawaran harga dari calon klien')

@section('content')
<div class="max-w-3xl space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] space-y-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between pb-5 border-b border-slate-100">
            <div>
                <h2 class="text-base font-bold text-slate-900 font-heading">Permintaan dari {{ $inquiry->name }}</h2>
                <p class="text-xs text-slate-400">Diterima pada: {{ $inquiry->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]">
                <x-heroicon-o-arrow-left class="w-4 h-4" aria-hidden="true" />
                <span>Kembali</span>
            </a>
        </div>

        <!-- Contact & Company Info Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5 bg-slate-50/80 rounded-3xl border border-slate-200/70">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-heading">Nama Pengirim</span>
                <p class="font-bold text-slate-900 text-sm mt-0.5">{{ $inquiry->name }}</p>
            </div>
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-heading">Perusahaan / Instansi</span>
                <p class="font-bold text-slate-900 text-sm mt-0.5">{{ $inquiry->company_name ?: '-' }}</p>
            </div>
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-heading">Email Bisnis</span>
                <p class="font-medium text-slate-800 text-sm mt-0.5">
                    <a href="mailto:{{ $inquiry->email }}" class="text-[#24695c] hover:underline">{{ $inquiry->email }}</a>
                </p>
            </div>
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-heading">Nomor Telepon / WhatsApp</span>
                <p class="font-mono font-medium text-slate-800 text-sm mt-0.5">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank" class="text-emerald-700 hover:underline inline-flex items-center gap-1">
                        {{ $inquiry->phone }}
                        <x-heroicon-o-arrow-top-right-on-square class="w-3.5 h-3.5 text-emerald-600" />
                    </a>
                </p>
            </div>
            <div class="sm:col-span-2 pt-2 border-t border-slate-200/50">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-heading">Layanan Yang Diminta</span>
                <p class="font-bold text-[#24695c] text-sm mt-0.5">{{ $inquiry->service_requested ?: 'Permintaan Umum' }}</p>
            </div>
        </div>

        <!-- Message Body -->
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 font-heading mb-2">Pesan & Kebutuhan Spesifik:</h3>
            <div class="p-5 bg-white rounded-2xl border border-slate-200 text-sm text-slate-800 leading-relaxed whitespace-pre-line">
                {{ $inquiry->message }}
            </div>
        </div>

        <!-- Status Management -->
        <div class="pt-5 border-t border-slate-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
            <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}" class="flex items-center gap-3">
                @csrf
                @method('PUT')
                <label for="status" class="text-xs font-bold uppercase tracking-wider text-slate-700 font-heading">
                    Ubah Status:
                </label>
                <select 
                    id="status" 
                    name="status" 
                    class="rounded-2xl border border-slate-200 focus:border-[#24695c] px-3.5 py-2 text-xs font-bold text-slate-800 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#24695c] transition-all"
                >
                    <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>Baru</option>
                    <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>Sudah Dihubungi</option>
                    <option value="completed" {{ $inquiry->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="px-4 py-2 rounded-2xl text-xs font-bold text-white bg-[#24695c] hover:bg-[#1b5247] transition-all focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase">
                    Update Status
                </button>
            </form>

            <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data permohonan penawaran ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-2xl text-xs font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer font-heading uppercase">
                    <x-heroicon-o-trash class="w-4 h-4" aria-hidden="true" />
                    <span>Hapus Pesan</span>
                </button>
            </form>
        </div>

    </div>

</div>
@endsection
