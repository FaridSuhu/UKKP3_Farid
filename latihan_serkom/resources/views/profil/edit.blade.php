@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-5">
        <h2 class="text-xl font-semibold text-gray-800">Profil Saya</h2>
        <p class="text-sm text-gray-500">Ubah data profil Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Profile Card --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="p-6 text-center border-b border-gray-100">
                <div class="w-24 h-24 rounded-full bg-primary flex items-center justify-center text-white font-bold text-4xl mx-auto mb-4">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                <span class="inline-flex mt-3 px-3 py-1 rounded text-xs font-medium bg-green-100 text-green-700">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
            <div class="p-6 space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">No Telp</span>
                    <span class="font-medium text-gray-800">{{ $user->no_telp ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Bergabung</span>
                    <span class="font-medium text-gray-800">{{ $user->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Form Edit --}}
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="font-semibold text-gray-700">Edit Informasi</h3>
            </div>

            <form method="POST" action="{{ route('profil.update') }}" class="p-6 space-y-4">
                @csrf @method('PUT')

                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No Telp</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <p class="text-sm font-medium text-gray-700 mb-3">
                        Ganti Password <span class="text-gray-400 font-normal">(kosongkan jika tidak ingin ganti)</span>
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <input type="password" name="password"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection