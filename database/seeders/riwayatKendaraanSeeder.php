<?php

namespace Database\Seeders;

use App\Models\riwayat_kendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class riwayatKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        riwayat_kendaraan::create([
            'kendaraan_id' => '1',
            'konsumsi_bbm' => '12',
            'driver' => 'andi'
        ]);

        riwayat_kendaraan::create([
            'kendaraan_id' => '2',
            'konsumsi_bbm' => '15',
            'driver' => 'tole'
        ]);
    }
}
