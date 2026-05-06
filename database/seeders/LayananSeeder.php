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
        $kategori = Kategori::first() ?? Kategori::create(['nama_kategori' => 'Wedding Package']);
        $wos = ProfilWo::all();

        foreach ($wos as $wo) {
            $packages = [
                ['nama' => 'Bronze Intimate', 'harga' => 12000000],
                ['nama' => 'Silver Elegant', 'harga' => 25000000],
                ['nama' => 'Gold Royal', 'harga' => 45000000],
                ['nama' => 'Platinum Ballroom', 'harga' => 75000000],
                ['nama' => 'Diamond Luxury', 'harga' => 125000000],
            ];

            foreach ($packages as $p) {
                Layanan::create([
                    'wo_id' => $wo->id,
                    'kategori_id' => $kategori->id,
                    'nama_layanan' => $p['nama'] . " - " . $wo->nama_wo,
                    'harga' => $p['harga'],
                    'detail_layanan' => "Layanan unggulan dari {$wo->nama_wo} mencakup: \n• Dekorasi Pelaminan Modern Custom\n• MUA & Busana Pengantin Premium\n• Dokumentasi Foto & Video Cinematic\n• Tim WO Profesional di Lapangan\n• Sound System & Entertainment Pack."
                ]);
            }
        }
    }
}
