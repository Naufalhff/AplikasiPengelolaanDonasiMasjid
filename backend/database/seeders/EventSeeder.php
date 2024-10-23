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
                'nama_kegiatan' => 'Kurban Polban',
                'jenis_kegiatan' => 'INFAQ',
                'deskripsi_kegiatan' => 'Pengumpulan dana kurban untuk seluruh anggota Polban.',
                'anggaran_kegiatan' => 5000000,
                'anggaran_terkumpul' => 2000000,
                'penerima_manfaat' => 'Seluruh anggota di Polban',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_2.jpg',
                'nama_kegiatan' => 'Santunan Anak Yatim',
                'jenis_kegiatan' => 'ZAKAT',
                'deskripsi_kegiatan' => 'Santunan kepada anak yatim di lingkungan sekitar.',
                'anggaran_kegiatan' => 3000000,
                'anggaran_terkumpul' => 2500000,
                'penerima_manfaat' => 'Anak yatim di wilayah Polban',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ],
            [
                'foto_kegiatan' => 'event_3.jpg',
                'nama_kegiatan' => 'Pengumpulan Dana Panti Asuhan',
                'jenis_kegiatan' => 'SEDEKAH',
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
                'jenis_kegiatan' => 'INFAQ',
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
                'jenis_kegiatan' => 'KEGIATAN',
                'deskripsi_kegiatan' => 'Bakti sosial untuk membantu masyarakat sekitar.',
                'anggaran_kegiatan' => 6000000,
                'anggaran_terkumpul' => 4500000,
                'penerima_manfaat' => 'Masyarakat di wilayah Polban',
                'tanggal_dibuat' => now(),
                'tanggal_diubah' => now(),
            ]
        ]);
    }
}
