<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'password' => Hash::make('password'),
            'nama_lengkap' => 'Administrator Sistem',
            'email' => 'admin@gmail.com',
            'no_hp' => '081122334455',
            'role' => 'admin',
            'status_akun' => 'aktif',
        ]);

        // User (Calon Pengantin)
        User::create(['password' => Hash::make('password'), 'nama_lengkap' => 'Andi Wijaya', 'email' => 'andi@mail.com', 'no_hp' => '08521', 'role' => 'user', 'status_akun' => 'aktif']);
        User::create(['password' => Hash::make('password'), 'nama_lengkap' => 'Budi Santoso', 'email' => 'budi@mail.com', 'no_hp' => '08522', 'role' => 'user', 'status_akun' => 'aktif']);

        // Akun WO
        User::create(['password' => Hash::make('password'), 'nama_lengkap' => 'Ibu Marita', 'email' => 'marita@mail.com', 'no_hp' => '081243438692', 'role' => 'wo', 'status_akun' => 'aktif']);
        User::create(['password' => Hash::make('password'), 'nama_lengkap' => 'Rian Garden', 'email' => 'garden@mail.com', 'no_hp' => '08520', 'role' => 'wo', 'status_akun' => 'aktif']);
        User::create(['password' => Hash::make('password'), 'nama_lengkap' => 'Admin Tadulako', 'email' => 'tadulako@mail.com', 'no_hp' => '08218', 'role' => 'wo', 'status_akun' => 'aktif']);
    }
}
