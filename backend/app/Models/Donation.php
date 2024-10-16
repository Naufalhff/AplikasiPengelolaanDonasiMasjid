<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'jenis_donasi',
        'nama_donatur',
        'alamat_donatur',
        'no_telepon_donatur',
        'email_donatur',
        'jumlah_donasi',
        'tanggal_donasi',
        'bukti_pembayaran',
    ];
}
