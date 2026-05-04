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
        $pesanan = Pemesanan::where('status_pesanan', 'selesai')->first();
        $andi = User::where('email', 'andi@mail.com')->first();

        Ulasan::create([
            'pemesanan_id' => $pesanan->id,
            'user_id' => $andi->id,
            'rating' => 5,
            'komentar' => 'Sangat bagus pelayanannya!'
        ]);
    }
}
