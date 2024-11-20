<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SeederPengguna extends Seeder
{
    public function run()
    {
        $pengguna = [
            [
                'nama_lengkap' => 'Ahmad Santoso',
                'email' => 'ahmad.santoso@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Pengurus Masjid',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Budi Setiawan',
                'email' => 'budi.setiawan@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Donatur',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Siti Aminah',
                'email' => 'siti.aminah@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Administrator',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Rahmat Hidayat',
                'email' => 'rahmat.hidayat@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Bendahara',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Fitri Damayanti',
                'email' => 'fitri.damayanti@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Pengurus Masjid',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Mulyadi Saputra',
                'email' => 'mulyadi.saputra@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Donatur',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Nurul Aini',
                'email' => 'nurul.aini@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Administrator',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Zainudin Ahmad',
                'email' => 'zainudin.ahmad@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Bendahara',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Rini Kusuma',
                'email' => 'rini.kusuma@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Pengurus Masjid',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'nama_lengkap' => 'Fauzan Ridho',
                'email' => 'fauzan.ridho@example.com',
                'password' => Hash::make('password123'),
                'peran' => 'Donatur',
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
        ];

        DB::table('pengguna')->insert($pengguna);
    }
}
