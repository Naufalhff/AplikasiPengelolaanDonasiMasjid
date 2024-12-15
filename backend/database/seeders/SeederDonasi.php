<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederDonasi extends Seeder
{
    public function run()
    {
        $donasiData = [
            [
                'id_kegiatan' => 1,
                'metode_pembayaran' => 'BSI',
                'nama_donatur' => 'Ahmad Fahri',
                'alamat_donatur' => 'Jl. Merdeka No. 12, Jakarta',
                'no_telepon_donatur' => '081234567890',
                'email_donatur' => 'ahmad.fahri@example.com',
                'jumlah_donasi' => 3000000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/cash_receipt_1.jpg',
                'status_verifikasi' => 'VALID',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 1,
                'metode_pembayaran' => 'BSI',
                'nama_donatur' => 'Siti Rahma',
                'alamat_donatur' => 'Jl. Kebangsaan No. 45, Bandung',
                'no_telepon_donatur' => '082345678901',
                'email_donatur' => 'siti.rahma@example.com',
                'jumlah_donasi' => 1000000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/bsi_transfer_1.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 2,
                'metode_pembayaran' => 'QRIS',
                'nama_donatur' => 'Budi Santoso',
                'alamat_donatur' => 'Jl. Pahlawan No. 78, Surabaya',
                'no_telepon_donatur' => '083456789012',
                'email_donatur' => 'budi.santoso@example.com',
                'jumlah_donasi' => 8500000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/qris_payment_1.jpg',
                'status_verifikasi' => 'VALID',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 2,
                'metode_pembayaran' => 'BSI',
                'nama_donatur' => 'Rina Marlina',
                'alamat_donatur' => 'Jl. Bunga Melati No. 23, Medan',
                'no_telepon_donatur' => '081345678912',
                'email_donatur' => 'rina.marlina@example.com',
                'jumlah_donasi' => 200000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/cash_receipt_2.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 3,
                'metode_pembayaran' => 'BSI',
                'nama_donatur' => 'Dewi Lestari',
                'alamat_donatur' => 'Jl. Sudirman No. 56, Yogyakarta',
                'no_telepon_donatur' => '082456789013',
                'email_donatur' => 'dewi.lestari@example.com',
                'jumlah_donasi' => 5000000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/bsi_transfer_2.jpg',
                'status_verifikasi' => 'VALID',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 3,
                'metode_pembayaran' => 'QRIS',
                'nama_donatur' => 'Hendra Wijaya',
                'alamat_donatur' => 'Jl. Karya Jaya No. 89, Makassar',
                'no_telepon_donatur' => '083567890124',
                'email_donatur' => 'hendra.wijaya@example.com',
                'jumlah_donasi' => 150000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/qris_payment_2.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 4,
                'metode_pembayaran' => 'QRIS',
                'nama_donatur' => 'Fajar Nugraha',
                'alamat_donatur' => 'Jl. Rawa Indah No. 34, Semarang',
                'no_telepon_donatur' => '081456789035',
                'email_donatur' => 'fajar.nugraha@example.com',
                'jumlah_donasi' => 4000000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/cash_receipt_3.jpg',
                'status_verifikasi' => 'VALID',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 4,
                'metode_pembayaran' => 'BSI',
                'nama_donatur' => 'Lukman Hakim',
                'alamat_donatur' => 'Jl. Sisingamangaraja No. 21, Bali',
                'no_telepon_donatur' => '082678901236',
                'email_donatur' => 'lukman.hakim@example.com',
                'jumlah_donasi' => 2500000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/bsi_transfer_3.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 5,
                'metode_pembayaran' => 'QRIS',
                'nama_donatur' => 'Nurul Aini',
                'alamat_donatur' => 'Jl. Diponegoro No. 15, Malang',
                'no_telepon_donatur' => '083789012347',
                'email_donatur' => 'nurul.aini@example.com',
                'jumlah_donasi' => 10000000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/qris_payment_3.jpg',
                'status_verifikasi' => 'VALID',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
            [
                'id_kegiatan' => 5,
                'metode_pembayaran' => 'QRIS',
                'nama_donatur' => 'Ridwan Kamil',
                'alamat_donatur' => 'Jl. Gatot Subroto No. 99, Palembang',
                'no_telepon_donatur' => '081567890348',
                'email_donatur' => 'ridwan.kamil@example.com',
                'jumlah_donasi' => 750000.00,
                'bukti_pembayaran' => 'bukti_pembayaran/cash_receipt_4.jpg',
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ],
        ];

        DB::table('donasi')->insert($donasiData);
    }
}
