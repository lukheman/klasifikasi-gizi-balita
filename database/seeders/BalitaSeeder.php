<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BalitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('balita')->insert([
            [
                'kode_balita' => Str::random(10),
                'nama_balita' => 'John Doe',
                'tanggal_lahir' => '2018-01-01',
                'id_orang_tua' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_balita' => Str::random(10),
                'nama_balita' => 'Jane Doe',
                'tanggal_lahir' => '2019-02-02',
                'id_orang_tua' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
