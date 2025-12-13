@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Paket</h2>
    <a href="{{ route('paket.create') }}" class="btn btn-primary mb-3">Tambah Paket</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pakets as $paket)
            <tr>
                <td>{{ $paket->nama_paket }}</td>
                <td>Rp {{ number_format($paket->harga) }}</td>
                <td>
                    @if($paket->foto)
                        <img src="{{ asset('storage/'.$paket->foto) }}" width="80">
                    @endif
                </td>
                <td>
                    <a href="{{ route('paket.show', $paket->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('paket.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('paket.destroy', $paket->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
