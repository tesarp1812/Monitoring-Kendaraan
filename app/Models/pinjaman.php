<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinjaman extends Model
{
    use HasFactory;
    
    protected $fillable = ['id_pemesanan'];
    public function pemesanan()
    {
        return $this->belongsTo(pemesanan::class,'id_pemesanan');
    }

    public function riwayatKendaraan()
    {
        return $this->hasOne(riwayat_kendaraan::class);
    }
    
}