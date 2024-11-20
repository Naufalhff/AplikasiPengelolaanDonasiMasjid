<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederMetodePembayaran extends Seeder
{
    public function run()
    {
        $metodePembayaran = [
            [
                'id_kegiatan' => 1,
                'metode' => 'BSI',
                'detail' => '1234567890',
            ],
            [
                'id_kegiatan' => 1,
                'metode' => 'QRIS',
                'detail' => 'qris/directory_1',
            ],
            [
                'id_kegiatan' => 2,
                'metode' => 'BSI',
                'detail' => '0987654321',
            ],
            [
                'id_kegiatan' => 2,
                'metode' => 'QRIS',
                'detail' => 'qris/directory_2',
            ],
            [
                'id_kegiatan' => 3,
                'metode' => 'BSI',
                'detail' => '1122334455',
            ],
            [
                'id_kegiatan' => 3,
                'metode' => 'QRIS',
                'detail' => 'qris/directory_3',
            ],
            [
                'id_kegiatan' => 4,
                'metode' => 'BSI',
                'detail' => '5566778899',
            ],
            [
                'id_kegiatan' => 4,
                'metode' => 'QRIS',
                'detail' => 'qris/directory_4',
            ],
            [
                'id_kegiatan' => 5,
                'metode' => 'BSI',
                'detail' => '6677889900',
            ],
            [
                'id_kegiatan' => 5,
                'metode' => 'QRIS',
                'detail' => 'qris/directory_5',
            ],
        ];

        DB::table('metode_pembayaran')->insert($metodePembayaran);
    }
}
