<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pemesanans';

    protected $fillable = [
        'id',
        'user_id',
        'layanan_id',
        'tgl_acara',
        'lokasi_acara',
        'catatan',
        'status_pesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'pemesanan_id', 'id');
    }
}
