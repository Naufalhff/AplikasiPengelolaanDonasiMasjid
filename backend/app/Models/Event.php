<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kegiatan';
    public $incrementing = true;

    protected $fillable = [
        'foto_kegiatan',
        'nama_kegiatan',
        'jenis_kegiatan',
        'deskripsi_kegiatan',
        'anggaran_kegiatan',
        'anggaran_terkumpul',
        'penerima_manfaat',
        'tanggal_dibuat',
        'tanggal_diubah',
    ];

    public $timestamps = false;

    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diubah';

    public function donations()
    {
        return $this->hasMany(Donation::class, 'id_kegiatan');
    }
}
