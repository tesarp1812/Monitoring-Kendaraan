<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinjaman extends Model
{
    use HasFactory;

    public function pemesanan()
    {
        return $this->belongsTo(driver::class);
    }

    public function riwayatKendaraan()
    {
        return $this->hasOne(riwayat_kendaraan::class);
    }
    protected $fillable = [
        'id_pemesanan'
    ];
}
