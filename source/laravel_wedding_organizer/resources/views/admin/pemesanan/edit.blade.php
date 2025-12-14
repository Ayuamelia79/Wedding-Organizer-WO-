@extends('layouts.app')

@section('title', 'Edit Pemesanan')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Edit Pemesanan #{{ $pemesanan->id }}</h1>
        <a href="{{ route('admin.pemesanan.show', $pemesanan) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200">Lihat Detail</a>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('admin.pemesanan.update', $pemesanan) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" value="{{ old('nama_pemesan', $pemesanan->nama_pemesan) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                    @error('nama_pemesan')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                    <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $pemesanan->nomor_hp) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                    @error('nomor_hp')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Acara</label>
                    <input type="date" name="tanggal_acara" value="{{ old('tanggal_acara', \Illuminate\Support\Carbon::parse($pemesanan->tanggal_acara)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                    @error('tanggal_acara')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi Acara</label>
                    <input type="text" name="lokasi_acara" value="{{ old('lokasi_acara', $pemesanan->lokasi_acara) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                    @error('lokasi_acara')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah Tamu</label>
                    <input type="number" name="jumlah_tamu" value="{{ old('jumlah_tamu', $pemesanan->jumlah_tamu) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500" />
                    @error('jumlah_tamu')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                        @php $statuses = method_exists($pemesanan, 'statusOptions') ? $pemesanan->statusOptions() : ['pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled', 'completed' => 'Completed']; @endphp
                        @foreach($statuses as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $pemesanan->status) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('catatan', $pemesanan->catatan) }}</textarea>
                @error('catatan')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Paket</label>
                <select name="paket_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    @foreach($pakets as $paket)
                        <option value="{{ $paket->id }}" @selected(old('paket_id', $pemesanan->paket_id) == $paket->id)>{{ $paket->nama }} — {{ $paket->formatted_harga }}</option>
                    @endforeach
                </select>
                @error('paket_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-lg text-sm font-semibold hover:bg-pink-700">Simpan Perubahan</button>
                <a href="{{ route('admin.pemesanan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-200">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
