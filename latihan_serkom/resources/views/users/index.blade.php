@extends('layouts.app')
@section('title', 'Kelola User')

@section('content')

<div class="mb-5 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Kelola User</h2>
        <p class="text-sm text-gray-500">
            @if(auth()->user()->isAdmin())
                Kelola seluruh pengguna sistem
            @else
                Kelola data customer
            @endif
        </p>
    </div>
    <a href="{{ route('users.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah User
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
                <th class="px-5 py-3 text-left font-medium">Role</th>
                <th class="px-5 py-3 text-center font-medium w-40">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($users as $i => $u)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-3 text-gray-500">{{ $i + 1 }}</td>
                <td class="px-5 py-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                            {{ strtoupper(substr($u->name, 0, 1)) }}
                        </div>
                        <span class="font-medium text-gray-800">{{ $u->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-3 text-gray-600">{{ $u->email }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $u->no_telp }}</td>
                <td class="px-5 py-3">
                    @if($u->role == 'admin')
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">Admin</span>
                    @elseif($u->role == 'petugas')
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700">Petugas</span>
                    @else
                        <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">Customer</span>
                    @endif
                </td>
                <td class="px-5 py-3">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('users.edit', $u) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100">
                            Edit
                        </a>
                        @if($u->id !== auth()->id())
                        <form action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-700 bg-red-50 rounded hover:bg-red-100">
                                Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Belum ada data user
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection