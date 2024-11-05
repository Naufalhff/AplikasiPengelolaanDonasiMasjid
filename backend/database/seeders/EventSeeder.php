<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::insert([
            [
                'foto_kegiatan' => 'event_1.jpg',
                'nama_kegiatan' => 'Zakat Fitrah',
                'jenis_kegiatan' => 'ZAKAT FITRAH',
                'deskripsi_kegiatan' => 'Zakat Fitrah adalah zakat yang wajib dikeluarkan oleh umat Muslim pada bulan Ramadan sebagai bentuk penyucian diri dan solidaritas kepada mereka yang membutuhkan.',
                'anggaran_kegiatan' => 5000000,
                'anggaran_terkumpul' => 2000000,
                'penerima_manfaat' => 'Seluruh anggota di Polban',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_2.jpg',
                'nama_kegiatan' => 'Zakat Mal',
                'jenis_kegiatan' => 'ZAKAT',
                'deskripsi_kegiatan' => 'Zakat Mal adalah zakat harta yang dikeluarkan oleh umat Muslim atas kekayaan yang dimiliki, seperti emas, perak, uang, dan aset lainnya, untuk membantu mereka yang membutuhkan.',
                'anggaran_kegiatan' => 3000000,
                'anggaran_terkumpul' => 2500000,
                'penerima_manfaat' => 'Anak yatim di wilayah Polban',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_3.jpg',
                'nama_kegiatan' => 'Pengumpulan Dana Panti Asuhan',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Pengumpulan dana untuk membantu panti asuhan.',
                'anggaran_kegiatan' => 4000000,
                'anggaran_terkumpul' => 1000000,
                'penerima_manfaat' => 'Panti asuhan setempat',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_4.jpg',
                'nama_kegiatan' => 'Bantuan Pembangunan Masjid',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Bantuan untuk pembangunan masjid di Polban.',
                'anggaran_kegiatan' => 8000000,
                'anggaran_terkumpul' => 3000000,
                'penerima_manfaat' => 'Masyarakat sekitar Polban',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_5.jpg',
                'nama_kegiatan' => 'Bakti Sosial Mahasiswa',
                'jenis_kegiatan' => 'SUMBANGAN',
                'deskripsi_kegiatan' => 'Bakti sosial untuk membantu masyarakat sekitar.',
                'anggaran_kegiatan' => 6000000,
                'anggaran_terkumpul' => 4500000,
                'penerima_manfaat' => 'Masyarakat di wilayah Polban',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_emas.jpg',
                'nama_kegiatan' => 'Zakat Emas dan Logam',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat emas dan logam merupakan zakat yang dikenakan atas kepemilikan emas dan logam mulia lainnya yang telah mencapai nisab dan haul.',
                'anggaran_kegiatan' => 5000000,
                'anggaran_terkumpul' => 3000000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_perusahaan.jpg',
                'nama_kegiatan' => 'Zakat Perusahaan',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat perusahaan adalah zakat yang dikenakan atas keuntungan perusahaan yang telah mencapai nisab selama satu tahun.',
                'anggaran_kegiatan' => 7000000,
                'anggaran_terkumpul' => 4000000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_perdagangan.jpg',
                'nama_kegiatan' => 'Zakat Perdagangan',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat perdagangan dikenakan atas harta perdagangan seperti barang dagangan yang mencapai nisab dan haul.',
                'anggaran_kegiatan' => 6000000,
                'anggaran_terkumpul' => 3500000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_tabungan.jpg',
                'nama_kegiatan' => 'Zakat Tabungan dan Investasi',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat tabungan dan investasi merupakan zakat yang dikenakan atas harta simpanan dan investasi yang telah mencapai nisab.',
                'anggaran_kegiatan' => 8000000,
                'anggaran_terkumpul' => 5000000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_pertanian.jpg',
                'nama_kegiatan' => 'Zakat Pertanian',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat pertanian adalah zakat yang dikeluarkan dari hasil panen pertanian setelah mencapai nisab.',
                'anggaran_kegiatan' => 4000000,
                'anggaran_terkumpul' => 2000000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_peternakan.jpg',
                'nama_kegiatan' => 'Zakat Peternakan',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat peternakan dikenakan atas hasil peternakan yang mencapai nisab, seperti kambing, sapi, dan unta.',
                'anggaran_kegiatan' => 4500000,
                'anggaran_terkumpul' => 2500000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_pertambangan.jpg',
                'nama_kegiatan' => 'Zakat Pertambangan',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat pertambangan adalah zakat yang dikeluarkan dari hasil pertambangan yang mencapai nisab.',
                'anggaran_kegiatan' => 9000000,
                'anggaran_terkumpul' => 6000000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_rikaz.jpg',
                'nama_kegiatan' => 'Zakat Rikaz',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat rikaz adalah zakat yang dikenakan atas harta karun atau barang temuan yang ditemukan.',
                'anggaran_kegiatan' => 3000000,
                'anggaran_terkumpul' => 1500000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_penghasilan.jpg',
                'nama_kegiatan' => 'Zakat Penghasilan',
                'jenis_kegiatan' => 'ZAKAT MAL',
                'deskripsi_kegiatan' => 'Zakat penghasilan adalah zakat yang dikenakan atas penghasilan atau gaji yang telah mencapai nisab.',
                'anggaran_kegiatan' => 7000000,
                'anggaran_terkumpul' => 4500000,
                'penerima_manfaat' => 'Kaum fakir, miskin, amil zakat, muallaf, gharimin, fisabilillah, dan ibnu sabil',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ]
        ]);
    }
}
