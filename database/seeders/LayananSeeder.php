<?php

namespace Database\Seeders;

use App\Models\ProfilWo;
use App\Models\Kategori;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $marita = ProfilWo::where('nama_wo', 'Marita House of Wedding')->first();
        $tradisional = Kategori::where('nama_kategori', 'Tradisional')->first();

        Layanan::create([
            'wo_id' => $marita->id,
            'kategori_id' => $tradisional->id,
            'nama_layanan' => 'Paket Nikah 23 Juta',
            'harga' => 23000000,
            'detail_layanan' => 'Rias, Dekorasi Rumah & Gedung, Bonus MUA'
        ]);

        // Tambahkan layanan lain untuk WO lainnya di sini...
    }
}
