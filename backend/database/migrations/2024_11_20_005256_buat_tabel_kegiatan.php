<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->string('foto_kegiatan', 255);
            $table->string('nama_kegiatan', 100)->unique();
<<<<<<< HEAD
            $table->enum('jenis_kegiatan', ['ZAKAT', 'SUMBANGAN', 'ZAKAT MAL']);
=======
            $table->enum('jenis_kegiatan', ['ZAKAT FITRAH', 'SUMBANGAN', 'JENIS ZAKAT MAL', 'ZAKAT MAL']);
>>>>>>> 4271c3dd247ef2cecfaa6fdd6d5216cebbde756a
            $table->text('deskripsi_kegiatan');
            $table->decimal('anggaran_donasi', 15, 2);
            $table->decimal('anggaran_terkumpul', 15, 2);
            $table->decimal('anggaran_pengeluaran', 15, 2);
            $table->date('tenggat_waktu');
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->timestamp('tanggal_dirubah')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
};
