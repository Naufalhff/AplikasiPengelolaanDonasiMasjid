<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SeederPengguna::class,
            SeederKegiatan::class,
            SeederRekeningPembayaran::class,
            SeederDonasi::class,
            SeederPengeluaran::class,
        ]);
    }
}
