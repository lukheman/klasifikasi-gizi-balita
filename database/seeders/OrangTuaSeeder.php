<?php

namespace Database\Seeders;

use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nik' => '7301010101010001',
                'nama_orang_tua' => 'Budi Santoso',
                'tanggal_lahir' => '1985-07-15',
                'telepon' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010002',
                'nama_orang_tua' => 'Siti Aminah',
                'tanggal_lahir' => '1990-03-22',
                'telepon' => '082345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010003',
                'nama_orang_tua' => 'Ahmad Fauzan',
                'tanggal_lahir' => '1988-11-30',
                'telepon' => '083456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010004',
                'nama_orang_tua' => 'Dewi Sartika',
                'tanggal_lahir' => '1992-05-10',
                'telepon' => '084567890123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010005',
                'nama_orang_tua' => 'Rudi Hartono',
                'tanggal_lahir' => '1987-09-18',
                'telepon' => '085678901234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010006',
                'nama_orang_tua' => 'Lina Kusuma',
                'tanggal_lahir' => '1991-12-05',
                'telepon' => '086789012345',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010007',
                'nama_orang_tua' => 'Zainal Abidin',
                'tanggal_lahir' => '1984-08-25',
                'telepon' => '087890123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010008',
                'nama_orang_tua' => 'Farah Ayu',
                'tanggal_lahir' => '1993-06-14',
                'telepon' => '088901234567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010009',
                'nama_orang_tua' => 'Hendra Wijaya',
                'tanggal_lahir' => '1986-04-02',
                'telepon' => '089012345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '7301010101010010',
                'nama_orang_tua' => 'Tina Marlina',
                'tanggal_lahir' => '1994-02-28',
                'telepon' => '081112223334',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach($data as $item) {
            $user = User::create([
                'name' => $item['nama_orang_tua'],
                'email' => $item['nik'] . '@gmail.com',
                'password' => bcrypt('password123'),
                'role' => 'orangtua',
            ]);

            OrangTua::create([
                'nik' => $item['nik'],
                'tanggal_lahir' => $item['tanggal_lahir'],
                'telepon' => $item['telepon'],
                'id_user' => $user->id,
            ]);
        }

        // DB::table('orang_tua')->insert($data);
    }
}
