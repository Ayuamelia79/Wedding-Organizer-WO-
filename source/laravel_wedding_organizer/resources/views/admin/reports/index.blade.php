@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Laporan</h1>
        <p class="text-sm text-gray-600 mt-1">Analisis dan laporan bisnis</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.reports.revenue') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-green-100 rounded-lg p-3">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Laporan Pendapatan</h3>
                    <p class="text-sm text-gray-600">Lihat analisis revenue bulanan dan tahunan</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.reports.bookings') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Laporan Pemesanan</h3>
                    <p class="text-sm text-gray-600">Lihat statistik dan tren pemesanan</p>
                </div>
            </div>
        </a>
    </div>

    <div class="mt-8 bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan</h2>
        <p class="text-gray-600">Pilih laporan di atas untuk melihat analisis detail.</p>
    </div>
</div>
@endsection
