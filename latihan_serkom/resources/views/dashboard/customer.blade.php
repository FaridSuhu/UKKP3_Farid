@extends('layouts.app')
@section('title', 'Dashboard Customer')

@section('content')

<div class="mb-5 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Overview</h2>
        <p class="text-sm text-gray-500">Ringkasan pengaduan Anda</p>
    </div>
    <a href="{{ route('pelayanan.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Buat Pengaduan Baru
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="w-10 h-10 bg-blue-50 rounded flex items-center justify-center mb-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Total Pengaduan Saya</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['pengaduan_saya'] }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="w-10 h-10 bg-yellow-50 rounded flex items-center justify-center mb-2">
            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Pending</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['pending'] }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
        <div class="w-10 h-10 bg-green-50 rounded flex items-center justify-center mb-2">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wide">Selesai</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['selesai'] }}</p>
    </div>
</div>

{{-- Riwayat Pengaduan --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-100">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-semibold text-gray-700">Riwayat Pengaduan Saya</h3>
        <a href="{{ route('pelayanan.index') }}" class="text-sm text-primary hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-5 py-3 text-left font-medium">Tanggal</th>
                    <th class="px-5 py-3 text-left font-medium">Pengaduan</th>
                    <th class="px-5 py-3 text-left font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse(\App\Models\Pelayanan::where('user_id', auth()->id())->latest()->take(5)->get() as $p)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 text-gray-600">{{ $p->created_at->format('d M Y') }}</td>
                    <td class="px-5 py-3 text-gray-700 truncate max-w-md">{{ Str::limit($p->pengaduan, 60) }}</td>
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
                <tr><td colspan="3" class="px-5 py-8 text-center text-gray-400">Anda belum membuat pengaduan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection