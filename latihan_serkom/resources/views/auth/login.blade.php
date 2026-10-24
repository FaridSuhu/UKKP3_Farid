@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="max-w-md w-full">

        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Sistem Pengaduan</h1>
            <p class="text-sm text-gray-500 mt-1">Masuk untuk melanjutkan</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">

            @if($errors->any())
                <div class="mb-4 flex items-center bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <button type="submit"
                    class="w-full py-2.5 text-sm font-medium text-white bg-primary rounded hover:bg-green-700 transition">
                    Login
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-5">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">Daftar di sini</a>
            </p>
        </div>
        </div>

    </div>
</div>
@endsection