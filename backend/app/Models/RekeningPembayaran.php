<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningPembayaran extends Model
{
    use HasFactory;

    protected $table = 'rekening_pembayaran';
    protected $primaryKey = 'id_rekening';
    protected $fillable = [
        'id_kegiatan',
        'jenis_rekening',
        'informasi_rekening',
    ];
    public $timestamps = false;

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}
