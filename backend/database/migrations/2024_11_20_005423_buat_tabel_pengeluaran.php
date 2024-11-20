<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->bigIncrements('id_pengeluaran');
            $table->foreignId('id_kegiatan')
                ->constrained('kegiatan', 'id_kegiatan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nama_transaksi', 255);
            $table->text('deskripsi_transaksi');
            $table->decimal('total_pengeluaran', 15, 2);
            $table->string('bukti_transaksi', 255);
            $table->timestamp('tanggal_transaksi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluaran');
    }
};
