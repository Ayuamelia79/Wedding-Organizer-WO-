@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pemesanan</h2>

    <form action="{{ route('pemesanan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Paket</label>
            <select name="paket_id" class="form-control" required>
                <option value="">-- Pilih Paket --</option>
                @foreach($pakets as $paket)
                    <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
