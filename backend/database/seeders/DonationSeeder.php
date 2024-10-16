<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Donation::insert([
            [
                'id_user' => 1,
                'jenis_donasi' => 'infaq',
                'nama_donatur' => 'John Doe',
                'alamat_donatur' => 'Jl.indah gang 5',
                'no_telepon_donatur' => '0812 8273 1372',
                'email_donatur' => 'johndoe@gmail.com',
                'jumlah_donasi' => 1000000,
                'tanggal_donasi' => now(),
                'bukti_pembayaran' => 'C:\documents\bukti_pembayaran\001.jpg',
            ]
        ]);
    }
}
