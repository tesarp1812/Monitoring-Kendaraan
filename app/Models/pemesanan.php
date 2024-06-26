<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(kendaraan::class);
    }

    public function driver()
    {
        return $this->belongsTo(driver::class);
    }

    public function pinjam()
    {
        return $this->hasOne(pinjaman::class, 'id_pemesanan');
    }

    protected $fillable = [
        'kendaraan_id',
        'driver_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];
}
