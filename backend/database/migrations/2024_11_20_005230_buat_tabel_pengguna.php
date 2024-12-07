<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table)
        {
            $table->id('id_pengguna');
            $table->string('nama_lengkap', 75);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->enum('peran', ['Pengurus Masjid', 'Donatur', 'Administrator', 'Bendahara']);
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->timestamp('tanggal_dirubah')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
};
