<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    public $timestamps = true;

    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_dirubah';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'peran'
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime',
        'tanggal_dirubah' => 'datetime',
    ];
}

