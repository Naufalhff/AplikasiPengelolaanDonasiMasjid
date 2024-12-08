<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class BuatFungsiUpdateAnggaranPengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE FUNCTION update_anggaran_pengeluaran()
            RETURNS TRIGGER AS $$
            BEGIN
                IF TG_OP = 'INSERT' THEN
                    UPDATE kegiatan
                    SET anggaran_pengeluaran = anggaran_pengeluaran + NEW.total_pengeluaran
                    WHERE id_kegiatan = NEW.id_kegiatan;
                ELSIF TG_OP = 'DELETE' THEN
                    UPDATE kegiatan
                    SET anggaran_pengeluaran = anggaran_pengeluaran - OLD.total_pengeluaran
                    WHERE id_kegiatan = OLD.id_kegiatan;
                END IF;

                RETURN NULL;
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
        DB::statement("DROP FUNCTION IF EXISTS update_anggaran_pengeluaran;");
    }
}
