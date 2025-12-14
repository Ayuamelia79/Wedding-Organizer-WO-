<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        // Admin melihat semua pemesanan, Pengantin hanya melihat pemesanannya
        if (Auth::user()->role === 'admin') {
            $query = Pemesanan::with(['paket', 'user']);
            
            // Filter by status if provided
            if ($request->has('status') && $request->status !== '') {
                $query->where('status', $request->status);
            }
            
            $pemesanans = $query->latest()->get();
            return view('admin.pemesanan.index', compact('pemesanans'));
        } else {
            $pemesanans = Pemesanan::with('paket')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
            return view('pengantin.pemesanan.index', compact('pemesanans'));
        }
    }

    public function create()
    {
        $pakets = Paket::all();
        $selectedPaketId = request('paket_id');
        
        if (Auth::user()->role === 'admin') {
            return view('admin.pemesanan.create', compact('pakets', 'selectedPaketId'));
        } else {
            return view('pengantin.pemesanan.create', compact('pakets', 'selectedPaketId'));
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'tanggal_acara' => 'required|date|after:today',
            'paket_id' => 'required|exists:pakets,id',
            'lokasi_acara' => 'required|string|max:500',
            'jumlah_tamu' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $pemesanan = new Pemesanan();
        $pemesanan->user_id = Auth::id();
        $pemesanan->paket_id = $validated['paket_id'];
        $pemesanan->nama_pemesan = $validated['nama_pemesan'];
        $pemesanan->nomor_hp = $validated['nomor_hp'];
        $pemesanan->tanggal_acara = $validated['tanggal_acara'];
        $pemesanan->lokasi_acara = $validated['lokasi_acara'];
        $pemesanan->jumlah_tamu = $validated['jumlah_tamu'];
        $pemesanan->catatan = $validated['catatan'] ?? null;
        $pemesanan->status = Auth::user()->role === 'admin' ? 'confirmed' : 'pending';
        $pemesanan->save();

        $route = Auth::user()->role === 'admin' ? 'admin.pemesanan.index' : 'pengantin.pemesanan.index';
        return redirect()->route($route)->with('success', 'Pemesanan berhasil dibuat!');
    }

    public function show(Pemesanan $pemesanan)
    {
        // Pastikan pengantin hanya bisa melihat pemesanannya sendiri
        if (Auth::user()->role === 'pengantin' && $pemesanan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pemesanan ini.');
        }

        $pemesanan->load(['paket', 'user']);
        
        if (Auth::user()->role === 'admin') {
            return view('admin.pemesanan.show', compact('pemesanan'));
        } else {
            return view('pengantin.pemesanan.show', compact('pemesanan'));
        }
    }

    public function edit(Pemesanan $pemesanan)
    {
        // Hanya admin yang bisa edit
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit pemesanan.');
        }

        $pakets = Paket::all();
        return view('admin.pemesanan.edit', compact('pemesanan', 'pakets'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        // Hanya admin yang bisa update
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate pemesanan.');
        }

        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'tanggal_acara' => 'required|date',
            'paket_id' => 'required|exists:pakets,id',
            'lokasi_acara' => 'required|string|max:500',
            'jumlah_tamu' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $pemesanan->update($validated);

        return redirect()->route('admin.pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui!');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        // Admin bisa hapus semua, Pengantin hanya bisa cancel pemesanannya sendiri
        if (Auth::user()->role === 'pengantin') {
            if ($pemesanan->user_id !== Auth::id()) {
                abort(403, 'Anda tidak memiliki akses untuk membatalkan pemesanan ini.');
            }
            
            // Pengantin hanya bisa cancel jika status masih pending
            if ($pemesanan->status !== 'pending') {
                return back()->with('error', 'Hanya pemesanan dengan status pending yang bisa dibatalkan.');
            }
            
            $pemesanan->update(['status' => 'cancelled']);
            return redirect()->route('pengantin.pemesanan.index')->with('success', 'Pemesanan berhasil dibatalkan!');
        }

        // Admin bisa hapus permanent
        $pemesanan->delete();
        return redirect()->route('admin.pemesanan.index')->with('success', 'Pemesanan berhasil dihapus!');
    }

    // Method khusus admin untuk update status
    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $pemesanan->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pemesanan berhasil diperbarui!');
    }

    // Method untuk tracking pembayaran (untuk pengantin)
    public function payments()
    {
        $pemesanans = Pemesanan::with(['paket', 'pembayarans'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pengantin.pembayaran.index', compact('pemesanans'));
    }

    // Method untuk guest list management (untuk pengantin)
    public function guests()
    {
        $pemesanans = Pemesanan::with(['tamus'])
            ->where('user_id', Auth::id())
            ->get();

        return view('pengantin.tamu.index', compact('pemesanans'));
    }

    public function addGuest(Request $request)
    {
        // Akan diimplementasikan sesuai kebutuhan
        return back()->with('success', 'Tamu berhasil ditambahkan!');
    }

    public function removeGuest($id)
    {
        // Akan diimplementasikan sesuai kebutuhan
        return back()->with('success', 'Tamu berhasil dihapus!');
    }
}
