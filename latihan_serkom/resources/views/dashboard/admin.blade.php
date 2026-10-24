@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

{{-- Header Section --}}
<div class="mb-5 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Overview</h2>
        <p class="text-sm text-gray-500">Ringkasan data sistem pengaduan</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('pelayanan.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Pengaduan
        </a>
        <a href="{{ route('users.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            Kelola User
        </a>
    </div>
</div>

{{-- Stats Cards Row --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">

    {{-- Total Users --}}
    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="flex justify-between items-start mb-2">
            <div class="w-10 h-10 bg-blue-50 rounded flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Total Users</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_user']) }}</p>
        <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-blue-500" style="width: 75%"></div>
        </div>
    </div>

    {{-- Total Barang --}}
    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="flex justify-between items-start mb-2">
            <div class="w-10 h-10 bg-green-50 rounded flex items-center justify-center">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Total Barang</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_barang']) }}</p>
        <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-green-500" style="width: 65%"></div>
        </div>
    </div>

    {{-- Total Menu --}}
    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="flex justify-between items-start mb-2">
            <div class="w-10 h-10 bg-yellow-50 rounded flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Makanan & Minuman</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_menu']) }}</p>
        <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-yellow-500" style="width: 50%"></div>
        </div>
    </div>

    {{-- Total Pengaduan --}}
    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="flex justify-between items-start mb-2">
            <div class="w-10 h-10 bg-red-50 rounded flex items-center justify-center">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
            </div>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Total Pengaduan</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_pengaduan']) }}</p>
        <div class="mt-2 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-red-500" style="width: 85%"></div>
        </div>
    </div>
</div>

{{-- Recent Activity --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-700">Pengaduan Terbaru</h3>
            <a href="{{ route('pelayanan.index') }}" class="text-sm text-primary hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-5 py-3 text-left font-medium">Nama</th>
                        <th class="px-5 py-3 text-left font-medium">Pengaduan</th>
                        <th class="px-5 py-3 text-left font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse(\App\Models\Pelayanan::latest()->take(5)->get() as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $p->nama }}</td>
                        <td class="px-5 py-3 text-gray-600 truncate max-w-xs">{{ Str::limit($p->pengaduan, 50) }}</td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                @if($p->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($p->status == 'proses') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-5 py-8 text-center text-gray-400">Belum ada pengaduan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Activity Timeline --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700">Aktivitas Sistem</h3>
        </div>
        <div class="p-5 space-y-4">
            <div class="flex gap-3">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0 text-white text-xs font-bold">A</div>
                <div>
                    <p class="text-sm text-gray-700"><span class="font-semibold">Admin</span> login ke sistem</p>
                    <p class="text-xs text-gray-400">2 menit lalu</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 text-white text-xs font-bold">P</div>
                <div>
                    <p class="text-sm text-gray-700"><span class="font-semibold">Petugas</span> menambah barang baru</p>
                    <p class="text-xs text-gray-400">15 menit lalu</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center flex-shrink-0 text-white text-xs font-bold">C</div>
                <div>
                    <p class="text-sm text-gray-700"><span class="font-semibold">Customer</span> mengirim pengaduan</p>
                    <p class="text-xs text-gray-400">1 jam lalu</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection