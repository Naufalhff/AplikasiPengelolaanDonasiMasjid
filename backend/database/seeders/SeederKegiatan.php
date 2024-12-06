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
                'nama_kegiatan' => 'Zakat Fitrah',
                'jenis_kegiatan' => 'ZAKAT FITRAH',
                'deskripsi_kegiatan' => 'Zakat Fitrah adalah zakat yang wajib dikeluarkan oleh umat Muslim pada bulan Ramadan sebagai bentuk penyucian diri dan solidaritas kepada mereka yang membutuhkan.',
                'anggaran_donasi' => 5000000.00,
                'anggaran_terkumpul' => 3000000.00,
                'anggaran_pengeluaran' => 2500000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30), // Set tenggat_waktu to 30 days from now
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
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_mal.jpg',
                'nama_kegiatan' => 'Zakat Mal',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat Mal adalah zakat harta yang dikeluarkan oleh umat Muslim atas kekayaan yang dimiliki, seperti emas, perak, uang, dan aset lainnya, untuk membantu mereka yang membutuhkan.',
                'anggaran_donasi' => 7000000.00,
                'anggaran_terkumpul' => 5000000.00,
                'anggaran_pengeluaran' => 3000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
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
                'tenggat_waktu' => now()->addDays(30),
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
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_emas.jpg',
                'nama_kegiatan' => 'Zakat Emas dan Logam',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat emas dan logam merupakan zakat yang dikenakan atas kepemilikan emas dan logam mulia lainnya yang telah mencapai nisab dan haul.',
                'anggaran_donasi' => 8000000.00,
                'anggaran_terkumpul' => 6000000.00,
                'anggaran_pengeluaran' => 3000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
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
                'tenggat_waktu' => now()->addDays(30),
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
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Perusahaan',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat perusahaan adalah zakat yang dikenakan atas keuntungan perusahaan yang telah mencapai nisab selama satu tahun.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Perdagangan',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat perdagangan dikenakan atas harta perdagangan seperti barang dagangan yang mencapai nisab dan haul.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Tabungan dan Investasi',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat tabungan dan investasi merupakan zakat yang dikenakan atas harta simpanan dan investasi yang telah mencapai nisab.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Pertanian',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat pertanian adalah zakat yang dikeluarkan dari hasil panen pertanian setelah mencapai nisab.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Peternakan',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat peternakan dikenakan atas hasil peternakan yang mencapai nisab, seperti kambing, sapi, dan unta.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Pertambangan',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat pertambangan adalah zakat yang dikeluarkan dari hasil pertambangan yang mencapai nisab.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Rikaz',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat rikaz adalah zakat yang dikenakan atas harta karun atau barang temuan yang ditemukan.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
            ],
            [
                'foto_kegiatan' => 'zakat_fitrah3.jpg',
                'nama_kegiatan' => 'Zakat Penghasilan',
                'jenis_kegiatan' => 'JENIS ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat penghasilan adalah zakat yang dikenakan atas penghasilan atau gaji yang telah mencapai nisab.',
                'anggaran_donasi' => 11000000.00,
                'anggaran_terkumpul' => 9000000.00,
                'anggaran_pengeluaran' => 6000000.00,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
                'tenggat_waktu' => now()->addDays(30),
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
                'tenggat_waktu' => now()->addDays(30),
            ],
        ];

        DB::table('kegiatan')->insert($kegiatan);
    }
}
