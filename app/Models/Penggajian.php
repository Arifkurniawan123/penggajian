<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    protected $table = 'penggajian';

    protected $fillable = [
        'karyawan_id',
        'periode',
        'tunjangan',
        'lembur',
        'potongan_gaji',
        'total_gaji',
        'tanggal_bayar',
        'metode_pembayaran',
        'status',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}