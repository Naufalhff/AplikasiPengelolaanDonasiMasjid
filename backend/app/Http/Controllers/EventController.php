<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Donasi;
use App\Models\RekeningPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Kegiatan::orderBy('id_kegiatan', 'asc')->get();
        return response()->json($events);
    }

    public function getEventLimited()
    {
        $events = Kegiatan::take(3)->get();
        return response()->json($events);
    }

    public function getDataById($id)
    {
        $event = Kegiatan::find($id);

        if ($event) {
            return response()->json($event);
        }

        return response()->json(['message' => 'Event not found'], 404);
    }

    public function updateAmount($id, Request $request)
    {
        $event = Kegiatan::findOrFail($id);
        $event->anggaran_pengeluaran += $request->anggaran_terkumpul;
        $event->save();

        return response()->json([
            'message' => 'Anggaran terkumpul berhasil diperbarui.',
            'data' => $event
        ], 200);
    }

    public function countDonatur($id)
    {
        $count = Donasi::where('id_kegiatan', $id)->count();
        return response()->json(['jumlah_donatur' => $count]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'name' => 'required|string|max:100|unique:kegiatan,nama_kegiatan',
            'type' => 'required|string|in:ZAKAT,SUMBANGAN,ZAKAT MAL',
            'description' => 'required|string|max:255',
            'target' => 'required|numeric|min:0',
            'limit' => 'required|date_format:Y-m-d',
            'rekening' => 'required|string|min:1',
            'qris' => 'required|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('name')) {
                return response()->json([
                    'message' => 'Nama kegiatan sudah digunakan. Harap gunakan nama yang berbeda.',
                    'field' => 'name',
                    'errors' => $errors->get('name'),
                ], 422);
            }

            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $errors,
            ], 422);
        }

        $thumbnailPath = null;
        $qrisPath = null;

        DB::beginTransaction();
        try {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnail_kegiatan', 'public');
            $qrisPath = $request->file('qris')->store('qris_kegiatan', 'public');

            $kegiatan = Kegiatan::create([
                'foto_kegiatan' => $thumbnailPath,
                'nama_kegiatan' => $request->name,
                'jenis_kegiatan' => $request->type,
                'deskripsi_kegiatan' => $request->description,
                'anggaran_donasi' => $request->target,
                'anggaran_terkumpul' => 0,
                'anggaran_pengeluaran' => 0,
                'tenggat_waktu' => $request->limit,
                'tanggal_dibuat' => now(),
                'tanggal_dirubah' => null,
            ]);

            $rekeningBank = RekeningPembayaran::create([
                'id_kegiatan' => $kegiatan->id_kegiatan,
                'jenis_rekening' => 'BSI',
                'informasi_rekening' => $request->rekening,
            ]);

            $rekeningQRIS = RekeningPembayaran::create([
                'id_kegiatan' => $kegiatan->id_kegiatan,
                'jenis_rekening' => 'QRIS',
                'informasi_rekening' => $qrisPath,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Kegiatan berhasil dibuat.',
                'id_kegiatan' => $kegiatan->id_kegiatan,
                'kegiatan' => $kegiatan,
                'rekening_bank' => $rekeningBank,
                'rekening_qris' => $rekeningQRIS,
                'thumbnail_url' => Storage::url($thumbnailPath),
                'qris_url' => Storage::url($qrisPath)
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            if (Storage::exists($thumbnailPath)) {
                Storage::delete($thumbnailPath);
            }
            if (Storage::exists($qrisPath)) {
                Storage::delete($qrisPath);
            }

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan kegiatan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id_kegiatan)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'name' => 'nullable|string|max:100|unique:kegiatan,nama_kegiatan,' . $id_kegiatan . ',id_kegiatan',
            'type' => 'nullable|string|in:ZAKAT,SUMBANGAN,ZAKAT MAL',
            'description' => 'nullable|string|max:255',
            'target' => 'nullable|numeric|min:0',
            'limit' => 'nullable|date_format:Y-m-d',
            'rekening' => 'nullable|string|min:1',
            'qris' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('name')) {
                return response()->json([
                    'message' => 'Nama kegiatan sudah digunakan. Harap gunakan nama yang berbeda.',
                    'field' => 'name',
                    'errors' => $errors->get('name'),
                ], 422);
            }

            $missingFields = [];
            $expectedFields = ['thumbnail', 'name', 'type', 'description', 'target', 'limit', 'rekening', 'qris'];

            foreach ($expectedFields as $field) {
                if (!$request->has($field) && !$request->hasFile($field)) {
                    $missingFields[$field] = "$field tidak diisi atau kosong.";
                }
            }

            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $errors->toArray(),
                'missing_fields' => $missingFields,
            ], 422);
        }

        DB::beginTransaction();
        try {
            $kegiatan = Kegiatan::findOrFail($id_kegiatan);

            $thumbnailPath = $kegiatan->foto_kegiatan;
            $qrisPath = RekeningPembayaran::where('id_kegiatan', $id_kegiatan)
                ->where('jenis_rekening', 'QRIS')
                ->value('informasi_rekening');

            if ($request->hasFile('thumbnail')) {
                if (Storage::exists($thumbnailPath)) {
                    Storage::delete($thumbnailPath);
                }
                $thumbnailPath = $request->file('thumbnail')->store('thumbnail_kegiatan', 'public');
            }

            if ($request->hasFile('qris')) {
                if (Storage::exists($qrisPath)) {
                    Storage::delete($qrisPath);
                }
                $qrisPath = $request->file('qris')->store('qris_kegiatan', 'public');
            }

            $kegiatan->update([
                'foto_kegiatan' => $thumbnailPath,
                'nama_kegiatan' => $request->name ?? $kegiatan->nama_kegiatan,
                'jenis_kegiatan' => $request->type ?? $kegiatan->jenis_kegiatan,
                'deskripsi_kegiatan' => $request->description ?? $kegiatan->deskripsi_kegiatan,
                'anggaran_donasi' => $request->target ?? $kegiatan->anggaran_donasi,
                'tenggat_waktu' => $request->limit ?? $kegiatan->tenggat_waktu,
                'tanggal_dirubah' => now(),
            ]);

            if ($request->rekening) {
                RekeningPembayaran::updateOrCreate(
                    [
                        'id_kegiatan' => $id_kegiatan,
                        'jenis_rekening' => 'BSI',
                    ],
                    [
                        'informasi_rekening' => $request->rekening,
                    ]
                );
            }

            RekeningPembayaran::updateOrCreate(
                [
                    'id_kegiatan' => $id_kegiatan,
                    'jenis_rekening' => 'QRIS',
                ],
                [
                    'informasi_rekening' => $qrisPath,
                ]
            );

            DB::commit();

            return response()->json([
                'message' => 'Kegiatan berhasil diperbarui.',
                'id_kegiatan' => $id_kegiatan,
                'kegiatan' => $kegiatan,
                'thumbnail_url' => Storage::url($thumbnailPath),
                'qris_url' => Storage::url($qrisPath),
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui kegiatan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:kegiatan,id_kegiatan',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $kegiatans = Kegiatan::whereIn('id_kegiatan', $request->ids)->get();

        $saldoTersisa = $kegiatans->filter(function ($kegiatan) {
            return ($kegiatan->anggaran_terkumpul - $kegiatan->anggaran_pengeluaran) != 0;
        });

        if ($saldoTersisa->isNotEmpty()) {
            $kegiatanBermasalah = $saldoTersisa->map(function ($kegiatan) {
                return [
                    'id_kegiatan' => $kegiatan->id_kegiatan,
                    'nama_kegiatan' => $kegiatan->nama_kegiatan,
                    'saldo_tersisa' => $kegiatan->anggaran_terkumpul - $kegiatan->anggaran_pengeluaran,
                ];
            });

            return response()->json([
                'message' => 'Beberapa kegiatan masih memiliki saldo tersisa.',
                'warning' => true,
                'kegiatan_bersaldo' => $kegiatanBermasalah,
            ], 400);
        }

        DB::beginTransaction();
        try {
            foreach ($kegiatans as $kegiatan) {
                if ($kegiatan->foto_kegiatan && Storage::exists($kegiatan->foto_kegiatan)) {
                    Storage::delete($kegiatan->foto_kegiatan);
                }

                $qrisPath = RekeningPembayaran::where('id_kegiatan', $kegiatan->id_kegiatan)
                    ->where('jenis_rekening', 'QRIS')
                    ->value('informasi_rekening');

                if ($qrisPath && Storage::exists($qrisPath)) {
                    Storage::delete($qrisPath);
                }
            }

            RekeningPembayaran::whereIn('id_kegiatan', $request->ids)->delete();
            Kegiatan::whereIn('id_kegiatan', $request->ids)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Kegiatan berhasil dihapus.',
                'deleted_ids' => $request->ids,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus kegiatan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
