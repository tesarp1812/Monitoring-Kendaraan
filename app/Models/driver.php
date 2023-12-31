<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;

    public function pemesanan()
    {
        return $this->hasMany(pemesanan::class);
    }
    public function riwayatKendaraan()
    {
        return $this->hasMany(riwayat_kendaraan::class);
    }

    protected $fillable = [
        'nama'
    ];
}
