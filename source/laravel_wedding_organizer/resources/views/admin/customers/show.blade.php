@extends('layouts.app')

@section('title', 'Customer Detail')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Customer</h1>
            <p class="text-sm text-gray-600 mt-1">{{ $user->name }}</p>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200">Kembali</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Customer</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">ID</p>
                    <p class="text-base font-medium text-gray-900">{{ $user->id }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="text-base font-medium text-gray-900">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="text-base font-medium text-gray-900">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Bergabung</p>
                    <p class="text-base font-medium text-gray-900">{{ $user->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Pemesanan</p>
                    <p class="text-base font-medium text-gray-900">{{ $user->pemesanans->count() }}</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Pemesanan</h2>
            @if($user->pemesanans->isEmpty())
                <p class="text-gray-500">Belum ada pemesanan.</p>
            @else
                <div class="space-y-4">
                    @foreach($user->pemesanans as $pemesanan)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <p class="text-sm font-semibold text-gray-900">#{{ $pemesanan->id }} — {{ $pemesanan->nama_pemesan }}</p>
                                        @php
                                            $badge = match($pemesanan->status) {
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'confirmed' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                'completed' => 'bg-blue-100 text-blue-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $badge }}">{{ strtoupper($pemesanan->status) }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600">Paket: {{ optional($pemesanan->paket)->nama ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">Tanggal Acara: {{ \Illuminate\Support\Carbon::parse($pemesanan->tanggal_acara)->format('d M Y') }}</p>
                                    <p class="text-sm text-gray-600">Lokasi: {{ $pemesanan->lokasi_acara }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Dipesan: {{ $pemesanan->created_at->format('d M Y') }}</p>
                                </div>
                                <a href="{{ route('admin.pemesanan.show', $pemesanan) }}" class="text-pink-600 hover:text-pink-800 text-sm font-medium">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
