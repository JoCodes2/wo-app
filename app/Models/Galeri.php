<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'galeris';

    protected $fillable = [
        'id',
        'wo_id',
        'foto_portofolio',
        'keterangan',
    ];

    public function wo()
    {
        return $this->belongsTo(ProfilWo::class, 'wo_id', 'id');
    }
}
