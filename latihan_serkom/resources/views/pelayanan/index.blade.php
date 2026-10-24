@extends('layouts.app')
@section('title', 'Daftar Pengaduan')

@section('content')

<div class="mb-5 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Daftar Pengaduan</h2>
        <p class="text-sm text-gray-500">
            @if(auth()->user()->isCustomer())
                Pengaduan yang Anda kirim
            @else
                Kelola pengaduan pelanggan
            @endif
        </p>
    </div>
    <a href="{{ route('pelayanan.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Buat Pengaduan
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs uppercase text-gray-500">
            <tr>
                <th class="px-5 py-3 text-left font-medium w-12">No</th>
                <th class="px-5 py-3 text-left font-medium">Nama</th>
                <th class="px-5 py-3 text-left font-medium">Email</th>
                <th class="px-5 py-3 text-left font-medium">No Telp</th>
                 <th class="px-5 py-3 text-left font-medium">Judul</th>
                <th class="px-5 py-3 text-left font-medium">Foto</th>
                <th class="px-5 py-3 text-left font-medium">Status</th>
                <th class="px-5 py-3 text-center font-medium w-48">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pelayanan as $i => $p)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-3 text-gray-500">{{ $pelayanan->firstItem() + $i }}</td>
                <td class="px-5 py-3 font-medium text-gray-800">{{ $p->nama }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $p->email }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $p->no_telp }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $p->judul }}</td>
                <td class="px-5 py-3">
                    @if($p->foto)
                        <a href="{{ asset('storage/'.$p->foto) }}" target="_blank">
                            <img src="{{ asset('storage/'.$p->foto) }}" class="w-12 h-12 object-cover rounded border border-gray-200 hover:opacity-80">
                        </a>
                    @else
                        <span class="text-gray-400 text-xs">-</span>
                    @endif
                </td>
                <td class="px-5 py-3">
                    @if($p->status == 'pending')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                            Pending
                        </span>
                    @elseif($p->status == 'proses')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            Proses
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            Selesai
                        </span>
                    @endif
                </td>
                <td class="px-5 py-3">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('pelayanan.show', $p) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200">
                            Lihat
                        </a>
                        <a href="{{ route('pelayanan.edit', $p) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100">
                            Edit
                        </a>
                        <form action="{{ route('pelayanan.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus pengaduan ini?')">
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
                <td colspan="7" class="px-5 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    Belum ada pengaduan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $pelayanan->links() }}</div>

@endsection
