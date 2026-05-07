<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Layanan;
use App\Models\Pemesanan;
use Illuminate\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $layanans = Layanan::all();

        foreach ($layanans as $layanan) {
            Pemesanan::create([
                'user_id' => $users->random()->id,
                'layanan_id' => $layanan->id,
                'tgl_acara' => now()->addMonths(2),
                'lokasi_acara' => 'Gedung Serbaguna Palu',
                'total_bayar' => 200000,
                'status_pesanan' => 'selesai'
            ]);
        }
    }
}
