<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProfilWo;
use Illuminate\Database\Seeder;

class ProfilWoSeeder extends Seeder
{
    public function run(): void
    {
        $dataWo = [
            ['email' => 'marita@mail.com', 'nama' => 'Marita House of Wedding', 'alamat' => 'Jl. Towua, Kota Palu', 'desc' => 'Spesialis pengantin tradisional dan modern dengan sentuhan MUA profesional.'],
            ['email' => 'moy@mail.com', 'nama' => 'Moy Organizer', 'alamat' => 'Jl. Moh. Hatta, Palu', 'desc' => 'Penyedia layanan Wedding Organizer yang detail dan terorganisir untuk hari bahagia Anda.'],
            ['email' => 'thechox@mail.com', 'nama' => 'Thechox', 'alamat' => 'Jl. Juanda, Palu', 'desc' => 'Creative wedding planner dengan konsep unik dan kekinian untuk pasangan muda.'],
            ['email' => 'warna@mail.com', 'nama' => 'Warna Organizer', 'alamat' => 'Jl. S. Parman, Palu', 'desc' => 'Mewujudkan pernikahan impian dengan penuh warna dan keceriaan di setiap momen.'],
            ['email' => 'happy@mail.com', 'nama' => 'Happy EO', 'alamat' => 'Jl. Tadulako, Palu', 'desc' => 'Solusi lengkap perencanaan acara dan pernikahan yang menyenangkan tanpa rasa khawatir.'],
        ];

        foreach ($dataWo as $item) {
            $user = User::where('email', $item['email'])->first();
            ProfilWo::create([
                'user_id' => $user->id,
                'nama_wo' => $item['nama'],
                'biodata_pengelola' => 'Pengelola ' . $item['nama'],
                'alamat_wo' => $item['alamat'],
                'deskripsi_wo' => $item['desc'],
                'kontak' => $user->no_hp,
                'sosial_media' => '@' . strtolower(str_replace(' ', '_', $item['nama']))
            ]);
        }
    }
}
