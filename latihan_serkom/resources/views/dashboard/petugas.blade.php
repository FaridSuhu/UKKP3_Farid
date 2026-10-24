@extends('layouts.app')
@section('title', 'Dashboard Petugas')

@section('content')

<div class="mb-5">
    <h2 class="text-xl font-semibold text-gray-800">Overview</h2>
    <p class="text-sm text-gray-500">Ringkasan tugas petugas</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="w-10 h-10 bg-blue-50 rounded flex items-center justify-center mb-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Total Customer</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_customer']) }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="w-10 h-10 bg-green-50 rounded flex items-center justify-center mb-2">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Total Barang</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_barang']) }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="w-10 h-10 bg-yellow-50 rounded flex items-center justify-center mb-2">
            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
            </svg>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Menu</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_menu']) }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="w-10 h-10 bg-red-50 rounded flex items-center justify-center mb-2">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Pengaduan</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_pengaduan']) }}</p>
    </div>
</div>

{{-- Pengaduan Terbaru --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-100">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-semibold text-gray-700">Pengaduan Terbaru</h3>
        <a href="{{ route('pelayanan.index') }}" class="text-sm text-primary hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-5 py-3 text-left font-medium">Nama</th>
                    <th class="px-5 py-3 text-left font-medium">Email</th>
                    <th class="px-5 py-3 text-left font-medium">Pengaduan</th>
                    <th class="px-5 py-3 text-left font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse(\App\Models\Pelayanan::latest()->take(5)->get() as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $p->nama }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $p->email }}</td>
                    <td class="px-5 py-3 text-gray-600 truncate max-w-xs">{{ Str::limit($p->pengaduan, 40) }}</td>
                    <td class="px-5 py-3">
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium
                            @if($p->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($p->status == 'proses') bg-blue-100 text-blue-700
                            @else bg-green-100 text-green-700 @endif">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-gray-400">Belum ada pengaduan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection