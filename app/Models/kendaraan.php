<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    use HasFactory;

    public function pemesanan()
    {
        return $this->hasMany(pemesanan::class);
    }

    public function jadwalService()
    {
        return $this->hasMany(jadwalService::class);
    }

    protected $fillable = [
        'nama',
        'jenis_kendaraan'
    ];
}
