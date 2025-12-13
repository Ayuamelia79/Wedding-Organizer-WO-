<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Paket;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with('paket')->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create()
    {
        $pakets = Paket::all();
        return view('pemesanan.create', compact('pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'nomor_hp' => 'required',
            'tanggal' => 'required|date',
            'paket_id' => 'required',
            'catatan' => 'nullable',
        ]);

        Pemesanan::create($request->all());

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dibuat');
    }

    public function show(Pemesanan $pemesanan)
    {
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function edit(Pemesanan $pemesanan)
    {
        $pakets = Paket::all();
        return view('pemesanan.edit', compact('pemesanan','pakets'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'nomor_hp' => 'required',
            'tanggal' => 'required|date',
            'paket_id' => 'required',
            'catatan' => 'nullable',
            'status' => 'required',
        ]);

        $pemesanan->update($request->all());

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus');
    }
}
