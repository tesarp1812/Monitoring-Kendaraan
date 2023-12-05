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

    protected $fillable = [
        'kendaraan_id',
        'nama_driver',
        'user_id'
    ];
}
