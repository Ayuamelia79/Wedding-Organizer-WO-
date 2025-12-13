@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pemesanan</h2>

    <p><strong>Nama Pemesan:</strong> {{ $pemesanan->nama_pemesan }}</p>
    <p><strong>Nomor HP:</strong> {{ $pemesanan->nomor_hp }}</p>
    <p><strong>Tanggal:</strong> {{ $pemesanan->tanggal }}</p>
    <p><strong>Paket:</strong> {{ $pemesanan->paket->nama_paket }}</p>
    <p><strong>Status:</strong> {{ $pemesanan->status }}</p>
    <p><strong>Catatan:</strong> {{ $pemesanan->catatan }}</p>

    <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
