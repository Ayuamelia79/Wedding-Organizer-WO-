<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'user_id',
        'paket_id',
        'nama_pemesan',
        'nomor_hp',
        'tanggal_acara',
        'lokasi_acara',
        'jumlah_tamu',
        'catatan',
        'status',
    ];

    protected $casts = [
        'tanggal_acara' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function tamus()
    {
        return $this->hasMany(Tamu::class);
    }

    // Status helpers
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Status badge color
    public function getStatusBadgeColor()
    {
        return match($this->status) {
            'pending' => 'yellow',
            'confirmed' => 'green',
            'cancelled' => 'red',
            'completed' => 'blue',
            default => 'gray'
        };
    }

    // Status label
    public function getStatusLabel()
    {
        return match($this->status) {
            'pending' => 'Menunggu',
            'confirmed' => 'Dikonfirmasi',
            'cancelled' => 'Dibatalkan',
            'completed' => 'Selesai',
            'in_progress' => 'Sedang Dikerjakan',
            default => 'Unknown'
        };
    }

    // Status options for forms
    public static function statusOptions()
    {
        return [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'in_progress' => 'Sedang Dikerjakan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    }
}
