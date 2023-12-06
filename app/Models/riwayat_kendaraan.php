<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat_kendaraan extends Model
{
    use HasFactory;

    public function kendaraan()
    {
        return $this->belongsTo(kendaraan::class);
    }

    public function driver()
    {
        return $this->belongsTo(driver::class, 'id_pinjam');
    }

    public function pinjaman()
    {
        return $this->belongsTo(pinjaman::class, 'id_pinjam');
    }

    protected $fillable = [
        'kendaraan_id',
        'konsumsi_bbm',
        'tanggal    ',
    ];
}
