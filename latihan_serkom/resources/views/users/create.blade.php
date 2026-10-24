@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="mb-5">
        <h2 class="text-xl font-semibold text-gray-800">Tambah User</h2>
        <p class="text-sm text-gray-500">Isi data user baru</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700">Form User</h3>
        </div>

        <form method="POST" action="{{ route('users.store') }}" class="p-6 space-y-4">
            @csrf

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No Telp</label>
                <input type="text" name="no_telp" value="{{ old('no_telp') }}" required
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select name="role" required
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    @foreach($allowedRoles as $role)
                        <option value="{{ $role }}" @selected(old('role') == $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
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
                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection