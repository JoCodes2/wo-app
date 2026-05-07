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
    }
}
