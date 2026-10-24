@extends('layouts.app')
@section('title', 'Makanan & Minuman')

@section('content')

<div class="mb-5 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Makanan & Minuman</h2>
        <p class="text-sm text-gray-500">Kelola menu makanan dan minuman</p>
    </div>
    <a href="{{ route('makanan-minuman.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Menu
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs uppercase text-gray-500">
            <tr>
                <th class="px-5 py-3 text-left font-medium w-12">No</th>
                <th class="px-5 py-3 text-left font-medium">Nama</th>
                <th class="px-5 py-3 text-left font-medium">Kategori</th>
                <th class="px-5 py-3 text-left font-medium">Harga</th>
                <th class="px-5 py-3 text-left font-medium">Stok</th>
                <th class="px-5 py-3 text-center font-medium w-40">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($items as $i => $item)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-3 text-gray-500">{{ $items->firstItem() + $i }}</td>
                <td class="px-5 py-3 font-medium text-gray-800">{{ $item->nama }}</td>
                <td class="px-5 py-3">
                    @if($item->kategori == 'makanan')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-700">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Makanan
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Minuman
                        </span>
                    @endif
                </td>
                <td class="px-5 py-3 text-gray-700 font-medium">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $item->stok }}</td>
                <td class="px-5 py-3">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('makanan-minuman.edit', $item) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100">
                            Edit
                        </a>
                        <form action="{{ route('makanan-minuman.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')">
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
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Belum ada menu
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $items->links() }}</div>

@endsection