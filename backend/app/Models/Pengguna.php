<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

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
