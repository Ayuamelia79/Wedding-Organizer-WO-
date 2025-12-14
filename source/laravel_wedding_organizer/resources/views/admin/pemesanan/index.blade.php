@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manajemen Pemesanan</h1>
                <p class="mt-2 text-gray-600">Kelola semua pemesanan dari customer</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Status Filter -->
        <div class="mb-6 bg-white rounded-xl shadow-lg p-4">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.pemesanan.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ !request('status') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Semua ({{ $pemesanans->count() }})</a>
                <a href="{{ route('admin.pemesanan.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request('status') === 'pending' ? 'bg-yellow-100 text-yellow-800 ring-2 ring-yellow-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">⏱ Menunggu ({{ $pemesanans->where('status', 'pending')->count() }})</a>
                <a href="{{ route('admin.pemesanan.index', ['status' => 'confirmed']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request('status') === 'confirmed' ? 'bg-green-100 text-green-800 ring-2 ring-green-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">✓ Dikonfirmasi ({{ $pemesanans->where('status', 'confirmed')->count() }})</a>
                <a href="{{ route('admin.pemesanan.index', ['status' => 'in_progress']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request('status') === 'in_progress' ? 'bg-blue-100 text-blue-800 ring-2 ring-blue-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">⚙ Dikerjakan ({{ $pemesanans->where('status', 'in_progress')->count() }})</a>
                <a href="{{ route('admin.pemesanan.index', ['status' => 'completed']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request('status') === 'completed' ? 'bg-purple-100 text-purple-800 ring-2 ring-purple-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">★ Selesai ({{ $pemesanans->where('status', 'completed')->count() }})</a>
                <a href="{{ route('admin.pemesanan.index', ['status' => 'cancelled']) }}" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request('status') === 'cancelled' ? 'bg-red-100 text-red-800 ring-2 ring-red-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">✕ Dibatalkan ({{ $pemesanans->where('status', 'cancelled')->count() }})</a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Pemesanan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pemesanans->count() }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Menunggu</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $pemesanans->where('status', 'pending')->count() }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Dikonfirmasi</p>
                        <p class="text-2xl font-bold text-green-600">{{ $pemesanans->where('status', 'confirmed')->count() }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Selesai</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $pemesanans->where('status', 'completed')->count() }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Table -->
        @if($pemesanans->isEmpty())
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum Ada Pemesanan</h3>
            <p class="mt-2 text-gray-600">Belum ada pemesanan dari customer.</p>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Paket</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tanggal Acara</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pemesanans as $pemesanan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $pemesanan->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $pemesanan->nama_pemesan }}</div>
                                <div class="text-sm text-gray-500">{{ $pemesanan->user->email ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $pemesanan->nomor_hp }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $pemesanan->paket->nama_paket }}</div>
                                <div class="text-sm text-gray-500">{{ $pemesanan->jumlah_tamu }} tamu</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($pemesanan->tanggal_acara)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                {{ $pemesanan->paket->formatted_harga }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-green-100 text-green-800',
                                        'in_progress' => 'bg-blue-100 text-blue-800',
                                        'completed' => 'bg-purple-100 text-purple-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$pemesanan->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $pemesanan->getStatusLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.pemesanan.show', $pemesanan) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 font-semibold" 
                                       title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.pemesanan.edit', $pemesanan) }}" 
                                       class="text-green-600 hover:text-green-900 font-semibold" 
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.pemesanan.destroy', $pemesanan) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?');" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 font-semibold" 
                                                title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
