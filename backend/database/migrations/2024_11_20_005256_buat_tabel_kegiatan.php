<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->string('foto_kegiatan', 255);
            $table->string('nama_kegiatan', 100);
            $table->enum('jenis_kegiatan', ['ZAKAT', 'SUMBANGAN', 'ZAKAT MAL']);
            $table->text('deskripsi_kegiatan');
            $table->decimal('anggaran_donasi', 15, 2);
            $table->decimal('anggaran_terkumpul', 15, 2);
            $table->decimal('anggaran_pengeluaran', 15, 2);
            $table->timestamp('tanggal_dibuat');
            $table->timestamp('tanggal_dirubah')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
};
