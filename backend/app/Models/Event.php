<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_donasi',
        'nama_kegiatan',
        'anggaran_kegiatan',
        'penerima_manfaat',
    ];
}
