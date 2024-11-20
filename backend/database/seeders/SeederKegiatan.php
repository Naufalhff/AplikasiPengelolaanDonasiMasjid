<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederKegiatan extends Seeder
{
    public function run()
    {
        $kegiatan = [
            [
                'foto_kegiatan' => 'zakat_fitrah.jpg',
                'nama_kegiatan' => 'Distribusi Zakat Fitrah',
                'jenis_kegiatan' => 'ZAKAT',
                'deskripsi_kegiatan' => 'Kegiatan pendistribusian zakat fitrah kepada yang berhak menerima.',
                'anggaran_donasi' => 5000000.00,
                'anggaran_terkumpul' => 3000000.00,
                'anggaran_pengeluaran' => 2500000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'sumbangan_bencana.jpg',
                'nama_kegiatan' => 'Penggalangan Sumbangan Bencana',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Sumbangan untuk korban bencana alam di wilayah terdampak.',
                'anggaran_donasi' => 10000000.00,
                'anggaran_terkumpul' => 8500000.00,
                'anggaran_pengeluaran' => 4000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'zakat_mal.jpg',
                'nama_kegiatan' => 'Pengumpulan Zakat Mal',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Kegiatan pengumpulan zakat mal untuk distribusi yang sesuai syariat.',
                'anggaran_donasi' => 7000000.00,
                'anggaran_terkumpul' => 5000000.00,
                'anggaran_pengeluaran' => 3000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'bantuan_sosial.jpg',
                'nama_kegiatan' => 'Bantuan Sosial untuk Keluarga Kurang Mampu',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Program bantuan sosial untuk mendukung keluarga kurang mampu.',
                'anggaran_donasi' => 6000000.00,
                'anggaran_terkumpul' => 4000000.00,
                'anggaran_pengeluaran' => 2000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'pembangunan_mesjid.jpg',
                'nama_kegiatan' => 'Pembangunan Masjid',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Menggalang dana untuk pembangunan masjid baru di desa.',
                'anggaran_donasi' => 15000000.00,
                'anggaran_terkumpul' => 10000000.00,
                'anggaran_pengeluaran' => 5000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah2.jpg',
                'nama_kegiatan' => 'Pendistribusian Zakat Fitrah II',
                'jenis_kegiatan' => 'ZAKAT',
                'deskripsi_kegiatan' => 'Penyaluran zakat fitrah kepada fakir miskin di daerah terpencil.',
                'anggaran_donasi' => 8000000.00,
                'anggaran_terkumpul' => 6000000.00,
                'anggaran_pengeluaran' => 3000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'penggalangan_dana.jpg',
                'nama_kegiatan' => 'Penggalangan Dana Umum',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Penggalangan dana umum untuk keperluan sosial dan kemanusiaan.',
                'anggaran_donasi' => 9000000.00,
                'anggaran_terkumpul' => 7000000.00,
                'anggaran_pengeluaran' => 2500000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'renovasi_sekolah.jpg',
                'nama_kegiatan' => 'Renovasi Sekolah Dasar',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Menggalang dana untuk merenovasi sekolah dasar yang rusak.',
                'anggaran_donasi' => 12000000.00,
                'anggaran_terkumpul' => 8000000.00,
                'anggaran_pengeluaran' => 4500000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Fitrah Tahap III',
                'jenis_kegiatan' => 'ZAKAT',
                'deskripsi_kegiatan' => 'Pendistribusian zakat fitrah tahap ketiga untuk warga kurang mampu.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
            [
                'foto_kegiatan' => 'bakti_sosial.jpg',
                'nama_kegiatan' => 'Bakti Sosial',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Kegiatan bakti sosial untuk membantu warga yang membutuhkan.',
                'anggaran_donasi' => 4000000.00,
                'anggaran_terkumpul' => 3000000.00,
                'anggaran_pengeluaran' => 1500000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ],
        ];

        DB::table('kegiatan')->insert($kegiatan);
    }
}
