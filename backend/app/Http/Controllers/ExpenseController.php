<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function showExpense($id_kegiatan)
    {
        $expenses = DB::table('pengeluaran')
            ->where('id_kegiatan', $id_kegiatan)
            ->orderBy('id_pengeluaran', 'desc')
            ->get();

        $expenseDetails = $expenses->map(function($expense) {
            return [
                'id_pengeluaran' => $expense->id_pengeluaran,
                'nama_transaksi' => $expense->nama_transaksi,
                'total_pengeluaran' => $expense->total_pengeluaran,
                'tanggal_transaksi' => $expense->tanggal_transaksi,
            ];
        });

        return response()->json($expenseDetails, 200);
    }

    public function expenseDetails($id_pengeluaran)
    {
        $expense = DB::table('pengeluaran')
            ->where('id_pengeluaran', $id_pengeluaran)
            ->first();

        return response()->json($expense, 200);
    }

    public function deleteExpense($id_pengeluaran)
    {
        $expense = DB::table('pengeluaran')->where('id_pengeluaran', $id_pengeluaran)->first();

        if (!$expense) {
            return response()->json(['message' => 'Pengeluaran tidak ditemukan'], 404);
        }

        $deleted = DB::table('pengeluaran')->where('id_pengeluaran', $id_pengeluaran)->delete();

        if ($deleted) {
            $updated = DB::table('kegiatan')
                ->where('id_kegiatan', $expense->id_kegiatan)
                ->decrement('anggaran_pengeluaran', $expense->total_pengeluaran);

            if ($updated) {
                return response()->json(['message' => 'Pengeluaran berhasil dihapus dan anggaran terkoreksi'], 200);
            } else {
                return response()->json(['message' => 'Terjadi kesalahan saat memperbarui anggaran kegiatan'], 500);
            }
        } else {
            return response()->json(['message' => 'Pengeluaran tidak ditemukan'], 404);
        }
    }
}
