<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProfilWo;
use Illuminate\Database\Seeder;

class ProfilWoSeeder extends Seeder
{
    public function run(): void
    {
        $wo1 = User::where('email', 'marita@mail.com')->first();
        ProfilWo::create([
            'user_id' => $wo1->id,
            'nama_wo' => 'Marita House of Wedding',
            'biodata_pengelola' => 'Profesional MUA Palu',
            'alamat_wo' => 'Jalan Towua, Kota Palu',
            'deskripsi_wo' => 'Spesialis Mapacci dan Resepsi',
            'kontak' => '081243438692',
            'sosial_media' => '@marita_wedding_palu'
        ]);

        $wo2 = User::where('email', 'garden@mail.com')->first();
        ProfilWo::create(['user_id' => $wo2->id, 'nama_wo' => 'Palu Outdoor Wedding', 'biodata_pengelola' => 'Rian Garden', 'alamat_wo' => 'Jl. Moh. Hatta, Palu', 'deskripsi_wo' => 'Spesialis Outdoor', 'kontak' => '08520', 'sosial_media' => '@palu_outdoor']);

        $wo3 = User::where('email', 'tadulako@mail.com')->first();
        ProfilWo::create(['user_id' => $wo3->id, 'nama_wo' => 'Tadulako WO', 'biodata_pengelola' => 'Team Tadulako', 'alamat_wo' => 'Jl. Tondo, Palu', 'deskripsi_wo' => 'Modern & Creative', 'kontak' => '08218', 'sosial_media' => '@tadulako_wo']);
    }
}
