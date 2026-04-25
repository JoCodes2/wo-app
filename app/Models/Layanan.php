<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'layanans';

    protected $fillable = [
        'id',
        'wo_id',
        'kategori_id',
        'nama_layanan',
        'harga',
        'detail_layanan',
    ];

    public function wo()
    {
        return $this->belongsTo(ProfilWo::class, 'wo_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
