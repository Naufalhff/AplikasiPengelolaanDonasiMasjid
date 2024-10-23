<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_donasi';
    public $incrementing = true;
    protected $keyType = 'bigint';

    protected $fillable = [
        'id_user',
        'id_kegiatan',
        'nama_donatur',
        'alamat_donatur',
        'no_telepon_donatur',
        'email_donatur',
        'jumlah_donasi',
        'bukti_pembayaran',
        'status_verifikasi',
        'tanggal_donasi',
        'tanggal_verifikasi',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_kegiatan');
    }
}
