<?php

namespace Database\Seeders;

use App\Models\Galeri;
use App\Models\ProfilWo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $wos = ProfilWo::all();
        foreach ($wos as $wo) {
            for ($i = 1; $i <= 5; $i++) {
                Galeri::create([
                    'wo_id' => $wo->id,
                    'foto_portofolio' => "assets/img/portofolio/sample-{$i}.jpg",
                    'keterangan' => "Project Pernikahan Mewah {$i} oleh {$wo->nama_wo}",
                    'created_at' => now()->subMonths($i), // Tanggal berbeda-beda
                ]);
            }
        }
    }
}
