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
            'nama' => 'truk_1'
        ]);

        kendaraan::create([
            'nama' => 'truk_2'
        ]);

        kendaraan::create([
            'nama' => 'truk_3'
        ]);
    }
}
