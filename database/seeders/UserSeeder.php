<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sofhia',
            'email' => 'ahligizi@gmail.com',
            'password' => bcrypt('password123'),
            'role' => Role::AhliGizi
        ]);

        User::create([
            'name' => 'Akmal',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'role' => Role::Admin
        ]);

        User::create([
            'name' => 'Burhan S.Kom',
            'email' => 'pimpinan@gmail.com',
            'password' => bcrypt('password123'),
            'role' => Role::Pimpinan
        ]);

    }
}
