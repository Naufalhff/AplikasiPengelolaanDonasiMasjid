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
        Schema::create('donations', function (Blueprint $table) {
            $table->bigIncrements('id_donasi');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_kegiatan');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('events')->onDelete('cascade');
            $table->string('nama_donatur', 100);
            $table->string('alamat_donatur');
            $table->string('no_telepon_donatur');
            $table->string('email_donatur');
            $table->float('jumlah_donasi');
            $table->string('metode_pembayaran');
            $table->string('bukti_pembayaran');
            $table->enum('status_verifikasi', ['PENDING', 'VALID', 'INVALID'])->default('PENDING');
            $table->timestamp('tanggal_donasi')->useCurrent();
            $table->timestamp('tanggal_verifikasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
