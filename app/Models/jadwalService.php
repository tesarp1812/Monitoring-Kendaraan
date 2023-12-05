<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwalService extends Model
{
    use HasFactory;

    protected $fillable = [
        'kendaraan_id',
        'jadwal_service',
    ];
}
