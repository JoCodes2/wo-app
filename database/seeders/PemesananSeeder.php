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
        $andi = User::where('email', 'andi@mail.com')->first();
        $layanan = Layanan::first();

        Pemesanan::create([
            'user_id' => $andi->id,
            'layanan_id' => $layanan->id,
            'tgl_acara' => '2026-06-10',
            'lokasi_acara' => 'Gedung Jodjokodi, Palu',
            'status_pesanan' => 'selesai'
        ]);
    }
}
