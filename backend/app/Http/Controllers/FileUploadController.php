<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Donasi;
use App\Models\Pengeluaran;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,png,pdf',
            'id' => 'required|integer',
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'amount' => 'required|numeric',
            'payment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Gagal mengunggah file, format file tidak didukung.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $path = $request->file('file')->store('bukti_pembayaran', 'public');

            // Simpan data ke database
            Donasi::insert([
                'id_kegiatan' => $request->id,
                'metode_pembayaran' => $request->payment,
                'nama_donatur' => $request->name,
                'alamat_donatur' => $request->address,
                'no_telepon_donatur' => $request->phone,
                'email_donatur' => $request->email,
                'jumlah_donasi' => $request->amount,
                'bukti_pembayaran' => $path,
                'status_verifikasi' => 'PENDING',
                'tanggal_donasi' => now(),
                'tanggal_verifikasi' => null,
            ]);

            return response()->json([
                'message' => 'File uploaded successfully',
                'path' => Storage::url($path) // Menghasilkan URL publik untuk file
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan file.',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function addExpense(Request $request)
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
            $path = $request->file('file')->store('bukti_pembayaran', 'public');

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
}
