<?php

namespace Database\Seeders;

use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Ulasan;
use Illuminate\Database\Seeder;

class UlasanSeeder extends Seeder
{
    public function run(): void
    {
        $pesanans = Pemesanan::where('status_pesanan', 'selesai')->get();

        $komentars = [
            'Sangat puas dengan pelayanannya, tim sangat profesional!',
            'Dekorasinya mewah sekali, melebihi ekspektasi saya.',
            'MUA-nya sangat halus, riasannya tahan lama sampai acara selesai.',
            'Koordinasi tim lapangan sangat rapi, acara berjalan lancar.',
            'Harga sangat bersahabat dengan kualitas bintang lima.'
        ];

        foreach ($pesanans as $key => $p) {
            \App\Models\Ulasan::create([
                'pemesanan_id' => $p->id,
                'user_id' => $p->user_id,
                'rating' => rand(4, 5),
                'komentar' => $komentars[$key % 5]
            ]);
        }
    }
}
