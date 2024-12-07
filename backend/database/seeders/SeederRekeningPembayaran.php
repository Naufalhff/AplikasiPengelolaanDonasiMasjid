<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederRekeningPembayaran extends Seeder
{
    public function run()
    {
        DB::table('rekening_pembayaran')->insert([
            [
                'id_kegiatan' => 1,
                'jenis_rekening' => 'BSI',
                'informasi_rekening' => '123456789',
            ],
            [
                'id_kegiatan' => 1,
                'jenis_rekening' => 'QRIS',
                'informasi_rekening' => 'storage/qris/qris_kegiatan_1.png',
            ],
            [
                'id_kegiatan' => 2,
                'jenis_rekening' => 'BSI',
                'informasi_rekening' => '987654321',
            ],
            [
                'id_kegiatan' => 2,
                'jenis_rekening' => 'QRIS',
                'informasi_rekening' => 'storage/qris/qris_kegiatan_2.png',
            ],
            [
                'id_kegiatan' => 3,
                'jenis_rekening' => 'BSI',
                'informasi_rekening' => '456789123',
            ],
            [
                'id_kegiatan' => 3,
                'jenis_rekening' => 'QRIS',
                'informasi_rekening' => 'storage/qris/qris_kegiatan_3.png',
            ],
            [
                'id_kegiatan' => 4,
                'jenis_rekening' => 'BSI',
                'informasi_rekening' => '654321987',
            ],
            [
                'id_kegiatan' => 4,
                'jenis_rekening' => 'QRIS',
                'informasi_rekening' => 'storage/qris/qris_kegiatan_4.png',
            ],
            [
                'id_kegiatan' => 5,
                'jenis_rekening' => 'BSI',
                'informasi_rekening' => '321987654',
            ],
            [
                'id_kegiatan' => 5,
                'jenis_rekening' => 'QRIS',
                'informasi_rekening' => 'storage/qris/qris_kegiatan_5.png',
            ],
        ]);
    }
}
