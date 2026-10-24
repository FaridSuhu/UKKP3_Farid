@extends('layouts.app')
@section('title', 'Daftar Barang')

@section('content')

<div class="mb-5 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Daftar Barang</h2>
        <p class="text-sm text-gray-500">Kelola data barang</p>
    </div>
    <a href="{{ route('barang.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Barang
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs uppercase text-gray-500">
            <tr>
                <th class="px-5 py-3 text-left font-medium w-12">No</th>
                <th class="px-5 py-3 text-left font-medium">Nama Barang</th>
                <th class="px-5 py-3 text-left font-medium">Kode</th>
                <th class="px-5 py-3 text-left font-medium">Stok</th>
                <th class="px-5 py-3 text-left font-medium">Harga</th>
                <th class="px-5 py-3 text-center font-medium w-40">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($barang as $i => $b)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-3 text-gray-500">{{ $barang->firstItem() + $i }}</td>
                <td class="px-5 py-3 font-medium text-gray-800">{{ $b->nama_barang }}</td>
                <td class="px-5 py-3">
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-mono font-medium bg-blue-50 text-blue-700 border border-blue-100">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        {{ $b->kode }}
                    </span>
                </td>
                <td class="px-5 py-3 text-gray-600">{{ $b->stok }}</td>
                <td class="px-5 py-3 text-gray-700 font-medium">Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                <td class="px-5 py-3">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('barang.edit', $b) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100">
                            Edit
                        </a>
                        <form action="{{ route('barang.destroy', $b) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-700 bg-red-50 rounded hover:bg-red-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    Belum ada data barang
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $barang->links() }}</div>

@endsection