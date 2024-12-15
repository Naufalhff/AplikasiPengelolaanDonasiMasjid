<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederPengeluaran extends Seeder
{
    public function run()
    {
        $pengeluaran = [
            [
                'id_kegiatan' => 1,
                'nama_transaksi' => 'Distribusi Zakat Fitrah',
                'deskripsi_transaksi' => 'Pembelian kebutuhan pokok untuk distribusi zakat fitrah.',
                'total_pengeluaran' => 2000000.00,
                'bukti_transaksi' => 'distribusi_zakat_fitrah.jpg',
                'tanggal_transaksi' => now(),
            ],
            [
                'id_kegiatan' => 2,
                'nama_transaksi' => 'Pembelian Logistik Bencana',
                'deskripsi_transaksi' => 'Pembelian logistik untuk korban bencana alam.',
                'total_pengeluaran' => 1500000.00,
                'bukti_transaksi' => 'logistik_bencana.jpg',
                'tanggal_transaksi' => now(),
            ],
            [
                'id_kegiatan' => 3,
                'nama_transaksi' => 'Distribusi Zakat Mal',
                'deskripsi_transaksi' => 'Penyaluran dana zakat mal untuk penerima manfaat.',
                'total_pengeluaran' => 3000000.00,
                'bukti_transaksi' => 'distribusi_zakat_mal.jpg',
                'tanggal_transaksi' => now(),
            ],
            [
                'id_kegiatan' => 4,
                'nama_transaksi' => 'Bantuan Sosial Tunai',
                'deskripsi_transaksi' => 'Penyaluran bantuan sosial kepada keluarga kurang mampu.',
                'total_pengeluaran' => 1000000.00,
                'bukti_transaksi' => 'bantuan_sosial.jpg',
                'tanggal_transaksi' => now(),
            ],
            [
                'id_kegiatan' => 5,
                'nama_transaksi' => 'Pembelian Material Pembangunan Masjid',
                'deskripsi_transaksi' => 'Pembelian material untuk pembangunan masjid di desa.',
                'total_pengeluaran' => 5000000.00,
                'bukti_transaksi' => 'material_pembangunan_mesjid.jpg',
                'tanggal_transaksi' => now(),
            ],
        ];

        DB::table('pengeluaran')->insert($pengeluaran);
    }
}
