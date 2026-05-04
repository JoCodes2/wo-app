<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create(['nama_kategori' => 'Indoor']);
        Kategori::create(['nama_kategori' => 'Outdoor']);
        Kategori::create(['nama_kategori' => 'Tradisional']);
        Kategori::create(['nama_kategori' => 'Indoor & Outdoor']);
    }
}
