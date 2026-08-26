@extends('layouts.admin')

@section('title', 'Akreditasi & Sertifikasi ISO')
@section('header-title', 'Certificates & Accreditations')
@section('header-subtitle', 'Kelola lisensi mutu, sertifikat ISO, dan standar legalitas operasional B2B')

@section('content')
<div class="space-y-6">

    <!-- Top Action Card -->
    <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-slate-900 font-heading">Daftar Sertifikat & Akreditasi</h2>
            <p class="text-xs text-slate-400">Total {{ $certificates->count() }} sertifikat terdaftar</p>
        </div>

        @can('certificate.create')
            <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-bold text-white bg-[#24695c] hover:bg-[#1b5247] shadow-md shadow-[#24695c]/25 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c] font-heading uppercase tracking-wider">
                <x-heroicon-o-plus-circle class="w-4 h-4 text-teal-200" aria-hidden="true" />
                <span>Tambah Sertifikat Baru</span>
            </a>
        @endcan
    </div>

    <!-- Certificates Table Card with DataTable -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_5px_25px_rgba(8,21,66,0.03)] overflow-hidden p-2 sm:p-4">
        <div class="overflow-x-auto">
            <table class="datatable w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 font-heading border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Nama Sertifikat</th>
                        <th scope="col" class="px-6 py-4">Lembaga Penerbit</th>
                        <th scope="col" class="px-6 py-4">Nomor Lisensi</th>
                        <th scope="col" class="px-6 py-4">Masa Berlaku</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($certificates as $cert)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Certificate Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-2xl bg-[#e2f4f1] text-[#24695c] flex items-center justify-center font-bold">
                                        <x-heroicon-o-academic-cap class="w-5 h-5" aria-hidden="true" />
                                    </div>
                                    <div class="font-bold text-slate-900 font-heading text-sm">{{ $cert->name }}</div>
                                </div>
                            </td>

                            <!-- Issuer -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-700">
                                {{ $cert->issuer ?: '-' }}
                            </td>

                            <!-- License Number -->
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-slate-600">
                                {{ $cert->license_number ?: '-' }}
                            </td>

                            <!-- Valid Until -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-mono">
                                @if($cert->valid_until)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        {{ $cert->valid_until->format('d M Y') }}
                                    </span>
                                @else
                                    <span class="text-slate-400 italic">Tanpa Batas</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="inline-flex items-center gap-2">
                                    @can('certificate.edit')
                                        <a href="{{ route('admin.certificates.edit', $cert) }}" class="p-2 rounded-xl text-slate-500 hover:text-[#24695c] hover:bg-[#e2f4f1] border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#24695c]" title="Edit Sertifikat" aria-label="Edit {{ $cert->name }}">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" aria-hidden="true" />
                                        </a>
                                    @endcan

                                    @can('certificate.delete')
                                        <form method="POST" action="{{ route('admin.certificates.destroy', $cert) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikat {{ $cert->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 cursor-pointer" title="Hapus Sertifikat" aria-label="Hapus {{ $cert->name }}">
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
