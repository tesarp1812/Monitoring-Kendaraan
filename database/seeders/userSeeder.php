<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        user::create([
            'name' => 'tama',
            'role' => 'admin',
            'username' => 'admin123',
            'password' => bcrypt('admin123')
        ]);

        user::create([
            'name' => 'daniel',
            'role' => 'kepala',
            'username' => 'daniel123',
            'password' => bcrypt('admin123')
        ]);
    }
}
