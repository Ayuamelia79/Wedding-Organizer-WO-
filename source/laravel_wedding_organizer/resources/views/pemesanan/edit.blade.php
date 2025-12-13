@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pemesanan</h2>

    <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="form-control"
                   value="{{ $pemesanan->nama_pemesan }}" required>
        </div>

        <div class="mb-3">
            <label>Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control"
                   value="{{ $pemesanan->nomor_hp }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                   value="{{ $pemesanan->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label>Paket</label>
            <select name="paket_id" class="form-control" required>
                @foreach($pakets as $paket)
                    <option value="{{ $paket->id }}"
                        {{ $paket->id == $pemesanan->paket_id ? 'selected' : '' }}>
                        {{ $paket->nama_paket }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $pemesanan->status=='pending'?'selected':'' }}>Pending</option>
                <option value="confirmed" {{ $pemesanan->status=='confirmed'?'selected':'' }}>Confirmed</option>
                <option value="cancelled" {{ $pemesanan->status=='cancelled'?'selected':'' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control">{{ $pemesanan->catatan }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
