@extends('layouts.app')
@section('title', 'Tambah Barang')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="mb-5">
        <h2 class="text-xl font-semibold text-gray-800">Tambah Barang</h2>
        <p class="text-sm text-gray-500">Isi data barang baru</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700">Form Barang</h3>
        </div>

        <form method="POST" action="{{ route('barang.store') }}" class="p-6 space-y-4">
            @csrf

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                    </ul>
                </div>
            @endif

            {{-- Kode Barang: Auto-generated, disabled --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kode Barang
                    <span class="text-xs text-gray-400 font-normal">(otomatis)</span>
                </label>
                <div class="flex items-center gap-2">
                    <input type="text" value="{{ $kodeOtomatis }}" readonly
                        class="w-full px-3 py-2 text-sm border border-gray-200 bg-gray-50 rounded text-gray-600 font-mono cursor-not-allowed">
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-700 whitespace-nowrap">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Auto
                    </span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Kode dibuat otomatis oleh sistem</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required autofocus
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', 0) }}" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" step="0.01" name="harga" value="{{ old('harga', 0) }}" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
            </div>

            <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
                <a href="{{ route('barang.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection