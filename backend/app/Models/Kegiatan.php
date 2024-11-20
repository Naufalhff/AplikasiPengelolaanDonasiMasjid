<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    public $timestamps = true;

    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_dirubah';

    protected $fillable = [
        'foto_kegiatan',
        'nama_kegiatan',
        'jenis_kegiatan',
        'deskripsi_kegiatan',
        'anggaran_donasi',
        'anggaran_terkumpul',
        'anggaran_pengeluaran'
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime',
        'tanggal_dirubah' => 'datetime',
        'anggaran_donasi' => 'decimal:2',
        'anggaran_terkumpul' => 'decimal:2',
        'anggaran_pengeluaran' => 'decimal:2'
    ];
}
