<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;
use Carbon\Carbon;

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
                'id_kegiatan' => 1,
                'nama_donatur' => 'John Doe',
                'alamat_donatur' => 'Jl. Indah gang 5',
                'no_telepon_donatur' => '0812 8273 1372',
                'email_donatur' => 'johndoe@gmail.com',
                'jumlah_donasi' => 1000000,
                'metode_pembayaran' => 'BCA',
                'bukti_pembayaran' => 'C:\documents\bukti_pembayaran\001.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_user' => 2,
                'id_kegiatan' => 2,
                'nama_donatur' => 'Jane Smith',
                'alamat_donatur' => 'Jl. Harmoni No.12',
                'no_telepon_donatur' => '0812 1234 5678',
                'email_donatur' => 'janesmith@gmail.com',
                'jumlah_donasi' => 500000,
                'metode_pembayaran' => 'BCA',
                'bukti_pembayaran' => 'C:\documents\bukti_pembayaran\002.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_user' => 3,
                'id_kegiatan' => 1,
                'nama_donatur' => 'Alice Johnson',
                'alamat_donatur' => 'Jl. Bahagia No.8',
                'no_telepon_donatur' => '0812 9988 7766',
                'email_donatur' => 'alicejohnson@gmail.com',
                'jumlah_donasi' => 250000,
                'metode_pembayaran' => 'BRI',
                'bukti_pembayaran' => 'C:\documents\bukti_pembayaran\003.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_user' => 4,
                'id_kegiatan' => 3,
                'nama_donatur' => 'Bob Williams',
                'alamat_donatur' => 'Jl. Kenangan No.15',
                'no_telepon_donatur' => '0812 4321 8765',
                'email_donatur' => 'bobwilliams@gmail.com',
                'jumlah_donasi' => 1500000,
                'metode_pembayaran' => 'BRI',
                'bukti_pembayaran' => 'C:\documents\bukti_pembayaran\004.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_user' => 5,
                'id_kegiatan' => 2,
                'nama_donatur' => 'Charlie Davis',
                'alamat_donatur' => 'Jl. Bunga Mawar No.3',
                'no_telepon_donatur' => '0812 2345 6789',
                'email_donatur' => 'charliedavis@gmail.com',
                'jumlah_donasi' => 800000,
                'metode_pembayaran' => 'BRI',
                'bukti_pembayaran' => 'C:\documents\bukti_pembayaran\005.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
        ]);
    }
}
