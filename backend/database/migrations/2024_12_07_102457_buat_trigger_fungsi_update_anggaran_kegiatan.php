<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class BuatTriggerFungsiUpdateAnggaranKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TRIGGER trg_update_anggaran_kegiatan
            AFTER UPDATE ON donasi
            FOR EACH ROW
            EXECUTE FUNCTION update_anggaran_kegiatan();
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS trg_update_anggaran_kegiatan ON donasi;");
    }
}
