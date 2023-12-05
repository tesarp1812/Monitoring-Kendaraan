<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kendaraan;


class kendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        kendaraan::create([
            'nama' => 'pajero',
            'jenis_kendaraan' => 'mobil'
        ]);

        kendaraan::create([
            'nama' => 'truk tambang',
            'jenis_kendaraan' => 'truk'
        ]);

        kendaraan::create([
            'nama' => 'truk fuso',
            'jenis_kendaraan' => 'truk'
        ]);
    }
}
