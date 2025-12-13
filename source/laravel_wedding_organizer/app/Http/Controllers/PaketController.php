<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|max:255',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('paket', 'public');
        }

        Paket::create($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan');
    }

    public function show(Paket $paket)
    {
        return view('paket.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        return view('paket.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'nama_paket' => 'required|max:255',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('paket', 'public');
        }

        $paket->update($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus');
    }
}
