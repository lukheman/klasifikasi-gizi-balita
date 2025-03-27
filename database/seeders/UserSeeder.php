<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sofhia',
            'email' => 'sofhia@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'ahligizi'
        ]);

        User::create([
            'name' => 'Akmal',
            'email' => 'akmal@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Cici',
            'email' => 'cici@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'orangtua'
        ]);

    }
}
