<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id_kegiatan');
            $table->string('foto_kegiatan');
            $table->string('nama_kegiatan');
            $table->enum('jenis_kegiatan', ['INFAQ', 'ZAKAT', 'SEDEKAH', 'KEGIATAN']);
            $table->text('deskripsi_kegiatan');
            $table->float('anggaran_kegiatan');
            $table->float('anggaran_terkumpul')->default(0);
            $table->string('penerima_manfaat');
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->timestamp('tanggal_diubah')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
