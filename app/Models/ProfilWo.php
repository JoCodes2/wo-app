<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilWo extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'profil_wo';

    protected $fillable = [
        'id',
        'user_id',
        'nama_wo',
        'biodata_pengelola',
        'alamat_wo',
        'deskripsi_wo',
        'foto_logo',
        'kontak',
        'sosial_media',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function layanans()
    {
        return $this->hasMany(Layanan::class, 'wo_id', 'id');
    }

    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'wo_id', 'id');
    }
}
