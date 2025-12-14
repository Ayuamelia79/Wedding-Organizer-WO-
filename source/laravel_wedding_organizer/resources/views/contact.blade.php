@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Hubungi Kami</h1>
    @if(session('status'))
        <div class="mb-4 rounded-lg bg-green-50 text-green-700 p-4">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6 bg-white rounded-xl shadow p-6">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                @error('nama')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
            <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
            @error('nomor_hp')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Pesan</label>
            <textarea name="pesan" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('pesan') }}</textarea>
            @error('pesan')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center gap-3">
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-pink-600 text-white rounded-lg text-sm font-semibold hover:bg-pink-700">Kirim Pesan</button>
            <a href="{{ url('/') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200">Kembali</a>
        </div>
    </form>
</div>
@endsection
