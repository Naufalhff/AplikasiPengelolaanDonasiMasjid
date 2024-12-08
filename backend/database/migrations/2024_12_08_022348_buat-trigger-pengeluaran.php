<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class BuatTriggerPengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Trigger untuk INSERT
        DB::statement("
            CREATE TRIGGER trg_insert_pengeluaran
            AFTER INSERT ON pengeluaran
            FOR EACH ROW
            EXECUTE FUNCTION update_anggaran_pengeluaran();
        ");

        // Trigger untuk DELETE
        DB::statement("
            CREATE TRIGGER trg_delete_pengeluaran
            AFTER DELETE ON pengeluaran
            FOR EACH ROW
            EXECUTE FUNCTION update_anggaran_pengeluaran();
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS trg_insert_pengeluaran ON pengeluaran;");
        DB::statement("DROP TRIGGER IF EXISTS trg_delete_pengeluaran ON pengeluaran;");
    }
}
