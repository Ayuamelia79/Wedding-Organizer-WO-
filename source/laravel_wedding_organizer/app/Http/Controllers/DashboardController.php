<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pemesanan;
use App\Models\Pengantin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalPaket = Paket::count();
        $totalPemesanan = Pemesanan::count();
        $totalPengantin = Pengantin::count();
        
        // Statistik pemesanan berdasarkan status
        $pemesananPending = Pemesanan::where('status', 'pending')->count();
        $pemesananConfirmed = Pemesanan::where('status', 'confirmed')->count();
        $pemesananCancelled = Pemesanan::where('status', 'cancelled')->count();
        
        // Total pendapatan (confirmed bookings)
        $totalPendapatan = Pemesanan::where('status', 'confirmed')
            ->join('pakets', 'pemesanans.paket_id', '=', 'pakets.id')
            ->sum('pakets.harga');
        
        // Pemesanan terbaru
        $pemesananTerbaru = Pemesanan::with(['paket', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Paket terpopuler
        $paketPopuler = Paket::select('pakets.*', DB::raw('COUNT(pemesanans.id) as total_pemesanan'))
            ->leftJoin('pemesanans', 'pakets.id', '=', 'pemesanans.paket_id')
            ->groupBy('pakets.id', 'pakets.nama_paket', 'pakets.harga', 'pakets.deskripsi', 'pakets.foto', 'pakets.created_at', 'pakets.updated_at')
            ->orderBy('total_pemesanan', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalPaket',
            'totalPemesanan',
            'totalPengantin',
            'pemesananPending',
            'pemesananConfirmed',
            'pemesananCancelled',
            'totalPendapatan',
            'pemesananTerbaru',
            'paketPopuler'
        ));
    }

    // Customer Management Methods
    public function customers()
    {
        $customers = User::where('role', 'pengantin')
            ->withCount('pemesanans')
            ->latest()
            ->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function customerDetail(User $user)
    {
        if ($user->role !== 'pengantin') {
            abort(404);
        }

        $user->load(['pemesanans.paket']);
        
        return view('admin.customers.show', compact('user'));
    }

    // Reports Methods
    public function reports()
    {
        $monthlyRevenue = Pemesanan::where('status', 'confirmed')
            ->selectRaw('MONTH(pemesanans.created_at) as month, YEAR(pemesanans.created_at) as year, COUNT(*) as total_bookings')
            ->join('pakets', 'pemesanans.paket_id', '=', 'pakets.id')
            ->selectRaw('SUM(pakets.harga) as revenue')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        return view('admin.reports.index', compact('monthlyRevenue'));
    }

    public function revenueReport()
    {
        // Implementasi laporan revenue
        return view('admin.reports.revenue');
    }

    public function bookingsReport()
    {
        // Implementasi laporan bookings
        return view('admin.reports.bookings');
    }
}
