@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-4">Profil Saya</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profil.update') }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-3">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-3">
            <label class="block font-semibold mb-1">No Telp</label>
            <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-3">
            <label class="block font-semibold mb-1">Password Baru (opsional)</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>
</div>
@endsection