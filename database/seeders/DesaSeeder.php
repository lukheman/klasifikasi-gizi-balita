<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Desa;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Desa::create([
            'nama' => 'Papalia'
        ]);
        Desa::create([
            'nama' => 'Anewoi'
        ]);

    }
}
