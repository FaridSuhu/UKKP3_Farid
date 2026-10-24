@extends('layouts.app')
@section('title', 'Detail Pengaduan')

@section('content')

<div class="mb-5">
    <h2 class="text-xl font-semibold text-gray-800">Detail Pengaduan</h2>
    <p class="text-sm text-gray-500">Informasi lengkap pengaduan</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- Detail Info --}}
    <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-700">Informasi Pengaduan</h3>
            @if($pelayanan->status == 'pending')
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Pending
                </span>
            @elseif($pelayanan->status == 'proses')
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-medium bg-blue-100 text-blue-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Proses
                </span>
            @else
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded text-xs font-medium bg-green-100 text-green-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai
                </span>
            @endif
        </div>

        <div class="p-6 space-y-5">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <p class="text-xs uppercase text-gray-500 font-medium tracking-wide mb-1">Nama</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pelayanan->nama }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase text-gray-500 font-medium tracking-wide mb-1">Email</p>
                    <p class="text-sm text-gray-700">{{ $pelayanan->email }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase text-gray-500 font-medium tracking-wide mb-1">No Telp</p>
                    <p class="text-sm text-gray-700">{{ $pelayanan->no_telp }}</p>
                </div>
            </div>
            <div>
                    <p class="text-xs uppercase text-gray-500 font-medium tracking-wide mb-1">Judul Pengaduan</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pelayanan->judul }}</p>
                </div>

            <div class="pt-4 border-t border-gray-100">
                <p class="text-xs uppercase text-gray-500 font-medium tracking-wide mb-2">Isi Pengaduan</p>
                <div class="bg-gray-50 rounded p-4 text-sm text-gray-700 leading-relaxed">
                    {{ $pelayanan->pengaduan }}
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 text-xs text-gray-500">
                <p>Dibuat: {{ $pelayanan->created_at->format('d M Y H:i') }}</p>
                <p>Diperbarui: {{ $pelayanan->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>

    {{-- Foto --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700">Foto Bukti</h3>
        </div>
        <div class="p-6">
            @if($pelayanan->foto)
                <a href="{{ asset('storage/'.$pelayanan->foto) }}" target="_blank">
                    <img src="{{ asset('storage/'.$pelayanan->foto) }}" class="w-full rounded border border-gray-200 hover:opacity-90">
                </a>
                <p class="text-xs text-gray-500 mt-3 text-center">Klik gambar untuk memperbesar</p>
            @else
                <div class="text-center py-8 text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm">Tidak ada foto</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="mt-5 flex items-center gap-2">
    <a href="{{ route('pelayanan.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
    <a href="{{ route('pelayanan.edit', $pelayanan) }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        Edit
    </a>
</div>

@endsection
