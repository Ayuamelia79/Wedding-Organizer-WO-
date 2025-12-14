<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'nomor_hp' => 'nullable|string|max:30',
            'pesan' => 'required|string|max:2000',
        ]);

        // Simple handling for now: log and flash. Could persist later.
        Log::info('Hubungi Kami', $data);

        return back()->with('status', 'Pesan berhasil dikirim. Kami akan menghubungi Anda.');
    }
}
