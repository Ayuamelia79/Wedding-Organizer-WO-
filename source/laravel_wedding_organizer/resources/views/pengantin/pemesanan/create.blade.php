@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-rose-50 via-pink-50 to-purple-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('pengantin.pemesanan.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Buat Pemesanan Baru</h1>
            <p class="mt-2 text-gray-600">Lengkapi formulir di bawah untuk membuat pemesanan paket wedding organizer</p>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <form action="{{ route('pengantin.pemesanan.store') }}" method="POST" class="p-6 md:p-8">
                @csrf

                <!-- Informasi Pemesan -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-purple-500">
                        Informasi Pemesan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_pemesan" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_pemesan" id="nama_pemesan" 
                                   value="{{ old('nama_pemesan', Auth::user()->name) }}" 
                                   required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('nama_pemesan') border-red-500 @enderror">
                            @error('nama_pemesan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nomor_hp" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor HP/WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nomor_hp" id="nomor_hp" 
                                   value="{{ old('nomor_hp') }}" 
                                   placeholder="08xxxxxxxxxx"
                                   required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('nomor_hp') border-red-500 @enderror">
                            @error('nomor_hp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Detail Acara -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-purple-500">
                        Detail Acara
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="tanggal_acara" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Acara <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_acara" id="tanggal_acara" 
                                   value="{{ old('tanggal_acara') }}" 
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('tanggal_acara') border-red-500 @enderror">
                            @error('tanggal_acara')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jumlah_tamu" class="block text-sm font-medium text-gray-700 mb-2">
                                Perkiraan Jumlah Tamu <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="jumlah_tamu" id="jumlah_tamu" 
                                   value="{{ old('jumlah_tamu', 100) }}" 
                                   min="1"
                                   required
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('jumlah_tamu') border-red-500 @enderror">
                            @error('jumlah_tamu')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="lokasi_acara" class="block text-sm font-medium text-gray-700 mb-2">
                            Lokasi/Alamat Acara <span class="text-red-500">*</span>
                        </label>
                        <textarea name="lokasi_acara" id="lokasi_acara" rows="3" 
                                  required
                                  placeholder="Contoh: kos aku"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('lokasi_acara') border-red-500 @enderror">{{ old('lokasi_acara') }}</textarea>
                        @error('lokasi_acara')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Pilih Paket -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-purple-500">
                        Pilih Paket <span class="text-red-500">*</span>
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($pakets as $paket)
                        <label class="relative block cursor-pointer">
                            <input type="radio" name="paket_id" value="{{ $paket->id }}" 
                                   {{ (old('paket_id') == $paket->id || (isset($selectedPaketId) && (int)$selectedPaketId === $paket->id)) ? 'checked' : '' }}
                                   required
                                   class="peer sr-only">
                            <div class="p-5 rounded-lg border-2 border-gray-300 hover:border-purple-400 peer-checked:border-purple-600 peer-checked:bg-purple-50 transition-all">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-gray-900">{{ $paket->nama_paket }}</h3>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:bg-purple-600 peer-checked:border-purple-600 flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $paket->deskripsi }}</p>
                                <p class="text-lg font-bold text-purple-600">{{ $paket->formatted_harga }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('paket_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan Tambahan -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b-2 border-purple-500">
                        Catatan Tambahan
                    </h2>
                    
                    <div>
                        <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan atau Permintaan Khusus (Opsional)
                        </label>
                        <textarea name="catatan" id="catatan" rows="4" 
                                  placeholder="Tuliskan catatan atau permintaan khusus Anda di sini..."
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('catatan') border-red-500 @enderror">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-lg font-semibold hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all shadow-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Kirim Pemesanan
                    </button>
                    <a href="{{ route('pengantin.pemesanan.index') }}" 
                       class="flex-1 bg-gray-200 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:bg-gray-300 transition-all text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <strong>Catatan:</strong> Setelah pemesanan dikirim, status akan <strong>"Menunggu Konfirmasi"</strong>. 
                        Tim kami akan menghubungi Anda dalam 1x24 jam untuk konfirmasi lebih lanjut.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
