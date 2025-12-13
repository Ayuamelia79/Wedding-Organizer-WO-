@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Paket</h2>

    <form action="{{ route('paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $paket->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $paket->harga }}" required>
        </div>

        <div class="mb-3">
            <label>Foto</label><br>
            @if($paket->foto)
                <img src="{{ asset('storage/'.$paket->foto) }}" width="80">
            @endif
            <input type="file" name="foto" class="form-control mt-2">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
