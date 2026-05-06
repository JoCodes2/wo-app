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
        User::create(['password' => Hash::make('password'), 'nama_lengkap' => 'Andi Wijaya', 'email' => 'andi@mail.com', 'no_hp' => '08521000001', 'role' => 'user', 'status_akun' => 'aktif']);
        User::create(['password' => Hash::make('password'), 'nama_lengkap' => 'Budi Santoso', 'email' => 'budi@mail.com', 'no_hp' => '08522000002', 'role' => 'user', 'status_akun' => 'aktif']);

        // 5 Akun WO
        $woEmails = ['marita@mail.com', 'moy@mail.com', 'thechox@mail.com', 'warna@mail.com', 'happy@mail.com'];
        $woNames = ['Ibu Marita', 'Owner Moy', 'Admin Thechox', 'Team Warna', 'Manager Happy'];

        foreach ($woEmails as $index => $email) {
            User::create([
                'password' => Hash::make('password'),
                'nama_lengkap' => $woNames[$index],
                'email' => $email,
                'no_hp' => '0812' . rand(100000, 999999),
                'role' => 'wo',
                'status_akun' => 'aktif'
            ]);
        }
    }
}
