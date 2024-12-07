<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class BuatFungsiUpdateAnggaranKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE FUNCTION update_anggaran_kegiatan()
            RETURNS TRIGGER AS $$
            BEGIN
                IF NEW.status_verifikasi = 'VALID' AND OLD.status_verifikasi = 'PENDING' THEN
                    UPDATE kegiatan
                    SET anggaran_terkumpul = anggaran_terkumpul + NEW.jumlah_donasi
                    WHERE id_kegiatan = NEW.id_kegiatan;
                ELSIF NEW.status_verifikasi = 'PENDING' AND OLD.status_verifikasi = 'VALID' THEN
                    UPDATE kegiatan
                    SET anggaran_terkumpul = anggaran_terkumpul - OLD.jumlah_donasi
                    WHERE id_kegiatan = NEW.id_kegiatan;
                END IF;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS update_anggaran_kegiatan();");
    }
}
