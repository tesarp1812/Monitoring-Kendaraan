<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Faker\Provider\Fakecar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\driver::factory(10)->create();

        //faker driver
        $faker = Faker::create('id_ID');


        for ($i = 0; $i < 10; $i++) {
            DB::table('drivers')->insert([
                'nama' => $faker->firstName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //faker kendaraan
        for ($i = 0; $i < 10; $i++) {
            $jenisKendaraan = $i % 2 == 0 ? 'Mobil' : 'Truk';
            $mobil = 'mobil';
            $truck = 'truck';
            $namaKendaraan = $i % 2 == 0 ? $mobil : $truck;

            if ($jenisKendaraan == 'Mobil') {
                $namaKendaraan .= ' ' . ($i + 1);
            } else {
                $namaKendaraan .= ' ' . ($i + 1);
            }

            DB::table('kendaraans')->insert([
                'nama' => $namaKendaraan,
                'jenis_kendaraan' => $jenisKendaraan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //faker user kepala
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->email,
                'password' => bcrypt('12345'),
                'role' => 'kepala',
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //faker admin

        DB::table('users')->insert([
            'name' => $faker->firstName,
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        //faker riwayat kendaraan
        // for ($i = 0; $i < 100; $i++) {
        //     $kendaraan = DB::table('kendaraans')->inRandomOrder()->first();
        //     $driver = DB::table('drivers')->inRandomOrder()->first();

        //     DB::table('riwayat_kendaraans')->insert([
        //         'kendaraan_id' => $kendaraan->id,
        //         'konsumsi_bbm' => $faker->numberBetween($min = 1000, $max = 9000),
        //         'driver_id' => $driver->id,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        //faker jadwal service
        for ($i = 0; $i < 7; $i++) {
            $kendaraan = DB::table('kendaraans')->inRandomOrder()->get();
            $kendaraan1 = $kendaraan->shift();
            DB::table('jadwal_services')->insert([
                'kendaraan_id' => $kendaraan1->id,
                'jadwal_service' => $faker->dateTimeInInterval($startDate = '+ 1 days', $interval = '+ 5 days'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //faker pengajuan
        for ($i = 0; $i < 100; $i++) {

            $userKepala = DB::table('users')->where('role', 'kepala')->inRandomOrder()->first();
            $kendaraan = DB::table('kendaraans')->inRandomOrder()->get();
            $driver = DB::table('drivers')->inRandomOrder()->get();
            $status = $i % 2 == 0 ? 'belum disetujui' : 'disetujui';

            $kendaraan1 = $kendaraan->shift();
            $driver1 = $driver->shift();

            DB::table('pemesanans')->insert([
                'kendaraan_id' => $kendaraan1->id,
                'driver_id' => $driver1->id,
                'user_id' => $userKepala->id,
                'status' => $status,
                'tanggal_pinjam' => $faker->dateTimeInInterval($startDate = 'now', $interval = '+ 5 days'),
                'tanggal_kembali' => $faker->dateTimeInInterval($startDate = '+ 10 days', $interval = '+ 15 days'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //faker pinjam
        $pemesananData = DB::table('pemesanans')->where('status', 'disetujui')->get();
        foreach ($pemesananData as $pemesanan) {
            DB::table('pinjamen')->insert([
                'id_pemesanan' => $pemesanan->id,
                'created_at' => $pemesanan->tanggal_pinjam,
                'updated_at' => $pemesanan->tanggal_kembali,
            ]);
        }


        //faker pinjam
        $pinjamenData = DB::table('pinjamen')->get();
        foreach ($pinjamenData as $pinjam) {
            DB::table('riwayat_kendaraans')->insert([
                'id_pinjam' => $pinjam->id,
                'konsumsi_bbm' => $faker->numberBetween($min = 1000, $max = 9000),
                'tanggal' => $pinjam->updated_at,
                'created_at' => $pinjam->updated_at,
                'updated_at' => $pinjam->updated_at,
            ]);
        }
    }
}
