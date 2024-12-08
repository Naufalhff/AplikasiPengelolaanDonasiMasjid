<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'id' => 'required|integer',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $path = $request->file('file')->store('bukti-pengeluaran', 'public');

            $pengeluaran = Pengeluaran::create([
                'id_kegiatan' => $request->id,
                'nama_transaksi' => $request->name,
                'deskripsi_transaksi' => $request->description,
                'total_pengeluaran' => $request->amount,
                'bukti_transaksi' => $path,
            ]);

            return response()->json([
                'message' => 'Pengeluaran berhasil dibuat.',
                'data' => $pengeluaran,
                'file_url' => Storage::url($path)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan pengeluaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

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

    public function destroy($id_pengeluaran)
    {
        $expense = DB::table('pengeluaran')->where('id_pengeluaran', $id_pengeluaran)->first();

        if (!$expense) {
            return response()->json(['message' => 'Pengeluaran tidak ditemukan'], 404);
        }

        if ($expense->bukti_transaksi) {
            $filePath = $expense->bukti_transaksi;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        $deleted = DB::table('pengeluaran')->where('id_pengeluaran', $id_pengeluaran)->delete();

        if ($deleted) {
            return response()->json(['message' => 'Pengeluaran berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus pengeluaran'], 500);
        }
    }
}
