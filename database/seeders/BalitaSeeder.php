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
                'nik' => Str::random(10),
                'nama' => 'John Doe',
                'tanggal_lahir' => '2022-01-01',
                'id_orang_tua' => 1,
            ],
            [
                'nik' => Str::random(10),
                'nama' => 'Jane Doe',
                'tanggal_lahir' => '2023-02-02',
                'id_orang_tua' => 2,
            ],
            // Add more entries as needed
        ]);
    }
}
