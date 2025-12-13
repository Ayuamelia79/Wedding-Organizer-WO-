@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Paket</h2>

    <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
