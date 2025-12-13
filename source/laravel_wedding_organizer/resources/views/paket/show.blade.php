@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Paket</h2>

    <p><strong>Nama:</strong> {{ $paket->nama_paket }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($paket->harga) }}</p>
    <p><strong>Deskripsi:</strong> {{ $paket->deskripsi }}</p>

    @if($paket->foto)
        <img src="{{ asset('storage/'.$paket->foto) }}" width="200">
    @endif

    <br><br>
    <a href="{{ route('paket.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
