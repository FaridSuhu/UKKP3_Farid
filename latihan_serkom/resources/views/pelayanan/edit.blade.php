@extends('layouts.app')
@section('title', 'Edit Pengaduan')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="mb-5">
        <h2 class="text-xl font-semibold text-gray-800">Edit Pengaduan</h2>
        <p class="text-sm text-gray-500">Ubah data pengaduan</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700">Form Pengaduan</h3>
        </div>

        <form method="POST" action="{{ route('pelayanan.update', $pelayanan) }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf @method('PUT')

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $pelayanan->nama) }}" required
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $pelayanan->email) }}" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No Telp</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $pelayanan->no_telp) }}" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Pengaduan</label>
                <input type="text" name="judul" value="{{ old('judul', $pelayanan->judul) }}" required
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pengaduan</label>
                <textarea name="pengaduan" rows="5" required
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('pengaduan', $pelayanan->pengaduan) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Foto Baru <span class="text-gray-400 font-normal">(opsional)</span>
                </label>
                <input type="file" name="foto" accept="image/*"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-primary file:text-white hover:file:bg-green-700">
                @if($pelayanan->foto)
                    <div class="mt-3">
                        <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                        <img src="{{ asset('storage/'.$pelayanan->foto) }}" class="w-32 h-32 object-cover rounded border border-gray-200">
                    </div>
                @endif
            </div>

            @if(!auth()->user()->isCustomer())
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" required
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="pending" @selected(old('status', $pelayanan->status) == 'pending')>Pending</option>
                    <option value="proses" @selected(old('status', $pelayanan->status) == 'proses')>Proses</option>
                    <option value="selesai" @selected(old('status', $pelayanan->status) == 'selesai')>Selesai</option>
                </select>
            </div>
            @endif

            <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary rounded hover:bg-green-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update
                </button>
                <a href="{{ route('pelayanan.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
