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
                'id_donasi' => 1,
                'nama_kegiatan' => 'kurban',
                'anggaran_kegiatan' => 5000000,
                'penerima_manfaat' => 'semua anggota di polban',
            ]
        ]);
    }
}
