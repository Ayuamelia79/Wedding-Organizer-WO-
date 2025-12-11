<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengantinSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengantins')->insert([
            'nama' => 'Ayu Amelia',
            'email' => 'ayu@example.com',
            'password' => bcrypt('12345678'),
            'alamat' => 'Kota Banda Aceh',
            'no_hp' => '08123456789',
        ]);
    }
}
