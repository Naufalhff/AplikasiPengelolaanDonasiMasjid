<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->bigIncrements('id_donasi');
            $table->foreignId('id_kegiatan')
                ->constrained('kegiatan', 'id_kegiatan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('metode_pembayaran', ['BSI', 'QRIS']);
            $table->string('nama_donatur', 75);
            $table->string('alamat_donatur', 255);
            $table->string('no_telepon_donatur', 15);
            $table->string('email_donatur', 255);
            $table->decimal('jumlah_donasi', 15, 2);
            $table->string('bukti_pembayaran', 255);
            $table->enum('status_verifikasi', ['PENDING', 'VALID', 'INVALID'])->default('PENDING');
            $table->timestamp('tanggal_donasi');
            $table->timestamp('tanggal_verifikasi')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donasi');
    }
};
