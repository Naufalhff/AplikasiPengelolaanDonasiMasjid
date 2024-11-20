<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';

    const CREATED_AT = 'tanggal_donasi';
    const UPDATED_AT = 'tanggal_verifikasi';

    protected $fillable = [
        'id_kegiatan',
        'metode_pembayaran',
        'nama_donatur',
        'alamat_donatur',
        'no_telepon_donatur',
        'email_donatur',
        'jumlah_donasi',
        'bukti_pembayaran',
        'status_verifikasi'
    ];

    protected $casts = [
        'tanggal_donasi' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'jumlah_donasi' => 'decimal:2'
    ];

    /**
     * Get the kegiatan that owns the donation
     */
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}
