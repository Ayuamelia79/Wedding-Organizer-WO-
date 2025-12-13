<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'nama_pemesan',
        'nomor_hp',
        'tanggal',
        'paket_id',
        'catatan',
        'status'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
