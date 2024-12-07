<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rekening_pembayaran', function (Blueprint $table) {
            $table->id('id_rekening');
            $table->foreignId('id_kegiatan')
                ->constrained('kegiatan', 'id_kegiatan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('jenis_rekening', ['BSI', 'QRIS']);
            $table->string('informasi_rekening', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('metode_pembayaran');
    }
};
