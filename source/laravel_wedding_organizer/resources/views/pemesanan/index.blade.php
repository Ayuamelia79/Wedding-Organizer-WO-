@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Pemesanan</h2>
    <a href="{{ route('pemesanan.create') }}" class="btn btn-primary mb-3">Tambah Pemesanan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nama Pemesan</th>
            <th>Nomor HP</th>
            <th>Tanggal</th>
            <th>Paket</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pemesanans as $p)
            <tr>
                <td>{{ $p->nama_pemesan }}</td>
                <td>{{ $p->nomor_hp }}</td>
                <td>{{ $p->tanggal }}</td>
                <td>{{ $p->paket->nama_paket }}</td>
                <td>{{ $p->status }}</td>
                <td>
                    <a href="{{ route('pemesanan.show', $p->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('pemesanan.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('pemesanan.destroy', $p->id) }}" method="POST" style="display:inline;">
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
