<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataLatihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data= [
            [
                "nama" => "Lafania",
                "umur" => 39,
                "berat" => 13,
                "tinggi" => 91.7,
                "status" => "normal"
            ],
            [
                "nama" => "Syaidan",
                "umur" => 50,
                "berat" => 15.2,
                "tinggi" => 96.3,
                "status" => "underweight"
            ],
            [
                "nama" => "Fzaizun",
                "umur" => 37,
                "berat" => 13.2,
                "tinggi" => 89.6,
                "status" => "normal"
            ],
            [
                "nama" => "Kamila",
                "umur" => 48,
                "berat" => 13.6,
                "tinggi" => 95.7,
                "status" => "normal"
            ],
            [
                "nama" => "Kayla",
                "umur" => 18,
                "berat" => 9.5,
                "tinggi" => 79.4,
                "status" => "wasting"
            ],
            [
                "nama" => "Gibran",
                "umur" => 12,
                "berat" => 8.4,
                "tinggi" => 72.5,
                "status" => "overweight"
            ],
            [
                "nama" => "Albais",
                "umur" => 49,
                "berat" => 14.5,
                "tinggi" => 95.6,
                "status" => "normal"
            ],
            [
                "nama" => "Abizar",
                "umur" => 45,
                "berat" => 13.6,
                "tinggi" => 96.3,
                "status" => "stunting"
            ]
        ];

        DB::table('data_latih')->insert($data);
    }
}
