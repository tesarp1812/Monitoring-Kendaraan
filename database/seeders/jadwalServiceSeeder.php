<?php

namespace Database\Seeders;

use App\Models\jadwalService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class jadwalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        jadwalService::create([
            'kendaraan_id' => '1',
            'jadwal_service' => '2023-12-25',
        ]);
        jadwalService::create([
            'kendaraan_id' => '2',
            'jadwal_service' => '2023-12-30',
        ]);
    }
}
