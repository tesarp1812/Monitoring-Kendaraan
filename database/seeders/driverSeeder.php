<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\driver;

class driverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $faker = Faker::create('id_ID');

        // for ($i = 1; $i <= 50; $i++) {

        //     // insert data ke table pegawai menggunakan Faker
        //     DB::table('drivers')->insert([
        //         'nama' => $faker->name
        //     ]);
        // }
        driver::create([
            'nama' => 'rian'
        ]);

        driver::create([
            'nama' => 'dani'
        ]);

        driver::create([
            'nama' => 'tomo'
        ]);
    }
}
