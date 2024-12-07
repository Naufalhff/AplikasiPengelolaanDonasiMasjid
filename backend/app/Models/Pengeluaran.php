<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    public $timestamps = true;

    const CREATED_AT = 'tanggal_transaksi';
    const UPDATED_AT = null;

    protected $fillable = [
        'id_kegiatan',
        'nama_transaksi',
        'deskripsi_transaksi',
        'total_pengeluaran',
        'bukti_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'total_pengeluaran' => 'decimal:2',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}
